<?php /*%%SmartyHeaderCode:214255727353aef645a90546-55042458%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c7644a528649f98eedc0ac1f852fce206afd9bef' => 
    array (
      0 => '/WebDev/peruk/versions/www_update/boutique/themes/default-bootstrap/modules/blocksearch/blocksearch.tpl',
      1 => 1403974386,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '214255727353aef645a90546-55042458',
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53af83f71c3b68_75062874',
  'has_nocache_code' => false,
  'cache_lifetime' => 31536000,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53af83f71c3b68_75062874')) {function content_53af83f71c3b68_75062874($_smarty_tpl) {?>
<!-- Block search module -->
<div id="search_block_left" class="block exclusive">
	<p class="title_block">Rechercher</p>
	<form method="get" action="http://peruk-update/boutique/index.php?controller=search" id="searchbox">
    	<label for="search_query_block">Rechercher un produit</label>
		<p class="block_content clearfix">
			<input type="hidden" name="orderby" value="position" />
			<input type="hidden" name="controller" value="search" />
			<input type="hidden" name="orderway" value="desc" />
			<input class="search_query form-control grey" type="text" id="search_query_block" name="search_query" value="" />
			<button type="submit" id="search_button" class="btn btn-default button button-small"><span><i class="icon-search"></i></span></button>
		</p>
	</form>
</div>
<!-- /Block search module -->
<?php }} ?>