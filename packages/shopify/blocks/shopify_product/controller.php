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
	//setting these to defaults doesn't make sense
	//just forces wrong data to the db.
		'productID' => 0,
		'showPicture' => true,
		'pictureWidth' => 0,
		'pictureHeight' => 0,
		'showName' => true,
		'showDescription' => 0, //false is not the same as zero to adodb?
		'showLink' => true,
		'linkText' => 'Buy This',
		'showBuyThis'=> true
	);
		
	public function getBlockTypeName() {
		return t('Shopify Product');
	}

	public function getBlockTypeDescription() {
		return t('Display a single product from your Shopify store.');
	}

	public function save($args) {
		foreach($this->stuff as $key => $default) {
			$args[$key] = (isset($args[$key]) && $args[$key] != null) ? $args[$key] : 0;
			$args[$key] = $args[$key] === 'on' ? true : $args[$key];
		}
		if (!$args['linkText']) {
			$args['linkText'] = '';
		}
		parent::save($args);
	}

	public function on_before_render(){
		$uh = Loader::helper('concrete/urls');
		$hh = Loader::helper('html');
		$bt = BlockType::getByHandle('shopify_product');
		//$pkg = Package::getByHandle('shopify');

		//$cartURL = 'http://'.$pkg->config('myshopifyURL').'/cart/';
		//$this->addHeaderItem('<script type="text/javascript"> var SHOPIFY_CART_URL ="'.$cartURL.'"; </script>');
	}

	public function add_edit() {
		$uh = Loader::helper('concrete/urls');
		$hh = Loader::helper('html');
		$bt = BlockType::getByHandle('shopify_product');

		//$this->addHeaderItem($hh->css($uh->getBlockTypeAssetsURL($bt,'auto.css')));
		//$this->addHeaderItem($hh->javascript($uh->getBlockTypeAssetsURL($bt,'js/jquery.imagesloaded.min.js')));
	}

	public function add() {
		$this->add_edit();
		Loader::library('shopify_basic','shopify');
		//$availableProducts = shopifyBasic::getProducts();
		//$collections = shopifyBasic::getCollections();
		//$this->set('availableProducts',$availableProducts);
		$types = shopifyBasic::getTypes();
		$this->set('types',$types);
	}

	public function edit() {
		$this->add_edit();
		//$localProducts = $this->getProducts(); //nothing yet
		Loader::library('shopify_basic','shopify');
		$chosenProduct = shopifyBasic::getProductByID($this->productID);
		$types = shopifyBasic::getTypes();
		$this->set('types',$types);
		$this->set('chosenProduct',$chosenProduct);
	}

	public function view() {
		$pkg = Package::getByHandle('shopify');
		Loader::library('shopify_basic','shopify');
		$product = shopifyBasic::getProductByID($this->productID);
		$this->set('imgSrc',$product->images[0]->src); //wack. Need to figure out how to cache / temp file this somehow
		$linkURL = 'http://'.$pkg->config('myshopifyURL').'/products/'.$product->handle.'/';
		$cartURL = 'http://'.$pkg->config('myshopifyURL').'/cart/';
		$this->set('linkURL',$linkURL);
		$this->set('cartURL',$cartURL);
		$this->set('product',$product);
	}

}
