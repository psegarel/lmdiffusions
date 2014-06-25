<?php /* Smarty version 2.6.20, created on 2012-08-01 13:38:50
         compiled from /homez.120/peruk/www/boutique/modules/sendtoafriend/product_page.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'l', '/homez.120/peruk/www/boutique/modules/sendtoafriend/product_page.tpl', 1, false),)), $this); ?>
<li><a href="<?php echo $this->_tpl_vars['this_path']; ?>
sendtoafriend-form.php?id_product=<?php echo $_GET['id_product']; ?>
"><?php echo smartyTranslate(array('s' => 'Send to a friend','mod' => 'sendtoafriend'), $this);?>
</a></li>