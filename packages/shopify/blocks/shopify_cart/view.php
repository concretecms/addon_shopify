<? defined('C5_EXECUTE') or die(_("Access Denied."));
//$c = Page::getCurrentPage();
//put an if / or for the javascript block
?>
<script type="text/javascript">
$(function(){
	$.ajax({
		url: '<?= $cartJSON ?>',
		dataType: 'jsonp',crossDomain:true,
		type: 'post',
		success: function(cart) {
			console.log(cart);
			var quantity = 0;
			var subtotal = 0;
			quantity = cart.item_count;
			subtotal = cart.total_price;
			//console.log(quantity,subtotal);

			$('#shopify-cart-subtotal').html(subtotal);
			$('#shopify-cart-quantity').html(quantity);
		}
	});
});

</script>

<div class="shopify-cart-links">
<?php if ($showCartLink) { ?>
	<a href="<?=$cartURL?>" ><?=$cartLinkText?></a>
<?php } ?>
<?php if ($showItemQuantity) { ?>
	(<span id="shopify-cart-quantity"><? echo $items . ' ' . ($items != 1 ? t('items'):t('item')) ?></span>) 
<?php } ?>
<?php if ($showSubtotal) { ?>
	(<span id="shopify-cart-subtotal"></span>) 
<?php } ?>
	<span class='shopify-checkout-link-show' style='<?=($showCheckoutLink && $items > 0?'':'display:none')?>'>
	    |
		<a href=""><?php echo $checkoutLinkText?></a>
	</span>
</div>
