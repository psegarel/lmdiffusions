<?php /* Smarty version 2.6.20, created on 2014-06-25 16:15:18
         compiled from /WebDev/peruk/versions/www_update/boutique/modules/blockcategories/blockcategories.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', '/WebDev/peruk/versions/www_update/boutique/modules/blockcategories/blockcategories.tpl', 6, false),array('modifier', 'count', '/WebDev/peruk/versions/www_update/boutique/modules/blockcategories/blockcategories.tpl', 8, false),)), $this); ?>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['js_dir']; ?>
tools/treeManagement.js"></script>

<!-- Block categories module -->
<div id="categories_block_left" class="block">
    <?php $_from = $this->_tpl_vars['blockCategTree']['children']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['blockCategTree'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['blockCategTree']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['cat']):
        $this->_foreach['blockCategTree']['iteration']++;
?>
    	<h4><a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['cat']['link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
"class="selected" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['cat']['desc'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['cat']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</a></h4>

       <?php if (count($this->_tpl_vars['cat']['children']) > 0): ?>
	        <div class="block_content">
	            <ul class="tree <?php if ($this->_tpl_vars['isDhtml']): ?>dhtml<?php endif; ?>">
	            <?php $_from = $this->_tpl_vars['cat']['children']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['blockSubCategTree'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['blockSubCategTree']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['child']):
        $this->_foreach['blockSubCategTree']['iteration']++;
?>
	                <?php if (($this->_foreach['blockSubCategTree']['iteration'] == $this->_foreach['blockSubCategTree']['total'])): ?>
	                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['branche_tpl_path'], 'smarty_include_vars' => array('node' => $this->_tpl_vars['child'],'last' => 'true')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	                <?php else: ?>
	                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['branche_tpl_path'], 'smarty_include_vars' => array('node' => $this->_tpl_vars['child'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	                <?php endif; ?>
	            <?php endforeach; endif; unset($_from); ?>
	            </ul>
	        </div>
        <?php endif; ?>

    <?php endforeach; endif; unset($_from); ?>
</div>
<!-- /Block categories module -->