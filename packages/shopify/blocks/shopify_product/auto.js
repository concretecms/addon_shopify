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
			$('div.product-list').prepend($('#pickedProduct').find('div.product'));
			$('#pickedProduct').html($(this).parent());
			$('.no-product-message').hide();
		});


		$('div.product').bind('click',function(){
			if($('#pickedProduct').find($(this)).length) {
				$('div.product-list').prepend($(this));
				$('#productID').val('');
				$('.no-product-message').show();
			} else {
				$('#productID').val($(this).attr('product-id'));
				$('div.product-list').prepend($('#pickedProduct').find('div.product'));
				$('#pickedProduct').html($(this));
				$('.no-product-message').hide();
			}
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
