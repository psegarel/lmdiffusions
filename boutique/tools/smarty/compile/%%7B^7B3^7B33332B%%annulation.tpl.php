<?php /* Smarty version 2.6.20, created on 2012-08-05 16:25:08
         compiled from /homez.120/peruk/www/boutique/modules/cmcic/annulation.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'l', '/homez.120/peruk/www/boutique/modules/cmcic/annulation.tpl', 1, false),)), $this); ?>
<h2><?php echo smartyTranslate(array('s' => 'Warning','mod' => 'cmcic'), $this);?>
</h2>
<p><?php echo smartyTranslate(array('s' => 'Your order on','mod' => 'cmcic'), $this);?>
 <span class="bold"><?php echo $this->_tpl_vars['shop_name']; ?>
</span> <?php echo smartyTranslate(array('s' => 'as been canceled.','mod' => 'cmcic'), $this);?>

	<br /><br />
	<?php echo smartyTranslate(array('s' => 'There is a problem with the CM-CIC method.','mod' => 'cmcic'), $this);?>

	<br /><br /><span class="bold"><?php echo smartyTranslate(array('s' => 'The payment has not been validated by the bank server.','mod' => 'cmcic'), $this);?>
</span>
        <br /><br /><span class="bold"><?php echo smartyTranslate(array('s' => 'If your cart is still full you can try again or try an other payment method.','mod' => 'cmcic'), $this);?>
</span>
	<br /><br /><?php echo smartyTranslate(array('s' => 'For any questions or for further information, please contact our','mod' => 'cmcic'), $this);?>
 <a href="<?php echo $this->_tpl_vars['base_dir_ssl']; ?>
contact-form.php"><?php echo smartyTranslate(array('s' => 'customer support','mod' => 'cmcic'), $this);?>
</a>.
</p>