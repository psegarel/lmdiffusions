<?php /* Smarty version 2.6.20, created on 2014-05-28 21:14:38
         compiled from /home/peruk/www/boutique/modules/sendtoafriend/product_page.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'l', '/home/peruk/www/boutique/modules/sendtoafriend/product_page.tpl', 1, false),)), $this); ?>
<li><a href="<?php echo $this->_tpl_vars['this_path']; ?>
sendtoafriend-form.php?id_product=<?php echo $_GET['id_product']; ?>
"><?php echo smartyTranslate(array('s' => 'Send to a friend','mod' => 'sendtoafriend'), $this);?>
</a></li>