<?defined('C5_EXECUTE') or die(_("Access Denied."));

class shopifyBasic {
	public static function getJSON($what) {
		$fh = Loader::helper('file');
		$pkg = Package::getByHandle('shopify');
		$apikey = $pkg->config('apikey');
		$password = $pkg->config('password');
		$myshopifyURL = $pkg->config('myshopifyURL');

		Log::addEntry('Shopify API access','Shopify API Debug');
		return $fh->getContents('https://'.$apikey.':'.$password.'@'.$myshopifyURL.'/admin/'.$what.'.json');
	}

	public static function getProducts(){
		$js = Loader::helper('json');
		return $js->decode(self::getJSON('products'))->products;
	}
}

