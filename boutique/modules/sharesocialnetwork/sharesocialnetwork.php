<?php

class sharesocialnetwork extends Module
{
 	function __construct()
 	{
 	 	$this->name = 'sharesocialnetwork';
 	 	$this->version = '0.3';
 	 	$this->tab = 'Products';
		
		parent::__construct();
		
		$this->displayName = $this->l('Share on social network');
		$this->description = $this->l('Share product on social network');
 	}

	function install()
	{
	 	if (!parent::install())
	 		return false;
	 	return $this->registerHook('extraLeft');
	}
	
	function hookExtraLeft()
	{
		global $smarty;
		$smarty->assign('this_path', $this->_path);

		return $this->display(__FILE__, 'sharesocialnetwork.tpl');		
	}

}
