<?defined('C5_EXECUTE') or die(_("Access Denied."));
//defaults:
$defaults = array('showName','showLink','showBuyThis');

if(!isset($linkText)) {
	$linkText = t('Add To Cart');
}

foreach($defaults as $default) {
	if(!isset(${$default})) {
		${$default} = 1;
	}
}

//echo $this->action('product_list').'&collectionID=0';
	//button[class*='product-'] {
?>

<ul id="ccm-blockEditPane-tabs" class="ccm-dialog-tabs" style="margin-left:0">
	<li class="ccm-nav-active"><a id="ccm-blockEditPane-tab-product" href="javascript:void(0);"><?=t('Product') ?></a></li>
	<li class=""><a id="ccm-blockEditPane-tab-options"  href="javascript:void(0);"><?=t('Data Display')?></a></li>
</ul>

<div id="ccm-blockEditPane-product" class="ccm-blockEditPane">
	<input type="hidden" name="productID" id="productID" value="<?=is_object($chosenProduct) ? $chosenProduct->id : ''?>">
	<h3><?= t('Selected Product:') ?></h3>
	<div id="pickedProduct" tabindex="100">
	<?$style = '';
	 if(is_object($chosenProduct)) {
		echo Loader::element('product_form',array('product'=>$chosenProduct,'ih'=>Loader::helper('image')),'shopify');
		$style = ' style="display:none"';
	}?>
	</div>
	<div class="no-product-message alert"<?=$style?>><?= t("No product selected.") ?></div>
	<div class="clearfix">

		<div class="search-form">

			<h3><?=t('Choose a product');?></h3>

			<input type="search" data-input="shopify-keywords" name="keywords" class="span2" placeholder="<?=t('Search')?>" />

			<select data-select="shopify-type" class="span2">
				<option value=""><?= t('All Products') ?></option>
			<?foreach($types as $type) {?>
				<option value="<?=$type?>"><?=$type?></option>
			<?}?>
			</select>
			<button type="button" class="btn" data-submit="shopify-search"><?=t('Search')?></button>

			<img src="<?=ASSETS_URL_IMAGES?>/loader_intelligent_search.gif" width="43" height="11" class="shopify-loader" style="display: none" />
		</div>

		<div class="search-form-results" style="margin-top: 10px">
			<div class="alert alert-info"><?=t('Search for products using the form above.')?></div>
		</div>
	</div>

	<? /*

	<div class="clearfix">
	</div>
	<div class="product-list clearfix">
		<?if (is_object($chosenProduct)) {
			foreach ($availableProducts as $product) { //yeah this is lame.
				if($chosenProduct->id != $product->id) {
						echo Loader::element('product_form',array('product'=>$product,'ih'=>Loader::helper('image')),'shopify');
				}
			}
		} else foreach ($availableProducts as $product) {
			echo Loader::element('product_form',array('product'=>$product,'ih'=>Loader::helper('image')),'shopify');
		}?>
	</div>
		*/ ?>
</div>
<div id="ccm-blockEditPane-options" class="ccm-blockEditPane" style="display:none">
	<legend><?= t('Display options') ?></legend>
	<fieldset>
		<div class="control-group">
			<label class="control-label" ><?=t('Product Details')?></label>
			<div class="controls">
				<label class="checkbox">
					<input type="checkbox" name="showName" id="showName"<?=$showName ? ' checked':''?>><?=t('Product Name')?>
				</label>
				<label class="checkbox">
					<input type="checkbox" id="showLink" name="showLink"<?=$showLink ? ' checked':''?>><?=t('Link To Product Page On Shopify')?>
				</label>
				<label class="checkbox">
					<input type="checkbox" name="showDescription" id="showDescription"<?=$showDescription ? ' checked':''?>><?=t('Product Description')?>
				</label>
				<label class="checkbox">
					<input type="checkbox" id="showBuyThis" name="showBuyThis"<?=$showBuyThis ? ' checked':''?>><?=t('Show Add-To-Cart Button')?>
				</label>
				
				<label for="linkText"><?=t('Button Text');?></label>
				<input type="text" id="linkText" name="linkText" value="<?=$linkText?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="showPicture"><?=t('Image')?></label>
			<div class="controls">
				<label class="checkbox">
					<input type="checkbox" id="showPicture" name="showPicture"<?=$showPicture ? ' checked':''?>><?=t('Product Image')?>
				</label>
			</div>
		</div>
		<div class="control-group image-dimensions-form">
			<label class="control-label" for="pictureWidth"><?=t('Width')?></label>
			<div class="controls">
				<input type="text" name="pictureWidth" id="pictureWidth" class="input-mini" value="<?=$pictureWidth?>">
			</div>
		</div>

		<div class="control-group image-dimensions-form">
			<label class="control-label" for="pictureHeight"><?=t('Height')?></label>
			<div class="controls">
				<input type="text" name="pictureHeight" id="pictureHeight" class="input-mini" value="<?=$pictureHeight?>">
				<div data-label="product-image-original" style="display: none; color: #999">
					<br/>
					<?=t('Full Dimensions:')?> <span></span>
				</div>
			</div>
	
		</div>


	</fieldset>
</div>

<script type="text/javascript">

ccm_shopifySearch = function() {
	$('.shopify-loader').show();
	var req = '<?=Loader::helper("concrete/urls")->getToolsURL("products/search", "shopify")?>';
	$.ajax({
		dataType: 'html',
		type: 'post',
		url: req,
		data: [{
			name: 'keywords',
			value: $('input[data-input=shopify-keywords]').val()
		}, {
			name: 'type',
			value: $('select[data-select=shopify-type]').val()
		}],
		success: function(resp) {
			$('.search-form-results').html(resp);
		},
		complete: function() {
			$('.shopify-loader').hide();
			shopifyProductBlock.productBinds();
			shopifyProductBlock.imageScales();
		}
	});
}

$(function() {
	$('button[data-submit=shopify-search]').on('click', function() {
		ccm_shopifySearch();
	});
	$('input[data-input=shopify-keywords]').on('keydown', function(e) {
		if (e.keyCode == 13) {
			e.preventDefault();
			ccm_shopifySearch();
		}
	});
});
</script>
