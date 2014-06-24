<?php /* Smarty version 2.6.20, created on 2014-05-31 15:57:21
         compiled from /home/peruk/www/boutique/themes/peruk/discount.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'l', '/home/peruk/www/boutique/themes/peruk/discount.tpl', 1, false),array('function', 'convertPrice', '/home/peruk/www/boutique/themes/peruk/discount.tpl', 30, false),array('function', 'dateFormat', '/home/peruk/www/boutique/themes/peruk/discount.tpl', 49, false),array('modifier', 'escape', '/home/peruk/www/boutique/themes/peruk/discount.tpl', 28, false),)), $this); ?>
<?php ob_start(); ?><a href="my-account.php"><?php echo smartyTranslate(array('s' => 'My account'), $this);?>
</a><span class="navigation-pipe"><?php echo $this->_tpl_vars['navigationPipe']; ?>
</span><?php echo smartyTranslate(array('s' => 'Your vouchers'), $this);?>
<?php $this->_smarty_vars['capture']['path'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_dir'])."./breadcrumb.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="mon_compte">
<h2><?php echo smartyTranslate(array('s' => 'Your vouchers'), $this);?>
</h2>

<?php if ($this->_tpl_vars['discount'] && count ( $this->_tpl_vars['discount'] ) && $this->_tpl_vars['nbDiscounts']): ?>
	<table id="order-list" class="discount std" cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th class="history_link first_item"><?php echo smartyTranslate(array('s' => 'Code'), $this);?>
</th>
			<th class="discount_description item"><?php echo smartyTranslate(array('s' => 'Description'), $this);?>
</th>
			<th class="discount_quantity item"><?php echo smartyTranslate(array('s' => 'Q.'), $this);?>
</th>
			<th class="discount_value item"><?php echo smartyTranslate(array('s' => 'Value'), $this);?>
</th>
			<th class="discount_minimum item"><?php echo smartyTranslate(array('s' => 'Min.'), $this);?>
</th>
			<th class="discount_cumulative item"><?php echo smartyTranslate(array('s' => 'Cumulative'), $this);?>
</th>
			<th class="discount_expiration_date last_item"><?php echo smartyTranslate(array('s' => 'Expiration date'), $this);?>
</th>
		</tr>
	</thead>
	<tbody>
	<?php $_from = $this->_tpl_vars['discount']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['myLoop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['myLoop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['discount']):
        $this->_foreach['myLoop']['iteration']++;
?>
		<tr class="<?php if (($this->_foreach['myLoop']['iteration'] <= 1)): ?>first_item<?php elseif (($this->_foreach['myLoop']['iteration'] == $this->_foreach['myLoop']['total'])): ?>last_item<?php else: ?>item<?php endif; ?> <?php if (($this->_foreach['myLoop']['iteration']-1) % 2): ?>alternate_item<?php endif; ?>">
			<td class="history_link"><?php echo $this->_tpl_vars['discount']['name']; ?>
</td>
			<td class="discount_description"><?php echo $this->_tpl_vars['discount']['description']; ?>
</td>
			<td class="discount_quantity"><?php echo $this->_tpl_vars['discount']['quantity_for_user']; ?>
</td>
			<td class="discount_value">
				<?php if ($this->_tpl_vars['discount']['id_discount_type'] == 1): ?>
					<?php echo ((is_array($_tmp=$this->_tpl_vars['discount']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
%
				<?php elseif ($this->_tpl_vars['discount']['id_discount_type'] == 2): ?>
					<?php echo Product::convertPrice(array('price' => $this->_tpl_vars['discount']['value']), $this);?>

				<?php else: ?>
					<?php echo smartyTranslate(array('s' => 'Free shipping'), $this);?>

				<?php endif; ?>
			</td>
			<td class="discount_minimum">
				<?php if ($this->_tpl_vars['discount']['minimal'] == 0): ?>
					<?php echo smartyTranslate(array('s' => 'none'), $this);?>

				<?php else: ?>
					<?php echo Product::convertPrice(array('price' => $this->_tpl_vars['discount']['minimal']), $this);?>

				<?php endif; ?>
			</td>
			<td class="discount_cumulative">
				<?php if ($this->_tpl_vars['discount']['cumulable'] == 1): ?>
					<img src="<?php echo $this->_tpl_vars['img_dir']; ?>
icon/yes.gif" alt="<?php echo smartyTranslate(array('s' => 'Yes'), $this);?>
" class="icon" />
				<?php else: ?>
					<img src="<?php echo $this->_tpl_vars['img_dir']; ?>
icon/no.gif" alt="<?php echo smartyTranslate(array('s' => 'No'), $this);?>
" class="icon" />
				<?php endif; ?>
			</td>
			<td class="discount_expiration_date"><?php echo Tools::dateFormat(array('date' => $this->_tpl_vars['discount']['date_to']), $this);?>
</td>
		</tr>
	<?php endforeach; endif; unset($_from); ?>
	</tbody>
</table>
<?php else: ?>
	<p class="warning"><?php echo smartyTranslate(array('s' => 'You do not possess any vouchers.'), $this);?>
</p> <br />
<?php endif; ?>
</div>

<ul class='nav_compte_footer'>
	<li><a href="<?php echo $this->_tpl_vars['base_dir_ssl']; ?>
my-account.php"><img src="<?php echo $this->_tpl_vars['img_dir']; ?>
icon/my-account.gif" alt="" class="icon" align="absmiddle" /></a><a  class="nav_lien" href="<?php echo $this->_tpl_vars['base_dir_ssl']; ?>
my-account.php"><?php echo smartyTranslate(array('s' => 'Back to Your Account'), $this);?>
</a></li>
	<li><a href="<?php echo $this->_tpl_vars['base_dir']; ?>
"><img src="<?php echo $this->_tpl_vars['img_dir']; ?>
icon/home.gif" alt="" class="icon" align="absmiddle" /></a><a class="nav_lien" href="<?php echo $this->_tpl_vars['base_dir']; ?>
"><?php echo smartyTranslate(array('s' => 'Home'), $this);?>
</a></li>
</ul>