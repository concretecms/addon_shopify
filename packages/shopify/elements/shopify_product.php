<?defined('C5_EXECUTE') or die(_("Access Denied."));
//var_dump($product);
//extract($etc);
?>
<div class="shopify-product" id="shopify-product-<?=$product->productID?>">
<? if($showPicture){?>
	<img class="shopify-product-image" src="<?=$imgSrc?>">
<?}?>
<?if($showName){?>
	<div class="shopify-product-name">
		<?=$product->name?>
	</div>
<?}?>
<?if ($showDescription){?>
	<p class="shopify-product-description"><?=strip_tags($product->body_html)?></p>
<?}?>
<?if ($showLink){?>
	<a class="shopify-product-link"><?=$linkText?></a>
<?}?>
</div>

