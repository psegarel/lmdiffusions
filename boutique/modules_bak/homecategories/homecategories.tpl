<!-- MODULE Home categories created by Alpha Media (09 May 2008) -->
{if isset($categories) AND $categories}

<div id="home-categories" class="clearfix">
{foreach from=$categories item=category name=homeCategories}
{assign var='categoryLink' value=$link->getcategoryLink($category.id_category, $category.link_rewrite)}
    
    <div class="home-category {if $smarty.foreach.homeCategories.last}last-item{/if}">                    

        <a href="{$categoryLink}" title="{$category.legend}"><img src="{$img_cat_dir}{$category.id_category}-category.jpg" alt="{$category.name}" /></a>
        
        <p>
        
        </p>
        <a href="{$categoryLink}" title="{$categoryName}" class="eatme"></a>
        
    </div>
    
{/foreach}
</div>
{else}
<p>{l s='No categories' mod='homecategories'}</p>
{/if}
<!-- END MODULE Home categories --> 


