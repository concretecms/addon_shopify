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
			$args[$key] = (isset($args[$key]) && $args[$key] != null) ? $args[$key] : $default;
			$args[$key] = $args[$key] === 'on' ? true : $args[$key];
		}
		parent::save($args);
	}

	public function on_before_render(){
		$uh = Loader::helper('concrete/urls');
		$hh = Loader::helper('html');
		$bt = BlockType::getByHandle('shopify_product');

		//$this->addHeaderItem($hh->javascript($uh->getBlockTypeAssetsURL($bt,'js/jquery.imagesloaded.min.js')));
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
		$fh = Loader::helper('file');
		$ih = Loader::helper('image');
		$pkg = Package::getByHandle('shopify');
		Loader::library('shopify_basic','shopify');

		$product = shopifyBasic::getProductByID($this->productID);
		$image = $fh->getContents($product->images[0]->src);
		//var_dump($product->images[0]->src);
		//var_dump($image);
		//exit;
		//$thumb = $ih->getThumbnail($product->images[0]->src,$pictureWidth,$pictureHeight);
		//$this->set('imgSrc',$thumb->src);
		//foreach ($this->stuff as $whatever => $value) {
			//$etc[$whatever] = $this->{$whatever};
		//}
		//$this->set('etc',$etc);
		//var_dump($product->images);
		$this->set('imgSrc',$product->images[0]->src); //wack. Need to figure out how to cache / temp file this somehow
		//looks like copying create out of the image helper to something else would work.
		$linkURL = 'http://'.$pkg->config('myshopifyURL').'/products/'.$product->handle.'/';
		$this->set('linkURL',$linkURL);
		$this->set('product',$product);
		//var_dump($product);

		//exit;
	}

	public function action_product_list() {
		$collectionID = $_GET['collectionID'];
		Loader::library('shopify_basic','shopify');
		if($collectionID == 0) {
			$products = shopifyBasic::getProducts();
		} else {
			$products = shopifyBasic::getProductsForCollection($collectionID);
		}
		foreach($products as $product) {
			echo Loader::element('product_form',array('product'=>$product,'ih'=>Loader::helper('image')),'shopify');
		}
		exit;
	}

	public function getProducts() {
		//this should get whatever product data we're keeping locally.
		//which is none right now
	}
}
