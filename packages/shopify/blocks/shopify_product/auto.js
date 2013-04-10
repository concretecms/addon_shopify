var shopifyProductBlock ={
	init:function(){
		this.tabSetup();
		this.productBinds();
	},
	tabSetup: function(){
		$('ul#ccm-blockEditPane-tabs li a').each( function(num,el){ 
			el.onclick=function(){
				var pane=this.id.replace('ccm-blockEditPane-tab-','');
				shopifyProductBlock.showPane(pane);
			}
		});		
	},
	productBinds: function() {
		$('.product-list button.add-product').show();
		$('.product-list button.remove-product').hide();
		$('#pickedProduct button.add-product').hide();
		$('#pickedProduct button.remove-product').show();

		$('button.add-product').click(function(e) {
			e.preventDefault();
			$('#productID').val($(this).attr('product-id'));
			var old = $('#pickedProduct').find('div.product');
			old.find('button.remove-product').hide();
			old.find('button.add-product').show();
			$('div.product-list').prepend(old);//fix the button
			$('#pickedProduct').html($(this).parent().parent()); //this is garbage
			$('.no-product-message').hide();
			$(this).prev().show();
			$(this).hide();
		});

		$('button.remove-product').click(function(e) {
			e.preventDefault();
			$('div.product-list').prepend($(this).parent().parent()); //avoid parent parent
			$('#productID').val('');
			$('.no-product-message').show();
			$(this).next().show();
			$(this).hide();
		});
	},
	showPane:function(pane){
		$('ul#ccm-blockEditPane-tabs li').each(function(num,el){ $(el).removeClass('ccm-nav-active') });
		$(document.getElementById('ccm-blockEditPane-tab-'+pane).parentNode).addClass('ccm-nav-active');
		$('div.ccm-blockEditPane').each(function(num,el){ el.style.display='none'; });
		$('#ccm-blockEditPane-'+pane).css('display','block');
	}
}

$(function(){
	shopifyProductBlock.init();
	$('#collection').change(function(){
		$.get($('#action-urls').attr('product-list')+'&collectionID='+$('#collection').val(),function(data){
			$('div.product-list').html(data);
			shopifyProductBlock.productBinds();
		});
	});
});
