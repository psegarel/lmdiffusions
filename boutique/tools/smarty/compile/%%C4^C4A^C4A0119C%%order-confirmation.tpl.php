<?php /* Smarty version 2.6.20, created on 2012-08-01 14:50:17
         compiled from /homez.120/peruk/www/boutique/themes/peruk/order-confirmation.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'l', '/homez.120/peruk/www/boutique/themes/peruk/order-confirmation.tpl', 1, false),)), $this); ?>
<?php ob_start(); ?><?php echo smartyTranslate(array('s' => 'Order confirmation'), $this);?>
<?php $this->_smarty_vars['capture']['path'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_dir'])."./breadcrumb.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h2><?php echo smartyTranslate(array('s' => 'Order confirmation'), $this);?>
</h2>

<?php $this->assign('current_step', 'payment'); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_dir'])."./order-steps.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_dir'])."./errors.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="paiement_cheque">
<?php echo $this->_tpl_vars['HOOK_ORDER_CONFIRMATION']; ?>

<?php echo $this->_tpl_vars['HOOK_PAYMENT_RETURN']; ?>

</div>

<p class="cart_navigation_end">
<a class="exclusive_large" href="<?php echo $this->_tpl_vars['base_dir_ssl']; ?>
history.php" title="<?php echo smartyTranslate(array('s' => 'Back to orders'), $this);?>
"><?php echo smartyTranslate(array('s' => 'Back to orders'), $this);?>
</a>
</p>