<?defined('C5_EXECUTE') or die(_("Access Denied."));
//var_dump($product);
?>
<div class="well span6 product" product-id="<?=$product->id?>">
	<div class="span2">
		<img width="140" height="140" class="img-rounded" src="<?=$product->images[0]->src?>">
	</div>
	<div class="span3">
		<h4><?=$product->title?></h5>
		<p><?=strip_tags($product->body_html)?></p>
	</div>
</div>

