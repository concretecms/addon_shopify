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
		<?=$form->checkbox('showSubtotal', 1, $showSubtotal)?> <?=$form->label('showSubtotal', t('Show the cost of the items in the cart.'))?><br/>
	</td>
</tr>
</table>
</div>

<div class="ccm-block-field-group">
<h3><?=t('Preview')?></h3>
<div class="cc-cart-links">
	<a href="#" class="cc-cart-link" <?=($showCartLink?'':'style="display:none"')?>><span class="cc-cart-text"><?=$cartLinkText?></span></a>
	<span class="cc-item-quantity" <?=($showItemQuantity?'':'style="display:none"')?>>(5 items)</span>
	<span class="cc-cart-pipe" <?=$showItemQuantity && $showSubtotal ? '' : 'style="display:none"'?>>|</span>
	<span class="cc-item-subtotal" <?=($showSubtotal?'':'style="display:none"')?>>($50.00)</span>
</div >
</div>
