<?defined('C5_EXECUTE') or die(_("Access Denied."));
//var_dump($product);
//extract($etc);
//var_dump($showDescription);
var_dump($showBuyThis);
?>
<div class="shopify-product" id="shopify-product-<?=$product->productID?>">
<? if($showPicture){?>
	<img class="shopify-product-image" src="<?=$imgSrc?>">
<?}?>
<?if($showName){?>
	<div class="shopify-product-name">
		<?if ($showLink){?>
			<a href="<?=$linkURL?>"><?=$product->title?></a>
		<?} else {
			echo $product->title;
		}?>
	</div>
<?}?>
<?if ($showDescription){?>
	<p class="shopify-product-description"><?=strip_tags($product->body_html)?></p>
<?}?>
<?if ($showBuyThis){?>
	<a class="shopify-product-link" href="<?=$linkToBuy?>"><?=$linkText?></a>
<?}?>
</div>

