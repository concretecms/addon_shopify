<?defined('C5_EXECUTE') or die(_("Access Denied."));

?>
<div class="well clearfix product">
	<div class="span2 scale-image" style="overflow:hidden">
		<img class="img-rounded" src="<?=$product->images[0]->src?>" style="max-width: 140px; max-height: 140px">
	</div>
	<div class="span3">
		<h4><?=$product->title?></h5>
		<p><?=strip_tags($product->body_html)?></p>
	</div>
	<span class="span6">
		<button class="btn btn-danger pull-right remove-product" ><?=t('Remove')?></button>
		<button class="btn btn-primary pull-right add-product" product-id="<?=$product->id?>"><?=t('Choose Product')?></button>
	</span>
</div>

