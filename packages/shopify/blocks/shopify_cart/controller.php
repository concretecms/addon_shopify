<?
defined('C5_EXECUTE') or die(_("Access Denied."));
class CartLinksBlockController extends BlockController {
		
		protected $btTable = 'btCoreCommerceCartLinks';
		protected $btInterfaceWidth = "400";
		protected $btInterfaceHeight = "300";
		
		protected $showCartLink = true;
		protected $showItemQuantity = true;
		protected $showCheckoutLink = true;
		protected $cartLinkText = 'View Cart';
		protected $checkoutLinkText = 'Checkout';
		public $order;

		public function getBlockTypeDescription() {
			return t("Show links for your Shopify cart and checkout.");
		}

		public function getBlockTypeName() {
			return t("Shopify Cart");
		}


		public function on_start() {
		}
		
		
		public function on_page_view() {
			$this->addFooterItem(Loader::helper('html')->javascript('jquery.form.js'));
			$this->addFooterItem(Loader::helper('html')->javascript('jquery.ui.js'));
			$this->bogus = 'test';
		}
		
		
		public function view() {
			//get whatever the count is, set it
			//also want the subtotal
			$this->set('items',$items);
		}

		
		public function add() {
			$this->set('showCartLink', $this->showCartLink);
			$this->set('showItemQuantity', $this->showItemQuantity);
			$this->set('showCheckoutLink', $this->showCheckoutLink);
			$this->set('cartLinkText', $this->cartLinkText);
			$this->set('checkoutLinkText', $this->checkoutLinkText);
		}
		
		public function save($data) {
			if (!isset($data['showCartLink'])) {
				$data['showCartLink'] = 0;
			}
			if (!isset($data['showItemQuantity'])) {
				$data['showItemQuantity'] = 0;
			}
			if (!isset($data['showCheckoutLink'])) {
				$data['showCheckoutLink'] = 0;
			}
			parent::save($data);
		}
	}
