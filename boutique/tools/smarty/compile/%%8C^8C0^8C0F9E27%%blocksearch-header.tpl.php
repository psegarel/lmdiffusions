<?php /* Smarty version 2.6.20, created on 2014-06-25 16:15:18
         compiled from /WebDev/peruk/versions/www_update/boutique/modules/blocksearch/blocksearch-header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'htmlentities', '/WebDev/peruk/versions/www_update/boutique/modules/blocksearch/blocksearch-header.tpl', 6, false),array('function', 'l', '/WebDev/peruk/versions/www_update/boutique/modules/blocksearch/blocksearch-header.tpl', 7, false),)), $this); ?>
<!-- Block search module HEADER -->
<div id="search_block_top">
	<form method="get" action="<?php echo $this->_tpl_vars['base_dir']; ?>
search.php" id="searchbox">
	<p>
		<label for="search_query"><!-- image on background --></label>
		<input type="text" id="search_query" name="search_query" value="<?php if (isset ( $_GET['search_query'] )): ?><?php echo ((is_array($_tmp=$_GET['search_query'])) ? $this->_run_mod_handler('htmlentities', true, $_tmp, $this->_tpl_vars['ENT_QUOTES'], 'utf-8') : htmlentities($_tmp, $this->_tpl_vars['ENT_QUOTES'], 'utf-8')); ?>
<?php endif; ?>" />
		<input type="submit" name="submit_search" value="<?php echo smartyTranslate(array('s' => '','mod' => 'blocksearch'), $this);?>
" class="button recherche_top" />
	</p>
	</form>
</div>
<!-- /Block search module HEADER -->