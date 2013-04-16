function doSeparator() {
	if ($('#showItemQuantity').attr('checked') && $('#showSubtotal').attr('checked')) {
		$('.cc-cart-pipe').show();
	} else {
		$('.cc-cart-pipe').hide();
	}
}
$(function() {
	$('#showCartLink').change(function(){$('.cc-cart-link').toggle()});
	$('#cartLinkText').change(function(){$('.cc-cart-text').text($('#cartLinkText').val())});
	$('#showItemQuantity').change(function(){$('.cc-item-quantity').toggle();doSeparator()});
	$('#showSubtotal').change(function(){$('.cc-item-subtotal').toggle();doSeparator()});
});
