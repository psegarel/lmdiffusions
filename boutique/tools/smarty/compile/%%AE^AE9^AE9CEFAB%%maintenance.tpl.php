<?php /* Smarty version 2.6.20, created on 2014-06-12 16:24:12
         compiled from /home/peruk/www/boutique/themes/peruk/maintenance.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', '/home/peruk/www/boutique/themes/peruk/maintenance.tpl', 4, false),array('function', 'l', '/home/peruk/www/boutique/themes/peruk/maintenance.tpl', 21, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->_tpl_vars['lang_iso']; ?>
" lang="<?php echo $this->_tpl_vars['lang_iso']; ?>
">
	<head>
		<base href="http://<?php echo ((is_array($_tmp=$_SERVER['HTTP_HOST'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
<?php echo $this->_tpl_vars['base_dir']; ?>
" />
		<title><?php echo ((is_array($_tmp=$this->_tpl_vars['meta_title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</title>	
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php if (isset ( $this->_tpl_vars['meta_description'] )): ?>
		<meta name="description" content="<?php echo ((is_array($_tmp=$this->_tpl_vars['meta_description'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
" />
<?php endif; ?>
<?php if (isset ( $this->_tpl_vars['meta_keywords'] )): ?>
		<meta name="keywords" content="<?php echo ((is_array($_tmp=$this->_tpl_vars['meta_keywords'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
" />
<?php endif; ?>
		<meta name="robots" content="<?php if (isset ( $this->_tpl_vars['nobots'] )): ?>no<?php endif; ?>index,follow" />
		<link rel="shortcut icon" href="<?php echo $this->_tpl_vars['img_dir']; ?>
favicon.ico" />
		<link href="<?php echo $this->_tpl_vars['css_dir']; ?>
maintenance.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div id="maintenance">
			 <p><img src="<?php echo $this->_tpl_vars['base_dir']; ?>
img/logo.jpg" alt="logo" /><br /><br /></p>
			 <p id="message">
				<img src="<?php echo $this->_tpl_vars['base_dir']; ?>
img/admin/tab-tools.gif" style="margin-right:10px; float:left;" alt="" /><?php echo smartyTranslate(array('s' => 'In order to perform site maintenance, our online shop has been taken offline temporarily. We apologize for the inconvenience, and ask that you please try again later !'), $this);?>

			 </p>
			 <span style="clear:both;">&nbsp;</span>
		</div>
	</body>
</html>