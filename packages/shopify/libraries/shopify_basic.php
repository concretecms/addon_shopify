<?defined('C5_EXECUTE') or die(_("Access Denied."));

class shopifyBasic {
	public static function getJSON($what, $suffix=true) {
		$fh = Loader::helper('file');
		$pkg = Package::getByHandle('shopify');
		$apikey = $pkg->config('apikey');
		$password = $pkg->config('password');
		$myshopifyURL = $pkg->config('myshopifyURL');

		Log::addEntry('Shopify API access','Shopify API Debug');
		return $fh->getContents('https://'.$apikey.':'.$password.'@'.$myshopifyURL.'/admin/'.$what.($suffix?'.json':''));
	}

	public static function testConnection() {
		$js = Loader::helper('json');
		$r = $js->decode(self::getJSON('shop'));
		return (!empty($r->shop->myshopify_domain));
	}

	public static function getProductByID($id){
		$js = Loader::helper('json');
		return $js->decode(self::getJSON('products/'.$id))->product;
	}

	public static function getProducts(){
		$js = Loader::helper('json');
		return $js->decode(self::getJSON('products'))->products;
	}

	public static function searchProducts($keywords, $productType = false) {
		$fh = Loader::helper('file');
		$pkg = Package::getByHandle('shopify');
		$apikey = $pkg->config('apikey');
		$password = $pkg->config('password');
		$myshopifyURL = $pkg->config('myshopifyURL');
		if ($keywords && $productType) {
			$url = 'https://'.$apikey.':'.$password.'@'.$myshopifyURL.'/admin/products/search.json?order=title+ASC&query=' . $keywords . '*+product_type:' . $productType;
		} else if ($productType) {
			$url = 'https://'.$apikey.':'.$password.'@'.$myshopifyURL.'/admin/products.json?order=title+ASC&product_type=' . $productType;
		} else if ($keywords) {
			$url = 'https://'.$apikey.':'.$password.'@'.$myshopifyURL.'/admin/products/search.json?order=title+ASC&query=' . $keywords . '*';
		} else {
			$url = 'https://'.$apikey.':'.$password.'@'.$myshopifyURL.'/admin/products/search.json?order=title+ASC';
		}
		$js = Loader::helper('json');
		return $js->decode($fh->getContents($url))->products;
	}

	public static function getCollections(){
		$js = Loader::helper('json');
		return $js->decode(self::getJSON('custom_collections'))->custom_collections;
	}

	public static function getSmartCollections(){
		$js = Loader::helper('json');
		return $js->decode(self::getJSON('smart_collections'))->smart_collections;
	}

	public static function getTypes(){
		$fh = Loader::helper('file');
		$pkg = Package::getByHandle('shopify');
		$apikey = $pkg->config('apikey');
		$password = $pkg->config('password');
		$myshopifyURL = $pkg->config('myshopifyURL');
		$url = 'https://'.$apikey.':'.$password.'@'.$myshopifyURL.'/admin/products.json?fields=product_type';
		$js = Loader::helper('json');
		// this is assinine
		$types = $js->decode($fh->getContents($url))->products;
		$typeArray = array();
		if (is_array($types)) {
			foreach($types as $t) {
				$typeArray[$t->product_type] = $t->product_type;
			}
		}
		$typeArray = array_unique($typeArray);
		return $typeArray;
	}

	public static function getProductsByCollection($collectionID, $numResults = false){
		$js = Loader::helper('json');
		$request = 'products.json?collection_id='.$collectionID;
		if ($numResults) {
			$request .= '&limit=' . $numResults;
		}
		return $js->decode(self::getJSON($request))->products;
	}


}

