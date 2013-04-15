<?defined('C5_EXECUTE') or die(_("Access Denied."));
//this is kinda dumb. but if we do a list we'll probably recycle the dang element.
Loader::element('shopify_product',array('product'=>$product,
	'showPicture'=>$showPicture,
	'imgSrc'=>$imgSrc,
	'showName'=>$showName,
	'showDescription'=>$showDescription,
	'showLink'=>$showLink,
	'showBuyThis'=>$showBuyThis,
	'linkText'=>$linkText,
	'linkURL'=>$linkURL,
	'cartURL'=>$cartURL
	),'shopify');
