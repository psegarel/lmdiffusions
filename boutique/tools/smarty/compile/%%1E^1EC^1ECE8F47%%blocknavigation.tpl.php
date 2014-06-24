<?php /* Smarty version 2.6.20, created on 2009-06-23 19:04:12
         compiled from /homez.120/peruk/www/boutique/modules/blocknavigation/blocknavigation.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'l', '/homez.120/peruk/www/boutique/modules/blocknavigation/blocknavigation.tpl', 3, false),array('modifier', 'htmlentities', '/homez.120/peruk/www/boutique/modules/blocknavigation/blocknavigation.tpl', 8, false),array('modifier', 'intval', '/homez.120/peruk/www/boutique/modules/blocknavigation/blocknavigation.tpl', 24, false),array('modifier', 'urlencode', '/homez.120/peruk/www/boutique/modules/blocknavigation/blocknavigation.tpl', 64, false),)), $this); ?>
<!-- Block navigation module -->
<div id="navigation_block_left" class="block">
	<h4><?php echo smartyTranslate(array('s' => 'Navigation','mod' => 'blocknavigation'), $this);?>
</h4>
	<div class="block_content">
	<?php if ($this->_tpl_vars['show_search'] == 1): ?>
<!-- Navigation: search -->
	<form method="get" action="<?php echo $this->_tpl_vars['base_dir']; ?>
search.php" id="my_searchbox">
		<?php echo smartyTranslate(array('s' => 'Search:','mod' => 'blocknavigation'), $this);?>
&nbsp;<input type="text" id="my_search_query" class="min_search" name="search_query" value="<?php if (isset ( $_GET['search_query'] )): ?><?php echo ((is_array($_tmp=$_GET['search_query'])) ? $this->_run_mod_handler('htmlentities', true, $_tmp, $this->_tpl_vars['ENT_QUOTES'], 'utf-8') : htmlentities($_tmp, $this->_tpl_vars['ENT_QUOTES'], 'utf-8')); ?>
<?php endif; ?>" />
		<input type="submit" id="my_search_button" class="button_mini" style="display:none" value="<?php echo smartyTranslate(array('s' => 'go','mod' => 'blocknavigation'), $this);?>
" />
	</form>
<!-- /Navigation: search -->
	<?php endif; ?>

	<?php if ($this->_tpl_vars['show_cat'] == 1): ?>
<!-- Navigation: categories -->
	<?php $_from = $this->_tpl_vars['cat_sel']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sel']):
?>
		<?php $this->assign('n', 0); ?>
		<?php $_from = $this->_tpl_vars['sel']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['opt']):
?>
		<?php if ($this->_tpl_vars['n'] == 0): ?>
		<select id="categories_<?php echo $this->_tpl_vars['opt']['id']; ?>
" class="max_input" name="categories_<?php echo $this->_tpl_vars['opt']['id']; ?>
" onchange="autoUrl('categories_<?php echo $this->_tpl_vars['opt']['id']; ?>
','');">
			<option value="0"><?php echo $this->_tpl_vars['opt']['name']; ?>
</option>
		<?php $this->assign('n', 1); ?>
		<?php else: ?>
			<option value="<?php echo $this->_tpl_vars['base_dir']; ?>
category.php?id_category=<?php echo ((is_array($_tmp=$this->_tpl_vars['opt']['id'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
">&nbsp;&nbsp;<?php echo $this->_tpl_vars['opt']['name']; ?>
</option>
		<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		</select>
	<?php endforeach; endif; unset($_from); ?>
<!-- /Navigation: categories -->
	<?php endif; ?>

	<?php if ($this->_tpl_vars['show_man'] == 1): ?>
<!-- Navigation: manufacturer -->
	<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>
" method="get">
		<select id="manufacturer_list" class="max_input" name="manufacturer_list" onchange="autoUrl('manufacturer_list', '');">
			<option value="0"><?php echo smartyTranslate(array('s' => 'Manufacturers','mod' => 'blocknavigation'), $this);?>
</option>
		<?php $_from = $this->_tpl_vars['man_sel']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['manufacturer']):
?>
			<option value="<?php echo $this->_tpl_vars['link']->getmanufacturerLink($this->_tpl_vars['manufacturer']['id_manufacturer'],$this->_tpl_vars['manufacturer']['link_rewrite']); ?>
"><?php echo $this->_tpl_vars['manufacturer']['name']; ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
		</select>
	</form>
<!-- /Navigation: categories -->
	<?php endif; ?>

	<?php if ($this->_tpl_vars['show_sup'] == 1): ?>
<!-- Navigation: suppliers -->
	<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>
" method="get">
		<select id="supplier_list" class="max_input" name="supplier_list" onchange="autoUrl('supplier_list', '');">
			<option value="0"><?php echo smartyTranslate(array('s' => 'Suppliers','mod' => 'blocknavigation'), $this);?>
</option>
		<?php $_from = $this->_tpl_vars['sup_sel']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['supplier']):
?>
					<option value="<?php echo $this->_tpl_vars['link']->getsupplierLink($this->_tpl_vars['supplier']['id_supplier'],$this->_tpl_vars['supplier']['link_rewrite']); ?>
"><?php echo $this->_tpl_vars['supplier']['name']; ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
		</select>
	</form>
<!-- /Navigation: suppliers -->
	<?php endif; ?>

	<?php if ($this->_tpl_vars['show_tag']): ?>
<!-- Navigation: tags -->
	<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>
" method="get">
		<select id="tag_list" class="max_input" name="tag_list" onchange="autoUrl('tag_list', '');">
			<option value=""><?php echo smartyTranslate(array('s' => 'Tags','mod' => 'blocknavigation'), $this);?>
</option>
			<?php $_from = $this->_tpl_vars['tag_sel']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['myLoop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['myLoop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tag']):
        $this->_foreach['myLoop']['iteration']++;
?>
			<option value="<?php echo $this->_tpl_vars['base_dir']; ?>
search.php?tag=<?php echo ((is_array($_tmp=$this->_tpl_vars['tag']['name'])) ? $this->_run_mod_handler('urlencode', true, $_tmp) : urlencode($_tmp)); ?>
"><?php echo $this->_tpl_vars['tag']['name']; ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
		</select>
	</form>
<!-- /Navigation: tags -->
	<?php endif; ?>
	</div>
</div>
<!-- /Block my categories module -->