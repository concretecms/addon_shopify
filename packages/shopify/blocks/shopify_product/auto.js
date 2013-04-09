var shopifyProductBlock ={
	init:function(){
		this.tabSetup();
	},
	tabSetup: function(){
		$('ul#ccm-blockEditPane-tabs li a').each( function(num,el){ 
			el.onclick=function(){
				var pane=this.id.replace('ccm-blockEditPane-tab-','');
				shopifyProductBlock.showPane(pane);
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
	//$('#collections').change(function(){
		////replace html with action_categories
		////re-bind click events
	//});
});
