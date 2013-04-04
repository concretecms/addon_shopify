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
		return t('Shopify Product');
	}

	public function getBlockTypeDescription() {
		return t('Display a single product from your Shopify store.');
	}

	public function add() {
		Loader::library('shopify_basic','shopify');
		$availableProducts = shopifyBasic::getProducts();
		$this->set('availableProducts',$availableProducts);
	}

	public function edit() {
		//$localProducts = $this->getProducts(); //nothing yet
		$this->add();
	}

	public function view() {
		$product = shopifyBasic::getProducts($this->productID());
		$this->set('product',$product);
	}

	public function getProducts() {
		//this should get whatever product data we're keeping locally.
	}
}
