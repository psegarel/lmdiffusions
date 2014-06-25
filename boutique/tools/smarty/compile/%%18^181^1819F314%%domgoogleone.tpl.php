<?php /* Smarty version 2.6.20, created on 2012-08-01 13:38:50
         compiled from /homez.120/peruk/www/boutique/modules/domgoogleone/domgoogleone.tpl */ ?>
<!-- <?php echo $this->_tpl_vars['moduleinfo']; ?>
 -->
<script type="text/javascript" src="http://apis.google.com/js/plusone.js">{lang:'<?php echo $this->_tpl_vars['lang']; ?>
'}</script> 
<div id="<?php echo $this->_tpl_vars['modulename']; ?>
">
	<?php if ($this->_tpl_vars['total'] == 1): ?><?php $this->assign('compte', ' count="true"'); ?>
	<?php else: ?><?php $this->assign('compte', ' count="false"'); ?><?php endif; ?>
	<g:plusone size="<?php echo $this->_tpl_vars['type']; ?>
"<?php echo $this->_tpl_vars['compte']; ?>
></g:plusone>
</div>
<!-- /<?php echo $this->_tpl_vars['moduleinfo']; ?>
 -->