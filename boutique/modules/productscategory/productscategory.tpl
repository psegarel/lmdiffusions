{if count($categoryProducts) > 1}
<script type="text/javascript">var middle = {$middlePosition};</script>
<script type="text/javascript" src="{$base_dir}modules/productscategory/js/productscategory.js"></script>
<ul class="idTabs">
	<li><a href="#idTab3">{l s='In the same category' mod='productscategory'}</a></li>
</ul>

<div id="{if count($categoryProducts) > 5}productscategory{else}productscategory_noscroll{/if}">
{if count($categoryProducts) > 5}<a id="productscategory_scroll_left" title="{l s='Previous' mod='productscategory'}" href="javascript:{ldelim}{rdelim}">{l s='Previous' mod='productscategory'}</a>{/if}
<div id="productscategory_list">
	<ul {if count($categoryProducts) > 5}style="width: {math equation="width * nbImages" width=107 nbImages=$categoryProducts|@count}px"{/if}>
		{foreach from=$categoryProducts item='categoryProduct' name=categoryProduct}
		<li {if count($categoryProducts) < 6}style="width: {math equation="width / nbImages" width=94 nbImages=$categoryProducts|@count}%"{/if}>
			<a href="{$link->getProductLink($categoryProduct.id_product, $categoryProduct.link_rewrite, $categoryProduct.category)}" title="{$categoryProduct.name|htmlspecialchars}">
				<img src="{$img_prod_dir}{$categoryProduct.id_image}-small.jpg" alt="{$categoryProduct.name|htmlspecialchars}" />
			</a><br/>
			<a href="{$link->getProductLink($categoryProduct.id_product, $categoryProduct.link_rewrite, $categoryProduct.category)}" title="{$categoryProduct.name|htmlspecialchars}">
			{$categoryProduct.name|truncate:15}
			</a>
		</li>
		{/foreach}
	</ul>
</div>
{if count($categoryProducts) > 5}<a id="productscategory_scroll_right" title="{l s='Next' mod='productscategory'}" href="javascript:{ldelim}{rdelim}">{l s='Next' mod='productscategory'}</a>{/if}
</div>
{/if}
