<?php defined('C5_EXECUTE') or die('Access Denied');
Loader::library('3rdparty/shopify','shopify');
class ShopifyConnectHelper {

	protected $key;
	protected $id;
	protected $secret;

	public function getShopifyClient($useToken = true) {
		return new ShopifyClient($this->getShopID(),
								 ($useToken?$this->getToken():''),
								 $this->getShopKey(),
								 $this->getShopSecret());
	}

	public function getShopID() {
		if (!$this->id) {
			$this->id = Config::get('SHOPIFY_SHOP_ID');
		}
		return $this->id;
	}

	public function getApiKey() {
		if (!$this->key) {
			$this->key = Config::get('SHOPIFY_SHOP_KEY');
		}
		return $this->key;
	}

	public function getApiSecret() {
		if (!$this->secret) {
			$this->secret = Config::get('SHOPIFY_SHOP_SECRET');
		}
		return $this->secret;
	}

	public function getToken($new = false) {
		if (!$new && $_SESSION['token']) {
			return $_SESSION['token'];
		}
		$client = $this->getShopifyClient(false);
		return $shopifyClient->getAccessToken($_GET['code']);
	}

}