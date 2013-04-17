<?defined('C5_EXECUTE') or die(_("Access Denied.")); ?>
<? if (is_array($products) && count($products) > 0) { ?>

	<? foreach($products as $product) { ?>

		<div class="ccm-shopify-product-list-product">
			<img src="<?=$controller->getProductThumbnailImage($product)?>" />
			<div class="ccm-shopify-product-list-product-name">
				<a href="<?=$controller->getProductURL($product)?>"><?=$product->title?></a>
			</div>

			<div class="cf"></div>

		</div>

	<? } ?>

<? } else { ?>
	<div class="ccm-shopify-product-list-no-results"><?=t('No products found.')?></div>
<? } ?>
