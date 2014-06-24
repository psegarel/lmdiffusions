<?php /* Smarty version 2.6.20, created on 2009-06-22 12:30:18
         compiled from /homez.120/peruk/www/boutique/modules/homecategories/homecategories.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'l', '/homez.120/peruk/www/boutique/modules/homecategories/homecategories.tpl', 22, false),)), $this); ?>
<!-- MODULE Home categories created by Alpha Media (09 May 2008) -->
<?php if (isset ( $this->_tpl_vars['categories'] ) && $this->_tpl_vars['categories']): ?>

<div id="home-categories" class="clearfix">
<?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['homeCategories'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['homeCategories']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['category']):
        $this->_foreach['homeCategories']['iteration']++;
?>
<?php $this->assign('categoryLink', $this->_tpl_vars['link']->getcategoryLink($this->_tpl_vars['category']['id_category'],$this->_tpl_vars['category']['link_rewrite'])); ?>
    
    <div class="home-category <?php if (($this->_foreach['homeCategories']['iteration'] == $this->_foreach['homeCategories']['total'])): ?>last-item<?php endif; ?>">                    

        <a href="<?php echo $this->_tpl_vars['categoryLink']; ?>
" title="<?php echo $this->_tpl_vars['category']['legend']; ?>
"><img src="<?php echo $this->_tpl_vars['img_cat_dir']; ?>
<?php echo $this->_tpl_vars['category']['id_category']; ?>
-category.jpg" alt="<?php echo $this->_tpl_vars['category']['name']; ?>
" /></a>
        
        <p>
        
        </p>
        <a href="<?php echo $this->_tpl_vars['categoryLink']; ?>
" title="<?php echo $this->_tpl_vars['categoryName']; ?>
" class="eatme"></a>
        
    </div>
    
<?php endforeach; endif; unset($_from); ?>
</div>
<?php else: ?>
<p><?php echo smartyTranslate(array('s' => 'No categories','mod' => 'homecategories'), $this);?>
</p>
<?php endif; ?>
<!-- END MODULE Home categories --> 

