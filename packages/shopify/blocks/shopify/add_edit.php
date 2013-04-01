<?defined('C5_EXECUTE') or die(_("Access Denied."));
?>

<div class="ccm-block-field-group">
<?if (count($localProducts)) {?>
	<ul>
	<?foreach($localProducts as $product) {?>
		<li><?=$product->getName()?></li>
	<?}?>
	</ul>
<? } else {?>
	<span class="alert clearfix"><?= t("you haven't picked any products yet.") ?></span>
<?}?>
<legend><?=t('Products');?></legend>
	<?foreach ($availableProducts as $product) {
		echo Loader::element('product_form',array('product'=>$product,'form'=>Loader::helper('form')),'shopify');
	}?>
