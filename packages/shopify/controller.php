<?php defined('C5_EXECUTE') or die('Access Denied');

class ShopifyPackage extends Package {

	protected $pkgHandle = 'shopify';
	protected $appVersionRequired = '5.6.0.2';
	protected $pkgVersion = '1.0.2';

	public function getPackageDescription() {
		return t('Adds Shopify functionality to your website.');
	}

	public function getPackageName() {
		return t('Shopify');
	}

	public function install() {
		$pkg = parent::install();
		Loader::model('single_page');
		if(Page::getByPath('/dashboard/shopify/configure')->getCollectionID() <= 0) {
			SinglePage::add('/dashboard/shopify/configure',$pkg);
		}
		BlockType::installBlockTypeFromPackage('shopify_product', $pkg);	
		BlockType::installBlockTypeFromPackage('shopify_cart',$pkg);	
		BlockType::installBlockTypeFromPackage('shopify_product_list',$pkg);	
	}

	public function upgrade() {
		parent::upgrade();
		$pkg = Package::getByHandle('shopify');
		$bt = BlockType::getByHandle('shopify_product');
		if(!($bt instanceof BlockType)) {
			BlockType::installBlockTypeFromPackage('shopify_product',$pkg);	
		}
		$bt = BlockType::getByHandle('shopify_cart');
		if(!($bt instanceof BlockType)) {
			BlockType::installBlockTypeFromPackage('shopify_cart',$pkg);	
		}
		$bt = BlockType::getByHandle('shopify_product_list');
		if(!($bt instanceof BlockType)) {
			BlockType::installBlockTypeFromPackage('shopify_product_list',$pkg);	
		}

	}
}
