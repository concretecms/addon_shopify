<?defined('C5_EXECUTE') or die(_("Access Denied."));
//var_dump($product);
//extract($etc);
//var_dump($showDescription);
//var_dump($showBuyThis);


//default to the first variant, quanity 1:
$linkToBuy = $cartURL.$product->variants[0]->id.':1';

//a little logic-y for a view here
$variants = array();
if (count($product->variants) > 1) foreach($product->variants as $variant) {
	for($i = 1; $i < 4; $i++) {
		if(strlen($variant->{"option{$i}"})){
			$options[] = $variant->{"option{$i}"};
		}
	}
	$optionString = implode(', ',$options);
	$variants[] = '<option value="'.$variant->id.'">'.$optionString.'</option>';
	$options = array();
}
?>
<div class="ccm-shopify-product" id="shopify-product-<?=$product->productID?>">
<? if($showPicture){?>
	<img class="shopify-product-image" src="<?=$imgSrc?>" width="<?=$pictureWidth?>" height="<?=$pictureHeight?>" >
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
<?if (count($variants)) {?>
	<select class="shopify-product-variant-select" id="variantOption">
	<? foreach($variants as $variant) {
		echo $variant;
	}?>
	</select>
<?}?>
<?if ($showBuyThis){?>
	<button class="shopify-product-link" id="linkToShopifyCart" href="<?=$linkToBuy?>"><?=$linkText?></button>
<?}?>
</div>
