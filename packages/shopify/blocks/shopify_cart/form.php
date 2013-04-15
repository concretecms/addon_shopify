<div class="ccm-block-field-group">
<h3><?=t('Cart Links Options')?></h3>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
	<td valign="top">
		<?=$form->checkbox('showCartLink', 1, $showCartLink)?> <?=$form->label('showCartLink', t('Show link to cart.'))?><br/>
		<span class="cc-cart-link" style="padding-left: 24px<?=($showCartLink?'':';display:none')?>"><?=$form->label('cartLinkText', t('Cart Link text'))?>: <?=$form->text('cartLinkText', $cartLinkText)?></span>
	</td>
</tr>
<tr>
	<td valign="top">
		<?=$form->checkbox('showItemQuantity', 1, $showItemQuantity)?> <?=$form->label('showItemQuantity', t('Show quantity of items in cart.'))?><br/>
	</td>
</tr>
<tr>
	<td valign="top">
		<?=$form->checkbox('showCheckoutLink', 1, $showCheckoutLink)?> <?=$form->label('showCheckoutLink', t('Show link to checkout directly.'))?><br/>
		<span class="cc-checkout-link" style="padding-left: 24px<?=($showCheckoutLink?'':';display:none')?>"><?=$form->label('checkoutLinkText', t('Checkout Link text'))?>: <?=$form->text('checkoutLinkText', $checkoutLinkText)?></span>
	</td>
</tr>
</table>
</div>

<div class="ccm-block-field-group">
<h3><?=t('Preview')?></h3>
<div class="cc-cart-links">
	<a href="#" class="cc-cart-link" <?=($showCartLink?'':'style="display:none"')?>><span class="cc-cart-text"><?=$cartLinkText?></span></a>
	<span class="cc-item-quantity" <?=($showItemQuantity?'':'style="display:none"')?>>(5 items)</span>
    <span class="cc-cart-links-divider" <?=(($showCartLink||$showItemQuantity)&&$showCheckoutLink?'':'style="display:none"')?>>|</span>
	<a href="#" class="cc-checkout-link" <?=($showCheckoutLink?'':'style="display:none"')?>><span class="cc-checkout-text"><?=$checkoutLinkText?></span></a>
</div >
</div>
