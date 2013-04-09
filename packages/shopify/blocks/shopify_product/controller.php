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
		'linkText' => 'Buy This'
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
		Loader::library('shopify_basic','shopify');
		$availableProducts = shopifyBasic::getProducts();
		$chosenProduct = shopifyBasic::getProductByID($this->productID);
		$this->set('availableProducts',$availableProducts);
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
		$this->set('imgSrc',$product->images[0]->src); //wack. Need to figure out how to cache / temp file this somehow
		//looks like copying create out of the image helper to something else would work.
		$this->set('linkURL',$linkURL);
		$this->set('product',$product);
		//var_dump($product);
		//exit;
	}

	public function getProducts() {
		//this should get whatever product data we're keeping locally.
	}
}
