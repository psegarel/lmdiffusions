<?php /* Smarty version Smarty-3.1.14, created on 2014-06-28 19:06:22
         compiled from "/WebDev/peruk/versions/www_update/boutique/administrator/themes/default/template/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:213693904553aef60e7bea03-21310188%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '80ed9ff92b7f996d7fe34a6e7d7f19663c7c4237' => 
    array (
      0 => '/WebDev/peruk/versions/www_update/boutique/administrator/themes/default/template/content.tpl',
      1 => 1403974342,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '213693904553aef60e7bea03-21310188',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53aef60e86b746_98044232',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53aef60e86b746_98044232')) {function content_53aef60e86b746_98044232($_smarty_tpl) {?>
<div id="ajax_confirmation" class="alert alert-success hide"></div>

<div id="ajaxBox" style="display:none"></div>


<div class="row">
	<div class="col-lg-12">
		<?php if (isset($_smarty_tpl->tpl_vars['content']->value)){?>
			<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

		<?php }?>
	</div>
</div><?php }} ?>