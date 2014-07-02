<?php /*%%SmartyHeaderCode:85389983653aef6441686e8-75119869%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '111a435cb16c8407c9db28fabe485397ec4243b8' => 
    array (
      0 => '/WebDev/peruk/versions/www_update/boutique/themes/default-bootstrap/modules/blocksearch/blocksearch-top.tpl',
      1 => 1403974386,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '85389983653aef6441686e8-75119869',
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53af83f6705882_10872454',
  'has_nocache_code' => false,
  'cache_lifetime' => 31536000,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53af83f6705882_10872454')) {function content_53af83f6705882_10872454($_smarty_tpl) {?><!-- Block search module TOP -->
<div id="search_block_top" class="col-sm-4 clearfix">
	<form id="searchbox" method="get" action="http://peruk-update/boutique/index.php?controller=search" >
		<input type="hidden" name="controller" value="search" />
		<input type="hidden" name="orderby" value="position" />
		<input type="hidden" name="orderway" value="desc" />
		<input class="search_query form-control" type="text" id="search_query_top" name="search_query" placeholder="Rechercher" value="" />
		<button type="submit" name="submit_search" class="btn btn-default button-search">
			<span>Rechercher</span>
		</button>
	</form>
</div>
<!-- /Block search module TOP --><?php }} ?>