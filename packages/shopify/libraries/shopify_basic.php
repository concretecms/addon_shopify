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

	public static function getProductByID($id){
		$js = Loader::helper('json');
		return $js->decode(self::getJSON('products/'.$id))->product;
	}

	public static function getProducts(){
		$js = Loader::helper('json');
		return $js->decode(self::getJSON('products'))->products;
	}

	public static function getCollections(){
		$js = Loader::helper('json');
		return $js->decode(self::getJSON('custom_collections'))->custom_collections;
	}

	public static function getProductsForCollection($collectionID){
		$js = Loader::helper('json');
		return $js->decode(self::getJSON('products.json?collection_id='.$collectionID))->products;
	}

}

