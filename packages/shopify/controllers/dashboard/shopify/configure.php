<?php defined('C5_EXECUTE') or die(_("Access Denied."));

class DashboardShopifyConfigureController extends DashboardBaseController {

	public function view() {
		$pkg = Package::getByHandle('shopify');
		if ($pkg->config('myshopifyURL') && $pkg->config('apikey') && $pkg->config('password')) {
			$this->redirect('/dashboard/shopify/configure', 'setup_complete');
		}
		$this->set('myshopifyURL', $pkg->config('myshopifyURL'));
		$this->set('bannerImg', $pkg->getRelativePath() . '/images/banner.jpg');
	}

	public function invalid_parameters_found() {
		$this->clearConfigValues();
		$this->error->add(t('Unable to connect to Shopify. Please double-check your settings and enter them again.'));
		$this->view();
	}

	public function setup_complete() {
		Loader::library('shopify_basic', 'shopify');
		$r = ShopifyBasic::testConnection();
		if (!$r) {
			$this->redirect('/dashboard/shopify/configure', 'invalid_parameters_found');
		}
		
		$pkg = Package::getByHandle('shopify');
		$this->set('password', $pkg->config('password'));
		$this->set('apikey', $pkg->config('apikey'));
		$this->set('myshopifyURL', $pkg->config('myshopifyURL'));
	}

	protected function clearConfigValues() {
		$pkg = Package::getByHandle('shopify');
		$pkg->clearConfig('password');
		$pkg->clearConfig('apikey');
		$pkg->clearConfig('myshopifyURL');
	}

	public function reset() {
		if (!Loader::helper('validation/token')->validate('do_reset')) {
			$this->error->add(Loader::helper('validation/token')->getErrorMessage());
		}
		if (!$this->error->has()) {
			$this->clearConfigValues();
			$this->redirect('/dashboard/shopify/configure');
		}
		$this->setup_complete();
	}

	public function set_store() {
		if (!$this->post('myshopifyURL')) {
			$this->error->add(t('You must set your store\'s URL. Don\'t have a Shopify store? Get one using the banner below.'));
		}
		if (!$this->error->has()) {
			$pkg = Package::getByHandle('shopify');
			$pkg->saveConfig('myshopifyURL', $this->post('myshopifyURL'));
			$this->redirect('/dashboard/shopify/configure', 'set_api_information');
		}
		$this->view();
	}

	public function save_api_information() {
		if ((!$this->post('password')) || (!$this->post('apikey'))) {
			$this->error->add(t('You must specify your store\'s Password and API key. Not sure where to get this information? Follow the link below.'));
		}
		if (!$this->error->has()) {
			$pkg = Package::getByHandle('shopify');
			$pkg->saveConfig('password', $this->post('password'));
			$pkg->saveConfig('apikey', $this->post('apikey'));
			$this->redirect('/dashboard/shopify/configure', 'setup_complete');
		}
		$this->set_api_information();
	}
	
	public function set_api_information() {
		$pkg = Package::getByHandle('shopify');
		if (!$pkg->config('myshopifyURL')) {
			$this->redirect('/dashboard/shopify/configure');
		}

		$this->set('password', $pkg->config('password'));
		$this->set('apikey', $pkg->config('apikey'));
		
		$this->view();
	}

}
