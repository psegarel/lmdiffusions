{if $cms}
	{if $cms->id == 11}
	<a style="background-color: #DE0390; color: #FFFFFF;" href="{$base_dir}cms.php?id_cms=14">Autres partenaires - Page 2</a>
	{/if}
	{if $cms->id == 14}
	<a style="background-color: #DE0390; color: #FFFFFF;" href="{$base_dir}cms.php?id_cms=11">Autres partenaires - Page 1</a>
	<a style="background-color: #DE0390; color: #FFFFFF;" href="{$base_dir}cms.php?id_cms=15">Autres partenaires - Page 3</a>
	{/if}
	{if $cms->id == 15}
	<a style="background-color: #DE0390; color: #FFFFFF;" href="{$base_dir}cms.php?id_cms=14">Autres partenaires - Page 2</a>
	{/if}
	{if $content_only}
	<div style="text-align:left; padding:10px;">
		{$cms->content}
	</div>
	{else}
		{$cms->content}
	{/if}
{else}
	{l s='This page does not exist.'}
{/if}
<br />
{if !$content_only}
<p><a href="{$base_dir}" title="{l s='Home'}"><img src="{$img_dir}icon/home.gif" alt="{l s='Home'}" class="icon" /></a><a href="{$base_dir}" title="{l s='Home'}">{l s='Home'}</a></p>
{/if}

