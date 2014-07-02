<?php /* Smarty version Smarty-3.1.14, created on 2014-06-28 19:07:04
         compiled from "/WebDev/peruk/versions/www_update/boutique/administrator/themes/default/template/helpers/list/list_action_view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:22273343453aef638cbeed2-38204842%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5c9d6050e0560f4312b4044ff462ed2000dc733d' => 
    array (
      0 => '/WebDev/peruk/versions/www_update/boutique/administrator/themes/default/template/helpers/list/list_action_view.tpl',
      1 => 1403974351,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22273343453aef638cbeed2-38204842',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'href' => 0,
    'action' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53aef638cd8f86_69088966',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53aef638cd8f86_69088966')) {function content_53aef638cd8f86_69088966($_smarty_tpl) {?>
<a href="<?php echo $_smarty_tpl->tpl_vars['href']->value;?>
" class="" title="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" >
	<i class="icon-search-plus"></i> <?php echo $_smarty_tpl->tpl_vars['action']->value;?>

</a><?php }} ?>