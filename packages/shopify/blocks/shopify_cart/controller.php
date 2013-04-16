<?
defined('C5_EXECUTE') or die(_("Access Denied."));
class ShopifyCartBlockController extends BlockController {
		
		protected $btTable = 'btShopifyCart';
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
		
		public function view() {
			$pkg = Package::getByHandle('shopify');
			$cartJSON = 'http://'.$pkg->config('myshopifyURL').'/cart.json';
			$cartURL = 'http://'.$pkg->config('myshopifyURL').'/cart/';
			//get whatever the count is, set it
			//also want the subtotal
			$this->set('cartJSON',$cartJSON);
			$this->set('cartURL',$cartURL);
			$this->set('items',$items);
		}

		
		public function add() {
			$this->set('showCartLink', $this->showCartLink);
			$this->set('showItemQuantity', $this->showItemQuantity);
			$this->set('showCheckoutLink', $this->showCheckoutLink);
			$this->set('cartLinkText', $this->cartLinkText);
			$this->set('checkoutLinkText', $this->checkoutLinkText);
			$this->set('showSubtotal',$this->showSubtotal);
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
			if (!isset($data['showSubtotal'])) {
				$data['showSubtotal'] = 0;
			}
			parent::save($data);
		}
	}
