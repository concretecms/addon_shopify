<?php defined('C5_EXECUTE') or die('Access Denied');
class ShopifyProduct extends Object {

	protected $title;
	protected $html;
	protected $vendor;
	protected $type;
	protected $variants;

	public function __get($property) {
		return $this->{$property};
	}

	public function __construct($array) {
		$this->title = $array['title'];
		$this->html = $array['body_html'];
		$this->vendor = $array['vendor'];
		$this->type = $array['product_type'];
		$this->variants = $array['variants'];
	}

}