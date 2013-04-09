<?defined('C5_EXECUTE') or die(_("Access Denied."));
Loader::element('shopify_product',array('product'=>$product,
	'showPicture'=>$showPicture,
	'imgSrc'=>$imgSrc,
	'showName'=>$showName,
	'showDescription'=>$showDescription,
	'showLink'=>$showLink,
	'linkText'=>$linkText,
	'linkURL'=>$linkURL
	),'shopify');
