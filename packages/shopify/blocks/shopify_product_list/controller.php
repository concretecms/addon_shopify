<?defined('C5_EXECUTE') or die(_("Access Denied."));

class ShopifyProductListBlockController extends BlockController {

	protected $btTable = "btShopifyProductList";
	protected $btInterfaceWidth = "530";
	protected $btInterfaceHeight = "350";
	protected $btCacheBlockRecord = true;
	protected $btCacheBlockOutput = true;
	protected $btCacheBlockOutputOnPost = true;
	protected $btCacheBlockOutputForRegisteredUsers = true;
	protected $btCacheBlockOutputLifetime = CACHE_LIFETIME;
	protected $btWrapperClass = 'ccm-ui';

	public function getBlockTypeName() {
		return t('Shopify Product List');
	}

	public function getBlockTypeDescription() {
		return t('Displays product based on a shopify collection (Regular or smart).');
	}

	public function save($data) {
		$args = $data;
		if ($data['shopifyCollectionType'] == 'S') {
			$args['shopifyCollectionID'] = $data['smartCollectionID'];
		} else {
			$args['shopifyCollectionType'] = 'C';
			$args['shopifyCollectionID'] = $data['customCollectionID'];
		}
		// and num results continues in from the original post
		parent::save($args);
	}

	public function getProductURL($product) {

		$linkURL = $this->shopifyURL . '/products/'.$product->handle.'/';
		return $linkURL;
	}

	public function getProductThumbnailImage($product) {
		$srcImage = $product->images[0]->src;
		$srcImageFilenameStart = substr($srcImage, 0, strrpos($srcImage, '.'));
		$srcImageFilenameEnd = substr($srcImage, strrpos($srcImage, '.'));
		$srcImageFilename = $srcImageFilenameStart . '_thumb' . $srcImageFilenameEnd;
		return $srcImageFilename;
	}

	public function form() {
		Loader::library('shopify_basic','shopify');
		$smarts = shopifyBasic::getSmartCollections();
		$customs = shopifyBasic::getCollections();
		$smartCollections = array();
		$customCollections = array();
		if (is_array($smarts)) {
			foreach($smarts as $sm) {
				$smartCollections[$sm->id] = $sm->title;
			}
		}
		if (is_array($customs)) {
			foreach($customs as $sc) {
				$customCollections[$sc->id] = $sc->title;
			}
		}
		$this->set('smartCollections',$smartCollections);
		$this->set('customCollections',$customCollections);
		if ($this->shopifyCollectionType == 'S') {
			$this->set('smartCollectionID', $this->shopifyCollectionID);
		} else {
			$this->set('customCollectionID', $this->shopifyCollectionID);
		}
	}

	public function add() {
		$this->form();
	}

	public function edit() {
		$this->form();
	}

	public function view() {
		Loader::library('shopify_basic','shopify');
		$products = shopifyBasic::getProductsByCollection($this->shopifyCollectionID, $this->numResults);
		$pkg = Package::getByHandle('shopify');
		$this->shopifyURL = 'http://'.$pkg->config('myshopifyURL');
		$this->set('products', $products);
	}
}
