<?php

class Feeder extends Module
{
	private $_postErrors = array();
	
	public function __construct()
	{
		$this->name = 'feeder';
		$this->tab = 'Products';
		$this->version = 0.2;
		
		$this->_directory = dirname(__FILE__).'/../../';
		parent::__construct();
		
		/* The parent construct is required for translations */
		$this->page = basename(__FILE__, '.php');
		$this->displayName = $this->l('RSS products feed');
		$this->description = $this->l('Generate a RSS products feed');
	}
	
	function install()
	{
		if (!parent::install())
			return false;
		if (!$this->registerHook('header'))
			return false;
		return true;
	}
	
	function hookHeader($params)
	{
		global $smarty, $cookie;
		
		$id_category = intval(Tools::getValue('id_category'));
		if (!$id_category)
		{
			if (isset($_SERVER['HTTP_REFERER']) AND ereg('^(.*)\/([0-9]+)\-(.*[^\.])|(.*)id_category=([0-9]+)(.*)$', $_SERVER['HTTP_REFERER'], $regs) AND !strstr($_SERVER['HTTP_REFERER'], '.html'))
			{
				if (isset($regs[2]) AND is_numeric($regs[2]))
					$id_category = intval($regs[2]);
				elseif (isset($regs[5]) AND is_numeric($regs[5]))
					$id_category = intval($regs[5]);
			}
			elseif ($id_product = intval(Tools::getValue('id_product')))
			{
				$product = new Product($id_product);
				$id_category = $product->id_category_default;
			}
		}
		$category = new Category($id_category);
		$orderByValues = array(0 => 'name', 1 => 'price', 2 => 'date_add', 3 => 'date_upd', 4 => 'position');
		$orderWayValues = array(0 => 'ASC', 1 => 'DESC');
		$orderBy = Tools::strtolower(Tools::getValue('orderby', $orderByValues[intval(Configuration::get('PS_PRODUCTS_ORDER_BY'))]));
		$orderWay = Tools::strtoupper(Tools::getValue('orderway', $orderWayValues[intval(Configuration::get('PS_PRODUCTS_ORDER_WAY'))]));
		if (!in_array($orderBy, $orderByValues))
			$orderBy = $orderByValues[0];
		if (!in_array($orderWay, $orderWayValues))
			$orderWay = $orderWayValues[0];
		$smarty->assign(array(
			'feedUrl' => 'http://'.htmlspecialchars($_SERVER['HTTP_HOST'], ENT_COMPAT, 'UTF-8').__PS_BASE_URI__.'modules/'.$this->name.'/rss.php?id_category='.$id_category.'&amp;orderby='.$orderBy.'&amp;orderway='.$orderWay,
		));
		return $this->display(__FILE__, 'feederHeader.tpl');
	}
}
?>