<?defined('C5_EXECUTE') or die(_("Access Denied."));
?>

<ul id="ccm-blockEditPane-tabs" class="ccm-dialog-tabs" style="margin-left:0">
	<li class="ccm-nav-active"><a id="ccm-blockEditPane-tab-product" href="javascript:void(0);"><?=t('Product') ?></a></li>
	<li class=""><a id="ccm-blockEditPane-tab-options"  href="javascript:void(0);"><?=t('Data Display')?></a></li>
</ul>

<div id="ccm-blockEditPane-product" class="ccm-blockEditPane">
	<div id="pickedProduct">
	</div>
	<?if (count($localProducts)) {?>
		<ul>
		<?foreach($localProducts as $product) {?>
			<li><?=$product->getName()?></li>
		<?}?>
		</ul>
	<? } else {?>
		<span class="alert span4"><?= t("you haven't picked any products yet.") ?></span>
	<?}?>
		<h3 class="span4"><?=t('Choose a product');?></h3>
			<?foreach ($availableProducts as $product) {
				echo Loader::element('product_form',array('product'=>$product,'form'=>Loader::helper('form')),'shopify');
			}?>
</div>
<div id="ccm-blockEditPane-options" class="ccm-blockEditPane" style="display:none">
	<legend><?= t('Display options') ?></legend>
	<fieldset>
		<div class="control-group">
			<label class="control-label" ><?=t('Product Details')?></label>
			<div class="controls">
				<label class="checkbox">
					<input type="checkbox" id="showName"<?=$showName ? ' checked':''?>><?=t('Product Name')?>
				</label>
				<label class="checkbox">
					<input type="checkbox" id="showDescription"<?=$showDescription ? ' checked':''?>><?=t('Product Description')?>
				</label>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="name"><?=t('Image')?></label>
			<div class="controls">
				<label class="checkbox">
					<input type="checkbox" id="showPicture"<?=$showPicture ? ' checked':''?>><?=t('Product Image')?>
				</label>
				<label for="pictureWidth"><?=t('Width');?></label>
				<input type="text" id="width" class="input-mini" value="<?=$width?>">
				<label for="pictureHeight"><?=t('Height');?></label>
				<input type="text" id="pictureHeight" class="input-mini" value="<?=$pictureHeight?>">
			</div>
		</div>
	</fieldset>
	</div>
</div>
