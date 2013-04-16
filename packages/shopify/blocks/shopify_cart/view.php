<? defined('C5_EXECUTE') or die(_("Access Denied."));
//$c = Page::getCurrentPage();
//put an if / or for the javascript block
if ($showItemQuantity || $showSubtotal) { ?>
<script type="text/javascript">
$(function(){
	var showQuantity = <?=$showItemQuantity ? 'true':'false'?>;
	var showSubtotal = <?=$showSubtotal ? 'true':'false'?>;
	$.ajax({
		url: '<?= $cartJSON ?>',
		dataType: 'jsonp',crossDomain:true,
		type: 'post',
		success: function(cart) {
			var quantity = 0;
			var subtotal = 0;
			quantity = cart.item_count;
			subtotal = cart.total_price;
			if (showSubtotal){
				$('.shopify-cart-subtotal').html('$'+(subtotal/100).toFixed(2));
			}
			if (showQuantity){
				$('.shopify-cart-quantity').html(quantity+' '+((quantity != 1)?'<?= t('items') ?>':'<?= t('item') ?>'));
			}
			$('.shopify-cart-values-wrapper').show();
		}
	});
});
</script>
<?}?>

<div class="shopify-cart-links">
<?php if ($showCartLink) { ?>
	<a href="<?=$cartURL?>" ><?=$cartLinkText?></a>
<?php } ?>
<span class="shopify-cart-values-wrapper" style="display: none">

<?php if ($showItemQuantity) { ?>
	(<span class="shopify-cart-quantity"></span>) 
<?php } ?>
<? if ($showItemQuantity && $showSubtotal) {?>
|
<?}?>
<?php if ($showSubtotal) { ?>
	(<span class="shopify-cart-subtotal"></span>) 
<?php } ?>
</span>
</div>
