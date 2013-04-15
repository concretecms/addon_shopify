<?php defined('C5_EXECUTE') or die('Access Denied');

Loader::library('shopify_basic', 'shopify');
$products = shopifyBasic::searchProducts($_REQUEST['keywords'], $_REQUEST['type']);
if (is_array($products)) {
	foreach($products as $product) {
		Loader::element('product_form', array('product'=>$product),'shopify');
	}
}
if (!is_array($products) || count($products) == 0) { ?>
	<div class="alert alert-danger alert-error"><?=t('No products found.')?></div>
<? } 
exit;