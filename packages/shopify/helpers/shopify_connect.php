<?php defined('C5_EXECUTE') or die('Access Denied');
Loader::library('3rdparty/shopify','shopify');
class ShopifyConnectHelper {

	protected $key;
	protected $id;
	protected $secret;

	//public function __construct() {
		//return $this->getShopifyClient();
	//}

	public function getShopifyClient($useToken = true) {
		return new ShopifyClient($this->getShopID(),
		                         ($useToken?$this->getToken():''),
		                         $this->getApiKey(),
		                         $this->getApiSecret());
	}

	public function getShopID() {
		$pkg = Package::getByHandle('shopify');
		if (!$this->id) {
			$this->id = $pkg->config('myshopifyURL');
		}
		return $this->id;
	}

	public function getApiKey() {
		$pkg = Package::getByHandle('shopify');
		if (!$this->key) {
			$this->key = $pkg->config('apikey');
		}
		return $this->key;
	}

	public function getApiSecret() {
		$pkg = Package::getByHandle('shopify');
		if (!$this->secret) {
			$this->secret = $pkg->config('secret');
		}
		return $this->secret;
	}

	public function getToken($new = false) {
		if (!$new && $_SESSION['token']) {
			return $_SESSION['token'];
		}
		$client = $this->getShopifyClient(false);
		return $client->getAccessToken($_GET['code']);
	}

}
