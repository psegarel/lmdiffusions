<?php

class BlockCategories extends Module
{
	function __construct()
	{
		$this->name = 'blockcategories';
		$this->tab = 'Blocks';
		$this->version = 1.0;

		parent::__construct();

		/* The parent construct is required for translations */
		$this->page = basename(__FILE__, '.php');
		$this->displayName = $this->l('Categories block');
		$this->description = $this->l('Adds a block featuring product categories');
	}

	function install()
	{
		if (parent::install() == false
			OR $this->registerHook('leftColumn') == false
			OR Configuration::updateValue('BLOCK_CATEG_MAX_DEPTH', 3) == false
			OR Configuration::updateValue('BLOCK_CATEG_DHTML', 1) == false)
			return false;
		return true;
	}

	public function getContent()
	{
		$output = '<h2>'.$this->displayName.'</h2>';
		if (Tools::isSubmit('submitBlockCategories'))
		{
			$maxDepth = intval(Tools::getValue('maxDepth'));
			$dhtml = Tools::getValue('dhtml');
			if ($maxDepth < 0)
				$output .= '<div class="alert error">'.$this->l('Maximum depth: Invalid number.').'</div>';
			elseif ($dhtml != 0 AND $dhtml != 1)
				$output .= '<div class="alert error">'.$this->l('Dynamic HTML: Invalid choice.').'</div>';
			else
			{
				Configuration::updateValue('BLOCK_CATEG_MAX_DEPTH', intval($maxDepth));
				Configuration::updateValue('BLOCK_CATEG_DHTML', intval($dhtml));
				$output .= '<div class="conf confirm"><img src="../img/admin/ok.gif" alt="'.$this->l('Confirmation').'" />'.$this->l('Settings updated').'</div>';
			}
		}
		return $output.$this->displayForm();
	}

	public function displayForm()
	{
		return '
		<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
			<fieldset>
				<legend><img src="'.$this->_path.'logo.gif" alt="" title="" />'.$this->l('Settings').'</legend>
				<label>'.$this->l('Maximum depth').'</label>
				<div class="margin-form">
					<input type="text" name="maxDepth" value="'.Configuration::get('BLOCK_CATEG_MAX_DEPTH').'" />
					<p class="clear">'.$this->l('Set the maximum depth of sublevels displayed in this block (0 = infinite)').'</p>
				</div>
				<label>'.$this->l('Dynamic').'</label>

				<div class="margin-form">
					<input type="radio" name="dhtml" id="dhtml_on" value="1" '.(Tools::getValue('dhtml', Configuration::get('BLOCK_CATEG_DHTML')) ? 'checked="checked" ' : '').'/>
					<label class="t" for="dhtml_on"> <img src="../img/admin/enabled.gif" alt="'.$this->l('Enabled').'" title="'.$this->l('Enabled').'" /></label>
					<input type="radio" name="dhtml" id="dhtml_off" value="0" '.(!Tools::getValue('dhtml', Configuration::get('BLOCK_CATEG_DHTML')) ? 'checked="checked" ' : '').'/>
					<label class="t" for="dhtml_off"> <img src="../img/admin/disabled.gif" alt="'.$this->l('Disabled').'" title="'.$this->l('Disabled').'" /></label>
					<p class="clear">'.$this->l('Activate dynamic (animated) mode for sublevels').'</p>
				</div>
				<center><input type="submit" name="submitBlockCategories" value="'.$this->l('Save').'" class="button" /></center>
			</fieldset>
		</form>';
	}

	function getTree($resultParents, $resultIds, $id_category = 1, $currentDepth = 0)
	{
		global $link;
		
		$children = array();
		if (isset($resultParents[$id_category]) AND sizeof($resultParents[$id_category]) AND (Configuration::get('BLOCK_CATEG_MAX_DEPTH') == 0 OR $currentDepth < Configuration::get('BLOCK_CATEG_MAX_DEPTH')))
			foreach ($resultParents[$id_category] as $subcat)
				$children[] = $this->getTree($resultParents, $resultIds, $subcat['id_category'], $currentDepth + 1);
		if (!isset($resultIds[$id_category]))
			return false;
		return array('id' => $id_category, 'link' => $link->getCategoryLink($id_category, $resultIds[$id_category]['link_rewrite']),
					 'name' => Category::hideCategoryPosition($resultIds[$id_category]['name']), 'desc'=> $resultIds[$id_category]['description'],
					 'children' => $children);
	}

	function hookLeftColumn($params)
	{
		global $smarty;

		/*  ONLY FOR THEME OLDER THAN v1.0 */
		global $link;
		$smarty->assign(array(
			'categories' => Category::getHomeCategories(intval($params['cookie']->id_lang), true),
			'link' => $link
		));
		/* ELSE */
		
		$result = Db::getInstance()->ExecuteS('
		SELECT * FROM '._DB_PREFIX_.'category c 
		LEFT JOIN '._DB_PREFIX_.'category_lang cl ON (c.id_category = cl.id_category AND id_lang = '.intval($params['cookie']->id_lang).')
		WHERE level_depth <= '.intval(Configuration::get('BLOCK_CATEG_MAX_DEPTH')).'
		AND c.active = 1
		ORDER BY level_depth, cl.name ASC');
		$resultParents = array();
		$resultIds = array();
		foreach ($result as $row)
		{
			$$row['name'] = Category::hideCategoryPosition($row['name']);
			$resultParents[$row['id_parent']][] = $row;
			$resultIds[$row['id_category']] = $row;
		}
		$blockCategTree = $this->getTree($resultParents, $resultIds);
				
		$isDhtml = (Configuration::get('BLOCK_CATEG_DHTML') == 1 ? true : false);

		if (isset($_GET['id_category']))
			$smarty->assign('currentCategoryId', intval($_GET['id_category']));
		$smarty->assign('blockCategTree', $blockCategTree);
		
		if (file_exists(_PS_THEME_DIR_.'modules/blockcategories/blockcategories.tpl'))
			$smarty->assign('branche_tpl_path', _PS_THEME_DIR_.'modules/blockcategories/category-tree-branch.tpl');
		else
			$smarty->assign('branche_tpl_path', _PS_MODULE_DIR_.'blockcategories/category-tree-branch.tpl');
		$smarty->assign('isDhtml', $isDhtml);
		/* /ONLY FOR THEME OLDER THAN v1.0 */

		return $this->display(__FILE__, 'blockcategories.tpl');
	}

	function hookRightColumn($params)
	{
		return $this->hookLeftColumn($params);
	}
}

?>