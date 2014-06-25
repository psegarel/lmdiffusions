<?php /* Smarty version 2.6.20, created on 2010-03-31 15:53:17
         compiled from /homez.120/peruk/www/boutique/modules/sotewsadds/sotewsaddsRight.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'l', '/homez.120/peruk/www/boutique/modules/sotewsadds/sotewsaddsRight.tpl', 5, false),)), $this); ?>
<!-- MODULE Block SotEW's Adds Right-->
<div id='sotewsadds' class="Right">
<?php if ($this->_tpl_vars['withBlockRight']): ?>
	<div class="block">
		<h4><?php echo smartyTranslate(array('s' => 'Advertising','mod' => 'sotewsadds'), $this);?>
</h4>
		<div class="block_content" align="center">
<?php endif; ?>
			<p><?php echo $this->_tpl_vars['content']; ?>
</p>
<?php if ($this->_tpl_vars['withBlockRight']): ?>
		</div>
	</div>
<?php endif; ?>
</div>
<!-- /MODULE Block SotEW's Adds Right-->