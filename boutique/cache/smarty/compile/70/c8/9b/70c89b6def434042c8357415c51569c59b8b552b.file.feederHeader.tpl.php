<?php /* Smarty version Smarty-3.1.14, created on 2014-06-28 19:07:15
         compiled from "/WebDev/peruk/versions/www_update/boutique/modules/feeder/feederHeader.tpl" */ ?>
<?php /*%%SmartyHeaderCode:209307985853aef643a39ce6-10902781%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '70c89b6def434042c8357415c51569c59b8b552b' => 
    array (
      0 => '/WebDev/peruk/versions/www_update/boutique/modules/feeder/feederHeader.tpl',
      1 => 1403940659,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '209307985853aef643a39ce6-10902781',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'meta_title' => 0,
    'feedUrl' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_53aef643abbb83_44572407',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53aef643abbb83_44572407')) {function content_53aef643abbb83_44572407($_smarty_tpl) {?>

<link rel="alternate" type="application/rss+xml" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['meta_title']->value, ENT_QUOTES, 'UTF-8', true);?>
" href="<?php echo $_smarty_tpl->tpl_vars['feedUrl']->value;?>
" /><?php }} ?>