<?php /* Smarty version Smarty-3.1.14, created on 2014-06-28 19:05:59
         compiled from "/WebDev/peruk/versions/www_update/boutique/administrator/themes/default/template/helpers/modules_list/modal.tpl" */ ?>
<?php /*%%SmartyHeaderCode:124891218953aef5f726bf42-40693276%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2c5cb7bdd979e1b375d73164025aced6f0e63955' => 
    array (
      0 => '/WebDev/peruk/versions/www_update/boutique/administrator/themes/default/template/helpers/modules_list/modal.tpl',
      1 => 1403974351,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '124891218953aef5f726bf42-40693276',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53aef5f7334174_20343736',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53aef5f7334174_20343736')) {function content_53aef5f7334174_20343736($_smarty_tpl) {?><div class="modal fade" id="modules_list_container">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title"><?php echo smartyTranslate(array('s'=>'Recommended Modules'),$_smarty_tpl);?>
</h3>
			</div>
			<div class="modal-body">
				<div id="modules_list_container_tab" style="display:none;"></div>
				<div id="modules_list_loader"><i class="icon-refresh icon-spin"></i></div>
			</div>
		</div>
	</div>
</div><?php }} ?>