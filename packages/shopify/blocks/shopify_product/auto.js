var shopifyProductBlock ={
	init:function(){
		this.tabSetup();
		this.productBinds();
		//this.imageScales();
	},
	tabSetup: function(){
		$('ul#ccm-blockEditPane-tabs li a').each( function(num,el){ 
			el.onclick=function(){
				var pane=this.id.replace('ccm-blockEditPane-tab-','');
				shopifyProductBlock.showPane(pane);
			}
		});		
	},
	/*
	imageScales: function() {
		//this doesn't fucking work.. The divs seem to be whatever size they want to be.
		console.log("COME ON");
		var $images = $('.scale-image img');
		$images.each(function(){
			var widthTarget = $(this).attr('target-width');
			var heightTarget = $(this).attr('target-height');
			var widthStart = $(this).width();
			var heightStart = $(this).height();

			widthDiff = $(this).width() - widthTarget;
			heightDiff = $(this).height() - heightTarget;

			console.log("width:"+widthDiff+" height:"+heightDiff);

			var widthRatio = widthTarget / $(this).width();
			var heightRatio = heightTarget / $(this).height();

			////direction = widthDiff - heightDiff;
			if (widthDiff > heightDiff) {
				$(this).height(heightTarget);
				$(this).width(widthStart*heightRatio);
				//$(this).css('margin-left',-1*(widthStart-$(this).width()/2));
			} else {
				$(this).width(widthTarget);
				$(this).height(heightStart/widthRatio);
				//$(this).css('margin-top',-1*(heightDiff*widthRatio/2));
			}


			//width > container or height > container

		});
	},
	*/

	productBinds: function() {
		$('div.search-form-results button.add-product').show();
		$('div.search-form-results button.remove-product').hide();
		$('#pickedProduct button.add-product').hide();
		$('#pickedProduct button.remove-product').show();

		$('button.add-product').unbind().click(function(e) {
			e.preventDefault();
			$('#productID').val($(this).attr('product-id'));
			var d = $(this).closest('.ui-dialog-content').get(0);
			d.scrollTop = 0;
			var old = $('#pickedProduct').find('div.product');
			old.find('button.remove-product').hide();
			old.find('button.add-product').show();
			$('div.search-form-results').prepend(old);//fix the button
			$('#pickedProduct').html($(this).parent().parent()); //this is garbage
			$('.no-product-message').hide();
			$(this).prev().show();
			$(this).hide();
			$('#pickedProduct').focus();
		});

		$('button.remove-product').unbind().click(function(e) {
			e.preventDefault();
			$(this).parent().parent().remove();
			$('#productID').val('');
			$('.no-product-message').show();
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
	/*
	//$('div.product-list').imagesLoaded(shopifyProductBlock.imageScales());
	$('#collection').change(function(){
		$.get($('#action-urls').attr('product-list')+'&collectionID='+$('#collection').val(),function(data){
			$('div.product-list').html(data);
			shopifyProductBlock.productBinds();
		});
	});
	*/
});
