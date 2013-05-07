var shopifyProductBlock ={
	init:function(){
		this.tabSetup();
		this.productBinds();
		this.checkboxBind();
		this.imageScales();
	},
	tabSetup: function(){
		$('ul#ccm-blockEditPane-tabs li a').each( function(num,el){ 
			el.onclick=function(){
				var pane=this.id.replace('ccm-blockEditPane-tab-','');
				shopifyProductBlock.showPane(pane);
			}
		});		
	},

	imageScales: function() {
		$('img[data-image=product]').on('load', function() {
			$(this).attr('data-original-width', $(this).css('width').replace('px', ''));
			$(this).attr('data-original-height', $(this).css('height').replace('px',''));
			// now that we have the original height, we show the parent, and we add max width and max height to the image's css so it
			// shows scaled correctly
			$(this).css('max-width', 160).css('max-height', 160).show();

			if ($.contains($(this), $('#pickedProduct'))) {
				$('#pictureWidth').attr('data-original-width', $(this).attr('data-original-width')).attr('data-original-height', $(this).attr('data-original-height'));
				$('#pictureHeight').attr('data-original-width', $(this).attr('data-original-width')).attr('data-original-height', $(this).attr('data-original-height'));

				var $label = $('div[data-label=product-image-original] span');
				$label.html($(this).attr('data-original-width') + 'x' + $(this).attr('data-original-height')).parent().show();
			}
		});

		$('#pictureWidth,#pictureHeight').on('keyup', function(e) {
			if ((e.keyCode >= 48 || e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105)) {
				var originalWidth = parseInt($(this).attr('data-original-width'));
				var originalHeight = parseInt($(this).attr('data-original-height'));
				var srcWidth = parseInt($('#pictureWidth').val());
				var srcHeight = parseInt($('#pictureHeight').val());
			    var ratio = [srcWidth / originalWidth, srcHeight / originalHeight ];
			    if ($(this).attr('id') == 'pictureWidth') {
			    	var h = Math.ceil(originalHeight * ratio[0]);
			    	if (!h) {
			    		h = 0;
			    	}
				    $('#pictureHeight').val(h);
			    } else {
			    	var w = Math.ceil(originalWidth * ratio[1]);
			    	if (!w) {
			    		w = 0;
			    	}
				    $('#pictureWidth').val(w);
			    }
			}
		});
	},

	checkboxBind: function() {
		if($('#showPicture').is(':checked')) {
			$('.image-dimensions-form').show();
		}else{
			$('.image-dimensions-form').hide();
		}
		$('#showPicture').click(function() {
			if($(this).is(':checked')) {
				$('.image-dimensions-form').show();
			}else{
				$('.image-dimensions-form').hide();
			}
		});
	},

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
			var im = $(this).parent().parent().find('img[data-image=product]');
			$('#pictureWidth').attr('data-original-width', im.attr('data-original-width')).attr('data-original-height', im.attr('data-original-height')).val(im.attr('data-original-width'));
			$('#pictureHeight').attr('data-original-width', im.attr('data-original-width')).attr('data-original-height', im.attr('data-original-height')).val(im.attr('data-original-height'));

			var $label = $('div[data-label=product-image-original] span');
			$label.html(im.attr('data-original-width') + 'x' + im.attr('data-original-height')).parent().show();

			var old = $('#pickedProduct').find('div.product');
			old.find('button.remove-product').hide();
			old.find('button.add-product').show();
			$('div.search-form-results').prepend(old);//fix the button
			$('#pickedProduct').html($(this).parent().parent()); //this is garbage
			$('.no-product-message').hide();
			$(this).prev().show();
			$(this).hide();
			//$('#pickedProduct').focus();
		});

		$('button.remove-product').unbind().click(function(e) {
			e.preventDefault();
			$(this).parent().parent().remove();
			$('#productID').val('');
			$('.no-product-message').show();
			var $label = $('div[data-label=product-image-original]');
			$label.hide();
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
	$('img[data-image=product]').each(function() {
		$(this).attr('src', $(this).attr('src'));
	});
});
