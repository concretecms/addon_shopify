var shopifyProductBlock ={
	init:function(){
		this.tabSetup();
		//this.bindProducts();
	},
	productClick: function(){
		//console.log($(this));
		$(this).removeClass('product');
		$(this).addClass('picked-product');
		if($('#pickedProduct').html()) {
			$('div.product-list').prepend($('#pickedProduct').html());
		}
		$('#pickedProduct').html($(this));
		$('#productID').val($(this).attr('product-id'));
		$('.no-product-message').hide();
		$(this).unbind('click');
		$(this).bind('click',function(){shopifyProductBlock.pickedProductClick.call(this)});
	},
	pickedProductClick: function(){
		$(this).removeClass('picked-product');
		$(this).addClass('product');
		$('div.product-list').prepend($(this));
		$(this).remove();
		if(!$('#pickedProduct').html()) {
			$('.no-product-message').show();
		}
		$(this).unbind('click');
		$(this).bind('click',function(){shopifyProductBlock.productClick.call(this)});
	},
	bindProducts: function(){
		$('div.product').bind('click',shopifyProductBlock.productClick.call(this));
		$('div.picked-product').bind('click',shopifyProductBlock.pickedProductClick.call(this));
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
	$('div.product').bind('click',function(){shopifyProductBlock.productClick.call(this)});
	$('div.picked-product').bind('click',function(){shopifyProductBlock.pickedProductClick.call(this)});
});
