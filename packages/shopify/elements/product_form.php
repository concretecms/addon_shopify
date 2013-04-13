<?defined('C5_EXECUTE') or die(_("Access Denied."));
//var_dump($product);
$size = getimagesize($product->images[0]->src);
$width = $size[0];
$height = $size[1];
//$thumb = $ih->getThumbnail($product->images[0]->src,140,140,true);
//rename(DIR_BASE.$thumb->src,strstr(DIR_BASE.$thumb->src,'?',true));
//$thumb->src = strstr($thumb->src,'?',true);

?>
<div class="well span6 product">
	<div class="span2 scale-image" style="overflow:hidden">
		<img class="img-rounded" target-width="140" target-height="140" height="<?=$height?>" width="<?=$width?>" src="<?=$product->images[0]->src?>">
	</div>
	<div class="span3">
		<h4><?=$product->title?></h4>
		<p><?=strip_tags($product->body_html)?></p>
	</div>
	<span class="span6">
		<button class="btn btn-danger pull-right remove-product" ><?=t('Remove')?></button>
		<button class="btn btn-primary pull-right add-product" product-id="<?=$product->id?>"><?=t('Choose Product')?></button>
	</span>
</div>

