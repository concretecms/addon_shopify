<? defined('C5_EXECUTE') or die(_("Access Denied."));
//$c = Page::getCurrentPage();
//put an if / or for the javascript block
if ($showItemQuantity || $showSubtotal) { ?>
<script type="text/javascript">
$(function(){
	$.ajax({
		url: '<?= $cartJSON ?>',
		dataType: 'jsonp',crossDomain:true,
		type: 'post',
		success: function(cart) {
			var quantity = 0;
			var subtotal = 0;
			quantity = cart.item_count;
			subtotal = cart.total_price;

			$('#shopify-cart-subtotal').html('$'+(subtotal/100).toFixed(2));
			$('#shopify-cart-quantity').html(quantity+' '+((quantity != 1)?'<?= t('items') ?>':'<?= t('item') ?>'));
		}
		fail: function() {
			$('#shopify-cart-subtotal').html('$'+(subtotal/100).toFixed(2));
			$('#shopify-cart-quantity').html(quantity+' '+((quantity != 1)?'<?= t('items') ?>':'<?= t('item') ?>'));
		}
	});
});
</script>
<?}?>

<div class="shopify-cart-links">
<?php if ($showCartLink) { ?>
	<a href="<?=$cartURL?>" ><?=$cartLinkText?></a>
<?php } ?>
<?php if ($showItemQuantity) { ?>
	(<span id="shopify-cart-quantity"></span>) 
<?php } ?>
<? if ($showItemQuantity && $showSubtotal) {?>
|
<?}?>
<?php if ($showSubtotal) { ?>
	(<span id="shopify-cart-subtotal"></span>) 
<?php } ?>
</div>
