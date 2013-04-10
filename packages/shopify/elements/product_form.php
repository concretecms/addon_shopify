<?defined('C5_EXECUTE') or die(_("Access Denied."));
//var_dump($product);
?>
<div class="well span6 product" product-id="<?=$product->id?>">
	<div class="span2 scale-image" style="overflow:hidden" desired-fucking-height="140" desired-fucking-width="140">
		<img class="img-rounded" src="<?=$product->images[0]->src?>">
	</div>
	<div class="span3">
		<h4><?=$product->title?></h5>
		<p><?=strip_tags($product->body_html)?></p>
	</div>
	<span class="span6">
		<button class="btn btn-danger pull-right remove-product" style="margin-right:16px"><?=t('Remove')?></button>
		<button class="btn btn-primary pull-right add-product" style="margin-right:16px"><?=t('Choose Product')?></button>
	</span>
</div>

