<?defined('C5_EXECUTE') or die(_("Access Denied.")); ?>

<? if ($controller->getTask() == 'add') { 
	$shopifyCollectionType = 'C';
	$numResults = 10;
}
?>

<fieldset>
	<legend style="margin-bottom: 0px" ><?=t('Display Products In')?></legend>
	<div class="control-group">
		<div class="controls">
			<label class="radio"><?=$form->radio('shopifyCollectionType', 'C', $shopifyCollectionType)?> <span><?=t('A custom collection')?></span></label>
			<?=$form->select('customCollectionID', $customCollections, $customCollectionID)?></label>
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			<label class="radio"><?=$form->radio('shopifyCollectionType', 'S', $shopifyCollectionType)?> <span><?=t('A smart collection')?></span></label>
			<?=$form->select('smartCollectionID', $smartCollections, $smartCollectionID)?></label>
		</div>
	</div>
</fieldset>

<fieldset>
	<legend style="margin-bottom: 0px" ><?=t('Product List')?></legend>
	<div class="control-group">
		<?=$form->label('numResults', t('# Results to DIsplay'))?>
		<div class="controls">
			<?=$form->text('numResults', $numResults, array("class" => "span2"))?>
		</div>
	</div>
</fieldset>
