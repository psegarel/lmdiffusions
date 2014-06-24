{if isset($products)}
	<div id="liste_produits">
	<!-- Products list -->
	<ul id="product_list" class="clear">
	{foreach from=$products item=product name=products}

		{if ($product.allow_oosp OR $product.quantity > 0)}
		<li class="ajax_block_product {if $smarty.foreach.products.first}first_item{elseif $smarty.foreach.products.last}last_item{/if} {if $smarty.foreach.products.index % 2}alternate_item{else}item{/if}">
			<div class="center_block">

				<a href="{$product.link|escape:'htmlall':'UTF-8'}" class="product_img_link" title="{$product.name|escape:'htmlall':'UTF-8'}"><img src="{$img_prod_dir}{$product.id_image}-medium.jpg" alt="{$product.legend|escape:'htmlall':'UTF-8'}" /></a>
			</div>

		  <h3><a href="{$product.link|escape:'htmlall':'UTF-8'}" title="{$product.legend|escape:'htmlall':'UTF-8'}">{$product.name|truncate:35|escape:'htmlall':'UTF-8'}</a></h3>

			<div class="right_block">
				{if $product.on_sale}
					<span class="on_sale">{l s='On sale!'}</span>
				{elseif ($product.reduction_price != 0 || $product.reduction_percent != 0) && ($product.reduction_from == $product.reduction_to OR ($smarty.now|date_format:'%Y-%m-%d' <= $product.reduction_to && $smarty.now|date_format:'%Y-%m-%d' >= $product.reduction_from))}
					<span class="discount">{l s='Price lowered!'}</span>
				{/if}

				<span class="price">{convertPrice price=$product.price}</span>
				<span class="availability">{if ($product.allow_oosp OR $product.quantity > 0)}{l s='Available'}{else}{l s='Out of stock'}{/if}</span>
				{if ($product.allow_oosp OR $product.quantity > 0) && $product.customizable != 2}
					<div class="ajouter_panier">
					<a class="button ajax_add_to_cart_button exclusive" rel="ajax_id_product_{$product.id_product|intval}" href="{$base_dir}cart.php?add&amp;id_product={$product.id_product|intval}&amp;token={$static_token}">{l s='Add to cart'}</a>
					</div>
				{else}
						<span class="exclusive">{l s='Add to cart'}</span>
				{/if}

				<!--
				<a class="button" href="{$product.link|escape:'htmlall':'UTF-8'}" title="{l s='View'}">{l s='View'}</a>
				-->
			</div>
		</li>
		{/if}
	{/foreach}
	</ul>
	</div>
	<!-- /Products list -->
	<br class="clear_list" / >
{/if}