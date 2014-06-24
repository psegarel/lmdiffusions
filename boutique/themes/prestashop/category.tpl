{include file=$tpl_dir./breadcrumb.tpl} 

{include file=$tpl_dir./errors.tpl}

{if $category->active}

<h2 class="category_title">
	{$category->name|escape:'htmlall':'UTF-8'}
	<span>{$nb_products|intval}&nbsp;{if $nb_products>1}{l s='products'}{else}{l s='product'}{/if}</span>
</h2>

{if $scenes}
	<!-- Scenes -->
	{include file=$tpl_dir./scenes.tpl scenes=$scenes}
{else}
	<!-- Category image -->
	{if $category->id_image}
		
	{/if}
{/if}	

  {if $category->description}
    <div class="cat_desc">{$category->description}</div>
  {/if}
  
	{if isset($subcategories)}
    
    
	<!-- Subcategories -->
	<div id="subcategories">
		
		<ul class="inline_list">
		{foreach from=$subcategories item=subcategory}
			<li>
				<a href="{$link->getCategoryLink($subcategory.id_category, $subcategory.link_rewrite)|escape:'htmlall':'UTF-8'}" title="{$subcategory.name|escape:'htmlall':'UTF-8'}">
					<img src="{$img_cat_dir}{if $subcategory.id_image}{$subcategory.id_image}{else}default{/if}-medium.jpg" alt="" />
				</a>
				<br />
				<a href="{$link->getCategoryLink($subcategory.id_category, $subcategory.link_rewrite)|escape:'htmlall':'UTF-8'}">{$subcategory.name|escape:'htmlall':'UTF-8'}</a>
			</li>
		{/foreach}
		</ul>
		<br class="clear"/>
	</div>
	{/if}

  {if $products}
		{include file=$tpl_dir./product-sort.tpl}
		{include file=$tpl_dir./product-list.tpl products=$products}
		{include file=$tpl_dir./pagination.tpl}
	{elseif !isset($subcategories)}
		<p class="warning">{l s='There is no product in this category.'}</p>
	{/if}
{else}
	<p class="warning">{l s='This category is currently unavailable.'}</p>
{/if}
