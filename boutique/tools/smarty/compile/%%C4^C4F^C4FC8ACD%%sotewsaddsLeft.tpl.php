<?php /* Smarty version 2.6.20, created on 2009-06-03 16:09:36
         compiled from /homez.120/peruk/www/boutique/modules/sotewsadds/sotewsaddsLeft.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'l', '/homez.120/peruk/www/boutique/modules/sotewsadds/sotewsaddsLeft.tpl', 5, false),)), $this); ?>
<!-- MODULE Block SotEW's Adds Left-->
<div id='sotewsadds' class="Left">
<?php if ($this->_tpl_vars['withBlockLeft']): ?>
	<div class="block">
		<h4><?php echo smartyTranslate(array('s' => 'Advertising','mod' => 'sotewsadds'), $this);?>
</h4>
		<div class="block_content" align="center">
<?php endif; ?>
			<p><?php echo $this->_tpl_vars['content']; ?>
</p>
<?php if ($this->_tpl_vars['withBlockLeft']): ?>
		</div>
	</div>
<?php endif; ?>
</div>
<!-- /MODULE Block SotEW's Adds Left-->