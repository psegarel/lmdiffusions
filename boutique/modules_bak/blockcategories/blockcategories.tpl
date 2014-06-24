<script type="text/javascript" src="{$js_dir}tools/treeManagement.js"></script>

<!-- Block categories module -->
<div id="categories_block_left" class="block">
    {foreach from=$blockCategTree.children item=cat name=blockCategTree}
        <h4><a href="{$cat.link|escape:htmlall:'UTF-8'}"class="selected" title="{$cat.desc|escape:htmlall:'UTF-8'}">{$cat.name|escape:htmlall:'UTF-8'}</a>
        </h4>
        <div class="block_content">
            <ul class="tree {if $isDhtml}dhtml{/if}">
            {foreach from=$cat.children item=child name=blockSubCategTree}
                {if $smarty.foreach.blockSubCategTree.last}
                        {include file=$branche_tpl_path node=$child last='true'}
                {else}
                        {include file=$branche_tpl_path node=$child}
                {/if}
            {/foreach}
            </ul>

        </div>    
    {/foreach}
</div>
<!-- /Block categories module -->