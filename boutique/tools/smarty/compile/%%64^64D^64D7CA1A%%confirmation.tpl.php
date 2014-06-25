<?php /* Smarty version 2.6.20, created on 2014-06-01 15:13:56
         compiled from /home/peruk/www/boutique/modules/cmcic/confirmation.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'l', '/home/peruk/www/boutique/modules/cmcic/confirmation.tpl', 1, false),)), $this); ?>
<p><?php echo smartyTranslate(array('s' => 'Your order on','mod' => 'cmcic'), $this);?>
 <span class="bold"><?php echo $this->_tpl_vars['shop_name']; ?>
</span> <?php echo smartyTranslate(array('s' => 'is complete.','mod' => 'cmcic'), $this);?>

	<br /><br />
	<?php echo smartyTranslate(array('s' => 'You have chosen the CM-CIC method.','mod' => 'cmcic'), $this);?>

	<br /><br /><span class="bold"><?php echo smartyTranslate(array('s' => 'Your order will be sent very soon.','mod' => 'cmcic'), $this);?>
</span>
	<br /><br /><?php echo smartyTranslate(array('s' => 'For any questions or for further information, please contact our','mod' => 'cmcic'), $this);?>
 <a href="<?php echo $this->_tpl_vars['base_dir_ssl']; ?>
contact-form.php"><?php echo smartyTranslate(array('s' => 'customer support','mod' => 'cmcic'), $this);?>
</a>.
</p>