<?php /* Smarty version 2.6.20, created on 2014-06-03 22:32:29
         compiled from /home/peruk/www/boutique/modules/bankwire/payment_return.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'l', '/home/peruk/www/boutique/modules/bankwire/payment_return.tpl', 2, false),)), $this); ?>
<?php if ($this->_tpl_vars['status'] == 'ok'): ?>
	<h3 class="commande_finie"><?php echo smartyTranslate(array('s' => 'Your order on','mod' => 'bankwire'), $this);?>
 <span class="bold"><?php echo $this->_tpl_vars['shop_name']; ?>
</span> <?php echo smartyTranslate(array('s' => 'is complete.','mod' => 'bankwire'), $this);?>
</h3>
	<p>
		<?php echo smartyTranslate(array('s' => 'Please send us a bank wire with:','mod' => 'bankwire'), $this);?>

		<br /><br />- <?php echo smartyTranslate(array('s' => 'an amout of','mod' => 'bankwire'), $this);?>
 <span class="price"><?php echo $this->_tpl_vars['total_to_pay']; ?>
</span>
		<br /><br />- <?php echo smartyTranslate(array('s' => 'to the account owner of','mod' => 'bankwire'), $this);?>
 <span class="bold"><?php if ($this->_tpl_vars['bankwireOwner']): ?><?php echo $this->_tpl_vars['bankwireOwner']; ?>
<?php else: ?>___________<?php endif; ?></span>
		<br /><br />- <?php echo smartyTranslate(array('s' => 'with theses details','mod' => 'bankwire'), $this);?>
 <span class="bold"><?php if ($this->_tpl_vars['bankwireDetails']): ?><?php echo $this->_tpl_vars['bankwireDetails']; ?>
<?php else: ?>___________<?php endif; ?></span>
		<br /><br />- <?php echo smartyTranslate(array('s' => 'to this bank','mod' => 'bankwire'), $this);?>
<br /><br /> <span class="bold"><?php if ($this->_tpl_vars['bankwireAddress']): ?><?php echo $this->_tpl_vars['bankwireAddress']; ?>
<?php else: ?>___________<?php endif; ?></span>

		<br /><br />

		<span class="instructions_cheque">
		<strong>
		<?php echo smartyTranslate(array('s' => 'Do not forget to insert your order #','mod' => 'bankwire'), $this);?>
 <span class="bold"><?php echo $this->_tpl_vars['id_order']; ?>
</span> <?php echo smartyTranslate(array('s' => 'in the subjet of your bank wire','mod' => 'bankwire'), $this);?>

		</strong>
		</span>
		<br /><?php echo smartyTranslate(array('s' => 'An e-mail has been sent to you with this information.','mod' => 'cheque'), $this);?>

		<br /><br /><span class="bold"><?php echo smartyTranslate(array('s' => 'Your order will be sent as soon as we receive your settlement.','mod' => 'bankwire'), $this);?>
</span>
		<br /><br /><?php echo smartyTranslate(array('s' => 'For any questions or for further information, please contact our','mod' => 'bankwire'), $this);?>
 <a href="<?php echo $this->_tpl_vars['base_dir_ssl']; ?>
contact-form.php"><?php echo smartyTranslate(array('s' => 'customer support','mod' => 'cheque'), $this);?>
</a>.
	</p>
<?php else: ?>
	<p class="warning">
		<?php echo smartyTranslate(array('s' => 'We noticed a problem with your order. If you think this is an error, you can contact our','mod' => 'bankwire'), $this);?>

		<a href="<?php echo $this->_tpl_vars['base_dir_ssl']; ?>
contact-form.php"><?php echo smartyTranslate(array('s' => 'customer support','mod' => 'bankwire'), $this);?>
</a>.
	</p>
<?php endif; ?>