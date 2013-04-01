<?defined('C5_EXECUTE') or die(_("Access Denied."));
?>
<?=Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Configure Shopify'),false, 'span8 offset2', false); ?>
<div class="ccm-pane-body">
<form class="form-horizontal" action="<?=$this->action('save')?>" method="post">
<legend><?= t('Shopify API Settings') ?></legend>
	<div class="control-group">
		<label class="control-label" for="myshopifyURL"><?=t('Store URL')?></label>
		<div class="controls">
			<div class="input-prepend">
				<span class="add-on span1">http://</span><input type="text" class="span3" id="myshopifyURL" name="myshopifyURL" value="<?=$myshopifyURL?>">
			</div>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="token"><?=t('Password')?></label>
		<div class="controls">
			<input type="text" id="token" name="token" class="span4" value="<?=$token?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="apikey"><?=t('API Key')?></label>
		<div class="controls">
			<input type="text" id="apikey" name="apikey" class="span4" value="<?=$apikey?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="secret"><?=t('Secret')?></label>
		<div class="controls">
			<input type="text" id="secret" name="secret" class="span4" value="<?=$secret?>">
		</div>
	</div>
</div>
	<div class="ccm-pane-footer">
		<input type="submit" class="primary ccm-button-v2-right btn" value="<?=t('Save')?>" />
</form>
<?=Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(false)?>
