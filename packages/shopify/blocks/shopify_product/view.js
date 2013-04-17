var shopifyProductBlockView ={
	bindSelect: function() {
		$('#variantOption').change(function(){
			$('#linkToShopifyCart').attr('href',SHOPIFY_CART_URL+$(this).val()+':1');
		});
	}
}

$(function(){
	shopifyProductBlockView.bindSelect();
	$('#linkToShopifyCart').on('click', function() {
		window.location.href = $(this).attr('href');
	});
});
