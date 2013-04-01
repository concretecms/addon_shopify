<?php defined('C5_EXECUTE') or die('Access Denied');

class ShopifyPackage extends Package {

	protected $pkgHandle = 'shopify';
	protected $appVersionRequired = '5.5';
	protected $pkgVersion = '0.9';

	public function getPackageDescription() {
		return t('Adds Shopify functionality to your website.');
	}

	public function getPackageName() {
		return t('Shopify');
	}

	public function install() {
		$pkg = parent::install();
		Loader::model('single_page');
		if(Page::getByPath('/dashboard/shopify')->getCollectionID() <= 0) {
			SinglePage::add('/dashboard/shopify',$pkg);
		}
	}

	public function upgrade() {
		parent::upgrade();
	}

}
