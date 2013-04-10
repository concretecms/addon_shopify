<?php defined('C5_EXECUTE') or die(_("Access Denied."));

class DashboardShopifyController extends DashboardBaseController {

	public function view() {
		$this->redirect('/dashboard/shopify/configure');
	}
	
}
