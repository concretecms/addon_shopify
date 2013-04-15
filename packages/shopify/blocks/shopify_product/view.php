<?defined('C5_EXECUTE') or die(_("Access Denied."));
//this is kinda dumb. but if we do a list we'll probably recycle the dang element.
echo '<script type="text/javascript"> var SHOPIFY_CART_URL ="'.$cartURL.'"; </script>';
Loader::element('shopify_product',array('product'=>$product,
	'showPicture'=>$showPicture,
	'imgSrc'=>$imgSrc,
	'showName'=>$showName,
	'showDescription'=>$showDescription,
	'showLink'=>$showLink,
	'pictureWidth'=>$pictureWidth,
	'pictureHeight'=>$pictureHeight,
	'showBuyThis'=>$showBuyThis,
	'linkText'=>$linkText,
	'linkURL'=>$linkURL,
	'cartURL'=>$cartURL
	),'shopify');
