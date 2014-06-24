<?php

class Homecategories extends Module
{
	private $_html = '';
	private $_postErrors = array();

	function __construct()
	{
		$this->name = 'homecategories';
		$this->tab = 'Home';
		$this->version = 0.1;

		parent::__construct(); // The parent construct is required for translations

		$this->page = basename(__FILE__, '.php');
		$this->displayName = $this->l('Frontpage Categories');
		$this->description = $this->l('Displays categories in the middle of your homepage');
	}

	function install()
	{
		if (!Configuration::updateValue('HOME_categories_NBR', 10) OR !parent::install() OR !$this->registerHook('home'))
			return false;
		return true;
	}

	public function getContent()
	{
		$output = '<h2>'.$this->displayName.'</h2>';
		if (Tools::isSubmit('submitHomecategories'))
		{
			$nbr = intval(Tools::getValue('nbr'));
			if (!$nbr OR $nbr <= 0 OR !Validate::isInt($nbr))
				$errors[] = $this->l('Invalid number of categories');
			else
				Configuration::updateValue('HOME_categories_NBR', $nbr);
			if (isset($errors) AND sizeof($errors))
				$output .= $this->displayError(implode('<br />', $errors));
			else
				$output .= $this->displayConfirmation($this->l('Settings updated'));
		}
		return $output.$this->displayForm();
	}

	public function displayForm()
	{
		$output = '
		<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
			<fieldset><legend><img src="'.$this->_path.'logo.gif" alt="" title="" />'.$this->l('Settings').'</legend>
				<label>'.$this->l('Number of categories displayed').'</label>
				<div class="margin-form">
					<input type="text" size="5" name="nbr" value="'.Tools::getValue('nbr', Configuration::get('HOME_categories_NBR')).'" />
					<p class="clear">'.$this->l('The number of catgeories displayed on homepage (default: 10)').'</p>
					
				</div>
				<center><input type="submit" name="submitHomecategories" value="'.$this->l('Save').'" class="button" /></center>
			</fieldset>
		</form>';
		return $output;
	}

	function hookHome($params)
	{
		global $smarty;
		$category = new Category(1);
		$nb = intval(Configuration::get('HOME_categories_NBR'));
		
		$smarty->assign(array(
			'category' => $category,
			'lang' => Language::getIsoById(intval($params['cookie']->id_lang)),
		));
		return $this->display(__FILE__, 'homecategories.tpl');
	}

}
