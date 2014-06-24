<!-- {$moduleinfo} -->
<script type="text/javascript" src="http://apis.google.com/js/plusone.js">{ldelim}lang:'{$lang}'{rdelim}</script> 
<div id="{$modulename}">
	{if $total == 1}{assign var='compte' value=' count="true"'}
	{else}{assign var='compte' value=' count="false"'}{/if}
	<g:plusone size="{$type}"{$compte}></g:plusone>
</div>
<!-- /{$moduleinfo} -->
