<?php /* Smarty version 2.6.20, created on 2012-08-01 14:50:17
         compiled from /homez.120/peruk/www/boutique/modules/cheque/payment_return.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'l', '/homez.120/peruk/www/boutique/modules/cheque/payment_return.tpl', 2, false),)), $this); ?>
<?php if ($this->_tpl_vars['status'] == 'ok'): ?>
	<h3 class="commande_finie"><?php echo smartyTranslate(array('s' => 'Your order on','mod' => 'cheque'), $this);?>
 <span class="bold"><?php echo $this->_tpl_vars['shop_name']; ?>
</span> <?php echo smartyTranslate(array('s' => 'is complete.','mod' => 'cheque'), $this);?>
</h3>
	<p>
		<?php echo smartyTranslate(array('s' => 'Please send us a cheque with:','mod' => 'cheque'), $this);?>

		<br /><br />- <?php echo smartyTranslate(array('s' => 'an amount of','mod' => 'cheque'), $this);?>
 : <span class="price"><strong><?php echo $this->_tpl_vars['total_to_pay']; ?>
</strong></span>
		<br /><br />- <?php echo smartyTranslate(array('s' => 'payable to the order of','mod' => 'cheque'), $this);?>
 : <span class="bold"><?php if ($this->_tpl_vars['chequeName']): ?><?php echo $this->_tpl_vars['chequeName']; ?>
<?php else: ?>___________<?php endif; ?></span>
		<br /><br />- <?php echo smartyTranslate(array('s' => 'mail to','mod' => 'cheque'), $this);?>
 : <br /><br /> <span class="bold"><?php if ($this->_tpl_vars['chequeAddress']): ?><?php echo $this->_tpl_vars['chequeAddress']; ?>
<?php else: ?>___________<?php endif; ?></span>
		<br /><br /><?php echo smartyTranslate(array('s' => 'An e-mail has been sent to you with this information.','mod' => 'cheque'), $this);?>

		<br /><br /><span class="bold"><?php echo smartyTranslate(array('s' => 'Your order will be sent as soon as we receive your payment.','mod' => 'cheque'), $this);?>
</span>
		<br /><br /><?php echo smartyTranslate(array('s' => 'For any questions or for further information, please contact our','mod' => 'cheque'), $this);?>
 <a href="<?php echo $this->_tpl_vars['base_dir_ssl']; ?>
contact-form.php"><?php echo smartyTranslate(array('s' => 'customer support','mod' => 'cheque'), $this);?>
</a>.
	</p>
<?php else: ?>
	<p class="warning">
		<?php echo smartyTranslate(array('s' => 'We noticed a problem with your order. If you think this is an error, you can contact our','mod' => 'cheque'), $this);?>

		<a href="<?php echo $this->_tpl_vars['base_dir_ssl']; ?>
contact-form.php"><?php echo smartyTranslate(array('s' => 'customer support','mod' => 'cheque'), $this);?>
</a>.
	</p>
<?php endif; ?>