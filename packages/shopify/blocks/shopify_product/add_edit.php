<?defined('C5_EXECUTE') or die(_("Access Denied."));

//echo $this->action('product_list').'&collectionID=0';
	//button[class*='product-'] {
?>
<a id="action-urls" product-list="<?=$this->action('product_list')?>"></a>

<ul id="ccm-blockEditPane-tabs" class="ccm-dialog-tabs" style="margin-left:0">
	<li class="ccm-nav-active"><a id="ccm-blockEditPane-tab-product" href="javascript:void(0);"><?=t('Product') ?></a></li>
	<li class=""><a id="ccm-blockEditPane-tab-options"  href="javascript:void(0);"><?=t('Data Display')?></a></li>
</ul>

<div id="ccm-blockEditPane-product" class="ccm-blockEditPane">
	<input type="hidden" name="productID" id="productID" value="<?=is_object($chosenProduct) ? $chosenProduct->id : ''?>">
	<h3 class = "span6"><?= t('Featured Product:') ?></h3>
	<div id="pickedProduct">
	<?$style = '';
	 if(is_object($chosenProduct)) {
		echo Loader::element('product_form',array('product'=>$chosenProduct,'ih'=>Loader::helper('image')),'shopify');
		$style = ' style="display:none"';
	}?>
	</div>
	<span class="no-product-message alert span4"<?=$style?>><?= t("No product selected.") ?></span>
	<?if (count($localProducts)) {?>
		<ul>
		<?foreach($localProducts as $product) {?>
			<li><?=$product->getName()?></li>
		<?}?>
		</ul>
	<? }?>
		<div class="clearfix">
		<?if (count($collections) > 1) { ?>
			<select name="collection" id="collection">
				<option value="0"><?= t('All Collections') ?></option>
			<?foreach($collections as $collection) {?>
				<option value="<?=$collection->id?>"><?=$collection->title?></option>
			<?}?>
			</select>
		<?}?>
		<h3 class="span4"><?=t('Choose a product');?></h3>
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
					<input type="checkbox" id="showBuyThis" name="showBuyThis"<?=$showBuyThis ? ' checked':''?>><?=t('Show add-to-cart link')?>
				</label>
				
				<label for="linkText"><?=t('Link Text');?></label>
				<input type="text" id="linkText" name="linkText" value="<?=$linkText?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="name"><?=t('Image')?></label>
			<div class="controls">
				<label class="checkbox">
					<input type="checkbox" id="showPicture" name="showPicture"<?=$showPicture ? ' checked':''?>><?=t('Product Image')?>
				</label>
				<div class="input-append span3 clearfix">
					<input type="text" name="pictureWidth" id="pictureWidth" class="input-mini" value="<?=$pictureWidth?>"><span class="add-on"><?= t('px') ?></span><span class="help-inline"><?=t('Width');?></span>
				</div>
				<div class="input-append span3 clearfix">
					<input type="text" name="pictureHeight" id="pictureHeight" class="input-mini" value="<?=$pictureHeight?>"><span class="add-on"><?= t('px') ?></span><span class="help-inline"><?=t('Height');?></span>
				</div>
			</div>
		</div>
	</fieldset>
	</div>
</div>
