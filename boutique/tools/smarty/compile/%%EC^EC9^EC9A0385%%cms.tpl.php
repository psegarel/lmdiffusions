<?php /* Smarty version 2.6.20, created on 2011-11-22 18:18:34
         compiled from /homez.120/peruk/www/boutique/themes/prestashop/cms.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'l', '/homez.120/peruk/www/boutique/themes/prestashop/cms.tpl', 20, false),)), $this); ?>
<?php if ($this->_tpl_vars['cms']): ?>
	<?php if ($this->_tpl_vars['cms']->id == 11): ?>
	<a style="background-color: #DE0390; color: #FFFFFF;" href="<?php echo $this->_tpl_vars['base_dir']; ?>
cms.php?id_cms=14">Autres partenaires - Page 2</a>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['cms']->id == 14): ?>
	<a style="background-color: #DE0390; color: #FFFFFF;" href="<?php echo $this->_tpl_vars['base_dir']; ?>
cms.php?id_cms=11">Autres partenaires - Page 1</a>
	<a style="background-color: #DE0390; color: #FFFFFF;" href="<?php echo $this->_tpl_vars['base_dir']; ?>
cms.php?id_cms=15">Autres partenaires - Page 3</a>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['cms']->id == 15): ?>
	<a style="background-color: #DE0390; color: #FFFFFF;" href="<?php echo $this->_tpl_vars['base_dir']; ?>
cms.php?id_cms=14">Autres partenaires - Page 2</a>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['content_only']): ?>
	<div style="text-align:left; padding:10px;">
		<?php echo $this->_tpl_vars['cms']->content; ?>

	</div>
	<?php else: ?>
		<?php echo $this->_tpl_vars['cms']->content; ?>

	<?php endif; ?>
<?php else: ?>
	<?php echo smartyTranslate(array('s' => 'This page does not exist.'), $this);?>

<?php endif; ?>
<br />
<?php if (! $this->_tpl_vars['content_only']): ?>
<p><a href="<?php echo $this->_tpl_vars['base_dir']; ?>
" title="<?php echo smartyTranslate(array('s' => 'Home'), $this);?>
"><img src="<?php echo $this->_tpl_vars['img_dir']; ?>
icon/home.gif" alt="<?php echo smartyTranslate(array('s' => 'Home'), $this);?>
" class="icon" /></a><a href="<?php echo $this->_tpl_vars['base_dir']; ?>
" title="<?php echo smartyTranslate(array('s' => 'Home'), $this);?>
"><?php echo smartyTranslate(array('s' => 'Home'), $this);?>
</a></p>
<?php endif; ?>
