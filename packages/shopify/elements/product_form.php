<?defined('C5_EXECUTE') or die(_("Access Denied."));
//var_dump($product);
//$size = getimagesize($product->images[0]->src);
//$width = $size[0];
//$height = $size[1];
//$thumb = $ih->getThumbnail($product->images[0]->src,140,140,true);
//rename(DIR_BASE.$thumb->src,strstr(DIR_BASE.$thumb->src,'?',true));
//$thumb->src = strstr($thumb->src,'?',true);

?>
<div class="well clearfix product">
	<div style="float: left; width: 160px;">
		<img data-image="product" id="im<?=$product->id?>" src="<?=$product->images[0]->src?>" style="display: none; border: 1px solid #999; border-radius: 6px;" />
	</div>
	<div style="float: left; width: 160px; margin-left: 20px">
		<h4><?=$product->title?></h4>
		<p><?=strip_tags($product->body_html)?></p>
	</div>
	<div style="width: 160px; margin-left: 20px; float: left; text-align: right">
		<button class="btn btn-danger pull-right remove-product" ><?=t('Remove')?></button>
		<button class="btn btn-primary pull-right add-product" product-id="<?=$product->id?>"><?=t('Choose Product')?></button>
	</div>
</div>