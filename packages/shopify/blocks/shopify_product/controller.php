<?defined('C5_EXECUTE') or die(_("Access Denied."));

class ShopifyProductBlockController extends BlockController {

	protected $btTable = "btShopifyProduct";
	protected $btInterfaceWidth = "530";
	protected $btInterfaceHeight = "460";
	protected $btCacheBlockRecord = true;
	protected $btCacheBlockOutput = true;
	protected $btCacheBlockOutputOnPost = true;
	protected $btCacheBlockOutputForRegisteredUsers = true;
	protected $btCacheBlockOutputLifetime = CACHE_LIFETIME;
	protected $btWrapperClass = 'ccm-ui';

	protected $stuff = array(
		'productID' => 0,
		'showPicture' => true,
		'pictureWidth' => 0,
		'pictureHeight' => 0,
		'showName' => true,
		'showDescription' => 0, //fuck this shit. false is not the same as zero to adodb?
		'showLink' => true,
		'linkText' => 'holy fuck'
	);
		
	public function getBlockTypeName() {
		return t('Shopify Product');
	}

	public function getBlockTypeDescription() {
		return t('Display a single product from your Shopify store.');
	}

	public function save($args) {
		foreach($this->stuff as $key => $default) {
			$args[$key] = (isset($args[$key]) && $args[$key] != null) ? $args[$key] : $default;
			$args[$key] = $args[$key] === 'on' ? true : $args[$key];
		}
		Log::addEntry(var_export($args,true));
		parent::save($args);
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
		Loader::library('shopify_basic','shopify');
		$product = shopifyBasic::getProductByID($this->productID);
		foreach ($this->stuff as $whatever => $value) {
			$etc[$whatever] = $this->whatever;
		}
		$this->set('etc',$etc);
		$this->set('product',$product);
	}

	public function getProducts() {
		//this should get whatever product data we're keeping locally.
	}
}
