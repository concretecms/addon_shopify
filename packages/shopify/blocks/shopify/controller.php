<?defined('C5_EXECUTE') or die(_("Access Denied."));

class ShopifyProductBlockController extends BlockController {

	protected $btTable = "btShopifyProduct";
	protected $btInterfaceWidth = "400";
	protected $btInterfaceHeight = "400";
	protected $btCacheBlockRecord = true;
	protected $btCacheBlockOutput = true;
	protected $btCacheBlockOutputOnPost = true;
	protected $btCacheBlockOutputForRegisteredUsers = true;
	protected $btCacheBlockOutputLifetime = CACHE_LIFETIME;

	public function getBlockTypeName() {
		return t('Shopify Products');
	}

	public function getBlockTypeDescription() {
		return t('Display Products from your shopify store in your concrete5 website');
	}

	public function edit() {
		//$localProducts = $this->getProducts(); //nothing yet
		Loader::library('shopify_basic');
		$availableProducts = shopifyBasic::getProducts();
		$this->set('availableProducts',$availableProducts);
	}

	public function getProducts() {
		//this should get whatever product data we're keeping locally.
	}
}
