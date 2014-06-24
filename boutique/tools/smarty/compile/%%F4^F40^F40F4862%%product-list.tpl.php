<?php /* Smarty version 2.6.20, created on 2014-05-28 21:14:27
         compiled from /home/peruk/www/boutique/themes/peruk/./product-list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', '/home/peruk/www/boutique/themes/peruk/./product-list.tpl', 11, false),array('modifier', 'truncate', '/home/peruk/www/boutique/themes/peruk/./product-list.tpl', 14, false),array('modifier', 'date_format', '/home/peruk/www/boutique/themes/peruk/./product-list.tpl', 19, false),array('modifier', 'intval', '/home/peruk/www/boutique/themes/peruk/./product-list.tpl', 27, false),array('function', 'l', '/home/peruk/www/boutique/themes/peruk/./product-list.tpl', 18, false),array('function', 'convertPrice', '/home/peruk/www/boutique/themes/peruk/./product-list.tpl', 23, false),)), $this); ?>
<?php if (isset ( $this->_tpl_vars['products'] )): ?>
	<div id="liste_produits">
	<!-- Products list -->
	<ul id="product_list" class="clear">
	<?php $_from = $this->_tpl_vars['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['products'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['products']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['product']):
        $this->_foreach['products']['iteration']++;
?>

		<?php if (( $this->_tpl_vars['product']['allow_oosp'] || $this->_tpl_vars['product']['quantity'] > 0 )): ?>
		<li class="ajax_block_product <?php if (($this->_foreach['products']['iteration'] <= 1)): ?>first_item<?php elseif (($this->_foreach['products']['iteration'] == $this->_foreach['products']['total'])): ?>last_item<?php endif; ?> <?php if (($this->_foreach['products']['iteration']-1) % 2): ?>alternate_item<?php else: ?>item<?php endif; ?>">
			<div class="center_block">

				<a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
" class="product_img_link" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
"><img src="<?php echo $this->_tpl_vars['img_prod_dir']; ?>
<?php echo $this->_tpl_vars['product']['id_image']; ?>
-medium.jpg" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['legend'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
" /></a>
			</div>

		  <h3><a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['legend'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['product']['name'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 35) : smarty_modifier_truncate($_tmp, 35)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</a></h3>

			<div class="right_block">
				<?php if ($this->_tpl_vars['product']['on_sale']): ?>
					<span class="on_sale"><?php echo smartyTranslate(array('s' => 'On sale!'), $this);?>
</span>
				<?php elseif (( $this->_tpl_vars['product']['reduction_price'] != 0 || $this->_tpl_vars['product']['reduction_percent'] != 0 ) && ( $this->_tpl_vars['product']['reduction_from'] == $this->_tpl_vars['product']['reduction_to'] || ( ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y-%m-%d') : smarty_modifier_date_format($_tmp, '%Y-%m-%d')) <= $this->_tpl_vars['product']['reduction_to'] && ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y-%m-%d') : smarty_modifier_date_format($_tmp, '%Y-%m-%d')) >= $this->_tpl_vars['product']['reduction_from'] ) )): ?>
					<span class="discount"><?php echo smartyTranslate(array('s' => 'Price lowered!'), $this);?>
</span>
				<?php endif; ?>

				<span class="price"><?php echo Product::convertPrice(array('price' => $this->_tpl_vars['product']['price']), $this);?>
</span>
				<span class="availability"><?php if (( $this->_tpl_vars['product']['allow_oosp'] || $this->_tpl_vars['product']['quantity'] > 0 )): ?><?php echo smartyTranslate(array('s' => 'Available'), $this);?>
<?php else: ?><?php echo smartyTranslate(array('s' => 'Out of stock'), $this);?>
<?php endif; ?></span>
				<?php if (( $this->_tpl_vars['product']['allow_oosp'] || $this->_tpl_vars['product']['quantity'] > 0 ) && $this->_tpl_vars['product']['customizable'] != 2): ?>
					<div class="ajouter_panier">
					<a class="button ajax_add_to_cart_button exclusive" rel="ajax_id_product_<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['id_product'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
" href="<?php echo $this->_tpl_vars['base_dir']; ?>
cart.php?add&amp;id_product=<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['id_product'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
&amp;token=<?php echo $this->_tpl_vars['static_token']; ?>
"><?php echo smartyTranslate(array('s' => 'Add to cart'), $this);?>
</a>
					</div>
				<?php else: ?>
						<span class="exclusive"><?php echo smartyTranslate(array('s' => 'Add to cart'), $this);?>
</span>
				<?php endif; ?>

				<!--
				<a class="button" href="<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
" title="<?php echo smartyTranslate(array('s' => 'View'), $this);?>
"><?php echo smartyTranslate(array('s' => 'View'), $this);?>
</a>
				-->
			</div>
		</li>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	</ul>
	</div>
	<!-- /Products list -->
	<br class="clear_list" / >
<?php endif; ?>