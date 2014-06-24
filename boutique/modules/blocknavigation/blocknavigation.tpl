<!-- Block navigation module -->
<div id="navigation_block_left" class="block">
	<h4>{l s='Navigation' mod='blocknavigation'}</h4>
	<div class="block_content">
	{if $show_search==1}
<!-- Navigation: search -->
	<form method="get" action="{$base_dir}search.php" id="my_searchbox">
		{l s='Search:' mod='blocknavigation'}&nbsp;<input type="text" id="my_search_query" class="min_search" name="search_query" value="{if isset($smarty.get.search_query)}{$smarty.get.search_query|htmlentities:$ENT_QUOTES:'utf-8'}{/if}" />
		<input type="submit" id="my_search_button" class="button_mini" style="display:none" value="{l s='go' mod='blocknavigation'}" />
	</form>
<!-- /Navigation: search -->
	{/if}

	{if $show_cat==1}
<!-- Navigation: categories -->
	{foreach from=$cat_sel item=sel}
		{assign var=n value=0}
		{foreach from=$sel item=opt}
		{if $n==0}
		<select id="categories_{$opt.id}" class="max_input" name="categories_{$opt.id}" onchange="autoUrl('categories_{$opt.id}','');">
			<option value="0">{$opt.name}</option>
		{assign var=n value=1}
		{else}
			<option value="{$base_dir}category.php?id_category={$opt.id|intval}">&nbsp;&nbsp;{$opt.name}</option>
		{/if}
		{/foreach}
		</select>
	{/foreach}
<!-- /Navigation: categories -->
	{/if}

	{if $show_man==1}
<!-- Navigation: manufacturer -->
	<form action="{$smarty.server.SCRIPT_NAME}" method="get">
		<select id="manufacturer_list" class="max_input" name="manufacturer_list" onchange="autoUrl('manufacturer_list', '');">
			<option value="0">{l s='Manufacturers' mod='blocknavigation'}</option>
		{foreach from=$man_sel item=manufacturer}
			<option value="{$link->getmanufacturerLink($manufacturer.id_manufacturer, $manufacturer.link_rewrite)}">{$manufacturer.name}</option>
		{/foreach}
		</select>
	</form>
<!-- /Navigation: categories -->
	{/if}

	{if $show_sup==1}
<!-- Navigation: suppliers -->
	<form action="{$smarty.server.SCRIPT_NAME}" method="get">
		<select id="supplier_list" class="max_input" name="supplier_list" onchange="autoUrl('supplier_list', '');">
			<option value="0">{l s='Suppliers' mod='blocknavigation'}</option>
		{foreach from=$sup_sel item=supplier}
					<option value="{$link->getsupplierLink($supplier.id_supplier, $supplier.link_rewrite)}">{$supplier.name}</option>
		{/foreach}
		</select>
	</form>
<!-- /Navigation: suppliers -->
	{/if}

	{if $show_tag}
<!-- Navigation: tags -->
	<form action="{$smarty.server.SCRIPT_NAME}" method="get">
		<select id="tag_list" class="max_input" name="tag_list" onchange="autoUrl('tag_list', '');">
			<option value="">{l s='Tags' mod='blocknavigation'}</option>
			{foreach from=$tag_sel item=tag name=myLoop}
			<option value="{$base_dir}search.php?tag={$tag.name|urlencode}">{$tag.name}</option>
			{/foreach}
		</select>
	</form>
<!-- /Navigation: tags -->
	{/if}
	</div>
</div>
<!-- /Block my categories module -->
