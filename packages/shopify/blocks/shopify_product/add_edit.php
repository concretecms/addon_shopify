<?defined('C5_EXECUTE') or die(_("Access Denied."));

//echo $this->action('product_list').'&collectionID=0';
?>


<a id="action-urls" product-list="<?=$this->action('product_list')?>"></a>

<ul id="ccm-blockEditPane-tabs" class="ccm-dialog-tabs" style="margin-left:0">
	<li class="ccm-nav-active"><a id="ccm-blockEditPane-tab-product" href="javascript:void(0);"><?=t('Product') ?></a></li>
	<li class=""><a id="ccm-blockEditPane-tab-options"  href="javascript:void(0);"><?=t('Data Display')?></a></li>
</ul>

<div id="ccm-blockEditPane-product" class="ccm-blockEditPane">
	<input type="hidden" name="productID" id="productID" value="<?=is_object($chosenProduct) ? $chosenProduct->id : ''?>">
	<div id="pickedProduct">
	<?$style = '';
	 if(is_object($chosenProduct)) {
		echo Loader::element('product_form',array('product'=>$chosenProduct,'form'=>Loader::helper('form')),'shopify');
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
	<? }
		if (count($collections) > 1) { ?>
			<select name="collection" id="collection">
				<option value="0"><?= t('All Collections') ?></option>
			<?foreach($collections as $collection) {?>
				<option value="<?=$collection->id?>"><?=$collection->title?></option>
			<?}?>
			</select>
		<?}?>
		<h3 class="span4"><?=t('Choose a product');?></h3>
		<div class="product-list">
			<?if (is_object($chosenProduct)) {
				foreach ($availableProducts as $product) { //yeah this is lame.
					if($chosenProduct->id != $product->id) {
							echo Loader::element('product_form',array('product'=>$product,'form'=>Loader::helper('form')),'shopify');
					}
				}
			} else foreach ($availableProducts as $product) {
				echo Loader::element('product_form',array('product'=>$product,'form'=>Loader::helper('form')),'shopify');
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
					<input type="checkbox" name="showDescription" id="showDescription"<?=$showDescription ? ' checked':''?>><?=t('Product Description')?>
				</label>
				<label class="checkbox">
					<input type="checkbox" id="showLink" name="showLink"<?=$showLink ? ' checked':''?>><?=t('Purchase Link')?>
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
				<label for="pictureWidth"><?=t('Width');?></label>
				<input type="text" name="pictureWidth" id="pictureWidth" class="input-mini" value="<?=$width?>">
				<label for="pictureHeight"><?=t('Height');?></label>
				<input type="text" name="pictureHeight" id="pictureHeight" class="input-mini" value="<?=$pictureHeight?>">
			</div>
		</div>
	</fieldset>
	</div>
</div>
