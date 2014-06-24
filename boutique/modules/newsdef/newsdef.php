<?php

class newsdef extends Module
{
	function __construct()
	{
		$this->name = 'newsdef';
		$this->tab = 'Blocks';
		$this->version = 0.1;

		parent::__construct(); // The parent construct is required for translations

		$this->page = basename(__FILE__, '.php');
		$this->displayName = $this->l('newsdef');
		$this->description = $this->l('Adds a block to display an calculator');
	}

	function install()
	{
		if (!parent::install())
			return false;
		if (!$this->registerHook('rightColumn') OR !$this->registerHook('leftColumn'))
			return false;
		return true;
	}

	/**
	* Returns module content
	*
	* @param array $params Parameters
	* @return string Content
	*/
	function hookRightColumn($params)
	{
		global $smarty;

		$smarty->assign('image', './modules/'.$this->name.'/newsdef.jpg');

		// parse GET parameters : ?cms=9&iso=fr
		$id_lang = (isset($_GET['id_lang']) && !empty($_GET['id_lang'])) ? (int) $_GET['id_lang'] : 2;

		// load the cms object
		$cms = new CMS(intVal(11), $id_lang);
		$cms2 = new CMS(intVal(14), $id_lang);
		$cms3 = new CMS(intVal(15), $id_lang);

		if (!Validate::isLoadedObject($cms)) {
			//out.print('Could not find the CMS of ID '.$cmsId.'<br />');
		}

		$smarty->assign('partenaires', $cms->content . "<br />" . $cms2->content . "<br />" .  $cms3->content);


		return $this->display(__FILE__, 'newsdef.tpl');
	}

	function hookLeftColumn($params)
	{
		return $this->hookRightColumn($params);
	}

}

?>