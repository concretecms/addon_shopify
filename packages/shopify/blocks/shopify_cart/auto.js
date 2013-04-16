$(function() {
	$('#showCartLink').change(function(){$('.cc-cart-link').toggle();});
	$('#cartLinkText').change(function(){$('.cc-cart-text').text($('#cartLinkText').val())});
	$('#showItemQuantity').change(function(){$('.cc-item-quantity').toggle();});
	$('#showSubtotal').change(function(){$('.cc-item-subtotal').toggle();});
});
