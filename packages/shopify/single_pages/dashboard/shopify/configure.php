<?defined('C5_EXECUTE') or die(_("Access Denied."));
?>
<?=Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Setup Shopify'), false, 'span10 offset1'); ?>

<? if ($this->controller->getTask() == 'setup_complete') { ?>


	<div class="alert alert-success"><?=t("You have successfully connected to your Shopify account!")?></div>

	<form class="form-horizontal">
		<legend><?=t('Settings')?></legend>
		<div class="control-group">
			<label class="control-label"><?=t('Store URL')?></label>
			<div class="controls">
				<input type="text" class="span4" disabled="disabled" value="<?=$myshopifyURL?>" />
			</div>
		</div>

		<div class="control-group">
			<label class="control-label"><?=t('API Key')?></label>
			<div class="controls">
				<input type="text" class="span4" disabled="disabled" value="<?=$apikey?>" />
			</div>
		</div>

		<div class="control-group">
			<label class="control-label"><?=t('Password')?></label>
			<div class="controls">
				<input type="text" class="span4" disabled="disabled" value="<?=$password?>" />
			</div>
		</div>
	</form>

	<form method="post" action="<?=$this->action('reset')?>">
		<?=Loader::helper('validation/token')->output('do_reset')?>
		<div class="alert alert-info"><?=t('Need to re-enter your Shopify settings? Hit the reset button below.')?></div>
		<br/>
		<div style="text-align: center">
			<button type="submit" class="btn btn-large"><?=t('Reset Settings')?></button>
		</div>
	</form>



<? } else if ($this->controller->getTask() == 'set_api_information' || $this->controller->getTask() == 'save_api_information') { ?>

<h3><?=t('Step 3. App API and Password')?></h3><br/>

<p><?=t("Now you'll need to enter some information that you can find in the App Store section of your Shopify store.")?></p>

<ol>
	<li><?=t('Login to your Shopify Website: %s', '<strong><a target="_blank" href="https://' . $myshopifyURL . '/admin/">https://' . $myshopifyURL . '/admin/</a></strong>')?></li>
	<li><?=t('Visit the Private Apps section of your Shopify admin area. This can be found here: %s', '<strong><a target="_blank" href="https://' . $myshopifyURL . '/admin/apps/private">https://' . $myshopifyURL . '/admin/apps/private</a></strong>')?></li>
	<li><?=t('Click the "Generate Private App" button.')?></li>
	<li><?=t("On the next screen, copy down the <strong>API Key</strong> and <strong>Password</strong> information.")?></li>
	<li><?=t('Enter that information below, then click the "Save and Finish" button.')?></li>
</ol>

<br/>

<form method="post" action="<?=$this->url('/dashboard/shopify/configure', 'save_api_information')?>" class="form-horizontal">


	<div class="control-group">
		<label class="control-label" for="apikey"><?=t('API Key')?></label>
		<div class="controls">
			<?=$form->text('apikey', $apikey, array('class' => 'span4'))?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="password"><?=t('Password')?></label>
		<div class="controls">
			<?=$form->text('password', $apikey, array('class' => 'span4'))?>
		</div>
	</div>

	<br/>

	<div style="text-align: center">
		<button type="submit" class="btn btn-success btn-large"><?=t('Save and Finish')?></button>
	</div>


</form>



<? } else { ?>

<h3><?=t('Step 1. Get a Shopify Store')?></h3><br/>

<div>
	<a href="http://www.shopify.com/?ref=concrete5" target="_blank"><img style="border: 1px solid black; border-radius: 5px" src="<?=$bannerImg?>" /></a>
</div>
<br/>

<div class="alert alert-info"><?=t('Already have a Shopify store? Skip to Step 2.')?></div>

<h3><?=t('Step 2. Enter Your Store URL')?></h3><br/>

<form method="post" action="<?=$this->url('/dashboard/shopify/configure', 'set_store')?>" class="form-horizontal">

	<div class="control-group">
		<label class="control-label" for="myshopifyURL"><?=t('Store URL')?></label>
		<div class="controls">
			<div class="input-prepend">
				<span class="add-on span1">http://</span><input type="text" class="span3" id="myshopifyURL" name="myshopifyURL" placeholder="yourstore.myshopify.com" value="<?=$myshopifyURL?>">
			</div>
		</div>
	</div>

	<? if ($canAddExternalLink) { ?>

	<div class="control-group">
		<div class="controls">
			<label class="checkbox"><?=$form->checkbox('includeStoreLink', 1, $includeStoreLink)?> <span><?=t('Include external link to store in top level navigation.')?></span></label>
		</div>
	</div>
	<div class="control-group" data-field="link-text">
		<label class="control-label" for="myshopifyURL"><?=t('Link Text')?></label>
		<div class="controls">
			<?=$form->text('storeLinkText', $storeLinkText)?>
		</div>
	</div>
	
	<? } ?>
	
	<br/>

	<div style="text-align: center">
		<button type="submit" class="btn btn-success btn-primary"><?=t('Save and Continue')?></button>
	</div>


</form>

<script type="text/javascript">
$(function() {
	$('input[name=includeStoreLink]').on('change', function() {
		if ($(this).is(':checked')) {
			$('div[data-field=link-text]').show();
		} else {
			$('div[data-field=link-text]').hide();
		}
	}).trigger('change');
});
</script>
<? } ?>
<?=Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper()?>
