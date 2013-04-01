<?php defined('C5_EXECUTE') or die(_("Access Denied."));

class DashboardShopifyController extends DashboardBaseController {

	protected $things = array(
		'myshopifyURL',
		'password',
		'apikey'//,
		//'secret' //no longer used.
	);

	public function view() {
		$pkg = Package::getByHandle('shopify');
		foreach($this->things as $thing) {
			$this->set($thing,$pkg->config($thing));
		}
	}

	public function save() {
		$pkg = Package::getByHandle('shopify');
		foreach($this->things as $thing) {
			if(strlen($this->post($thing))) {
				$pkg->saveConfig($thing,$this->post($thing));
			} else if (!$this->error->has()){
				$this->error->add(t('All settings are required for the API to work.'));
			}
		}
		$this->view();
	}

}
