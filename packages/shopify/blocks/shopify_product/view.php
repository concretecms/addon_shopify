<?defined('C5_EXECUTE') or die(_("Access Denied."));
var_dump($product);
//var_dump($etc);

Loader::element('shopify_product',array('product'=>$product,'etc'=>$etc),'shopify');
