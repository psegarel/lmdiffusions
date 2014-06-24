<?php

class BlockNavigation extends Module
{

	function __construct()
	{
		$this->name = 'blocknavigation';
		$this->tab = 'Blocks';
		$this->version = 0.3;
		$this->error = false;
		$this->valid = false;

		$this->confirmUninstall = $this->l('Are you sure you want to delete all informations?');


		parent::__construct();

		/* The parent construct is required for translations */
		$this->page = basename(__FILE__, '.php');
		$this->displayName = $this->l('Navigation block');
		$this->description = $this->l('Adds a block with: search, categories, manufacturer, supplier, tags');
	}

	function install()
	{
		if (parent::install() == false OR $this->registerHook('leftColumn') == false ) return false;
		if (!Configuration::updateValue('NAVIGATION_CAT', "1" )) return false;
		if (!Configuration::updateValue('NAVIGATION_SEARCH', "1" )) return false;
		if (!Configuration::updateValue('NAVIGATION_TAGS', "1" )) return false;
		if (!Configuration::updateValue('NAVIGATION_SUPPLIER', "1" )) return false;
		if (!Configuration::updateValue('NAVIGATION_MANUFACTURER', "1" )) return false;
		return true;
	}

 	public function uninstall()
 	{
 	 	if (!parent::uninstall()) return false;
		if (!Configuration::deleteByName('NAVIGATION_SEARCH')) return false;
		if (!Configuration::deleteByName('NAVIGATION_CAT')) return false;
		if (!Configuration::deleteByName('NAVIGATION_SUPPLIERS')) return false;
		if (!Configuration::deleteByName('NAVIGATION_MANUFACTURER')) return false;
		if (!Configuration::deleteByName('NAVIGATION_TAGS')) return false;
		return true;
	}

	function hookLeftColumn($params)
	{
		global $smarty, $cookie, $link;

		/* GETTING CONFIGURATION VARS */
		$show_search=intval(Configuration::get('NAVIGATION_SEARCH'));
		$cat_select=explode("|",Configuration::get('NAVIGATION_CAT'));
		$show_man=intval(Configuration::get('NAVIGATION_MANUFACTURER'));
		$show_sup=intval(Configuration::get('NAVIGATION_SUPPLIERS'));
		$show_tag=intval(Configuration::get('NAVIGATION_TAGS'));

	 	/* GETTING CATEGORIES */
		$result = Category::getCategories(intval($cookie->id_lang), true,false);
		$categories = array();
		$index=array();

		$ix=0;
		foreach ($result AS $row)
		{
				$name = preg_replace('/^[0-9]+\./', '', $row['name']);
				$categories[] = array('id' => $row['id_category'], 'id_parent' => $row['id_parent'], 'name' => $name);
				$index[$row['id_category']] = $ix++;
		}

		$show_cat=(sizeof($cat_select) ? 1 : 0);
		$show_cat=1;
		$cat_sel=array();

		foreach ($cat_select AS $sel){
			$opt=array();
			$id=$index[$sel];
			$opt[] = array('id'=>$sel, 'name'=>$categories[$id]['name']);
			foreach ($categories AS $cat){
				if( $cat['id_parent'] == $sel ){
					$opt[] = array('id'=>$cat['id'], 'name'=>$cat['name']);
				}
			}
			$cat_sel[] = $opt;
		}


		/* GETTING MANUFACTURER */
		$man_sel=array();
		if ($show_man==1){
			$man_sel = Manufacturer::getManufacturers(false,intval($params['cookie']->id_lang),true);
			if (sizeof($man_sel)) sort( $man_sel );
			else $show_man=0;
		}

		/* GETTING SUPPLIERS */
		$sup_sel=array();
		if ($show_sup==1){
			$sup_sel = Supplier::getSuppliers(false,intval($params['cookie']->id_lang),true);
			if (!sizeof($sup_sel)) $show_sup=0;
		}

		/* GETTING TAGS */
		$tag_sel=array();
		if ($show_tag==1){
			$tag_sel = Tag::getMainTags(intval($params['cookie']->id_lang),200);
			if (sizeof($tag_sel)) sort( $tag_sel );
			else $show_tag=0;
		}

		$smarty->assign(array(
			'link' => $link,
			'show_search' => $show_search,
			'show_tag' => $show_tag,
			'show_man' => $show_man,
			'show_cat' => $show_cat,
			'show_sup' => $show_sup,
			'cat_sel' => $cat_sel,
			'tag_sel'=> $tag_sel,
			'man_sel' => $man_sel,
			'sup_sel' => $sup_sel
		));
		return $this->display(__FILE__, 'blocknavigation.tpl');
	}


	function hookRightColumn($params)
	{
		return $this->hookLeftColumn($params);
	}

	public function getContent()
	{
		$this->_html = '<h2>'.$this->displayName.'</h2>';

		if (!empty($_POST))
		{
			$this->_postValidation();
			if (!sizeof($this->_postErrors))
				$this->_postProcess();
			else
				foreach ($this->_postErrors AS $err)
					$this->_html .= '<div class="alert error">'. $err .'</div>';
		}
		else
			$this->_html .= '<br />';

		$this->_displayForm();

		return $this->_html;
	}

	private function _postValidation()
	{

		$var="";
		for( $i=0; $i<100; $i++)
			if (isset($_POST['cat_'.$i]))
				if (intval($_POST['cat_'.$i]) > 0 )
					$var .= ($var > "" ? "|" : "" ) . intval($_POST['cat_'.$i]);

		Configuration::updateValue('NAVIGATION_CAT', $var);

		if (isset($_POST['include_search']))	Configuration::updateValue('NAVIGATION_SEARCH', intval($_POST['include_search']));
		if (isset($_POST['include_tags']))	Configuration::updateValue('NAVIGATION_TAGS', intval($_POST['include_tags']));
		if (isset($_POST['include_manufacturer']))	Configuration::updateValue('NAVIGATION_MANUFACTURER', intval($_POST['include_manufacturer']));
		if (isset($_POST['include_supplier']))	Configuration::updateValue('NAVIGATION_SUPPLIER', intval($_POST['include_supplier']));


		if (isset($errors) AND sizeof($errors))
			$this->_html .= $this->displayError(implode('<br />', $errors));
		else
			$this->_html .= $this->displayConfirmation($this->l('Settings updated'));
	}

	private function _postProcess()
	{
		/* $this->_html .= '<div class="conf confirm"><img src="../img/admin/ok.gif" alt="'.$this->l('ok').'" /> '.$this->l('Settings updated').'</div>'; */
	}


	private function _displayForm()
	{
		global $cookie;
		$result = Category::getCategories(intval($cookie->id_lang), true,false);
		$categories = array();

		$ix=0;
		foreach ($result AS $row)
		{
				$name = preg_replace('/^[0-9]+\./', '', $row['name']);
				$categories[] = array('id' => $row['id_category'], 'id_parent' => $row['id_parent'], 'name' => $name);
				$index[$row['id_category']] = $ix++;
		}

		$cats=explode("|",Configuration::get('NAVIGATION_CAT'));
		$search=intval(Configuration::get('NAVIGATION_SEARCH'));
		$tags=intval(Configuration::get('NAVIGATION_TAGS'));
		$manufacturer=intval(Configuration::get('NAVIGATION_MANUFACTURER'));
		$supplier=intval(Configuration::get('NAVIGATION_SUPPLIER'));

		$this->_html .=
		'<form action="'.$_SERVER['REQUEST_URI'].'" method="post" enctype="multipart/form-data">
			<fieldset>
				<table cellspacing="2" cellpadding="2" class="table">
					<tr>
						<td align="right">'.$this->l('Show search query?').'
						<td>'.$this->l('Yes').'&nbsp;<input type="radio" value="1" name="include_search" '.($search==1 ? 'checked="checked"' : '').'></td>
						<td>'.$this->l('No').'&nbsp;<input type="radio" value="0" name="include_search" '.($search==0 ? 'checked="checked"' : '').'></td>
					</tr>
					<tr>
						<td align="right">'.$this->l('Show tags?').'</td>
						<td>'.$this->l('Yes').'&nbsp;<input type="radio" value="1" name="include_tags" '.($tags==1 ? 'checked="checked"' : '').'></td>
						<td>'.$this->l('No').'&nbsp;<input type="radio" value="0" name="include_tags" '.($tags==0 ? 'checked="checked"' : '').'></td>
					</tr>
					<tr>
						<td align="right">'.$this->l('Show manufacturer?').'</td>
						<td>'.$this->l('Yes').'&nbsp;<input type="radio" value="1" name="include_manufacturer" '.($manufacturer==1 ? 'checked="checked"' : '').'></td>
						<td>'.$this->l('No').'&nbsp;<input type="radio" value="0" name="include_manufacturer" '.($manufacturer==0 ? 'checked="checked"' : '').'></td>
					</tr>
					<tr>
						<td align="right">'.$this->l('Show supplier?').'</td>
						<td>'.$this->l('Yes').'&nbsp;<input type="radio" value="1" name="include_supplier" '.($supplier==1 ? 'checked="checked"' : '').'></td>
						<td>'.$this->l('No').'&nbsp;<input type="radio" value="0" name="include_supplier" '.($supplier==0 ? 'checked="checked"' : '').'></td>
					</tr>
				</table>
			</fieldset>
			<br />
			<fieldset>
				<legend>'.$this->l('Please select one gategory for each row').'</legend>
				<table cellspacing="0" cellpadding="0" class="table" style="width: 29.5em;">';
		$ix=1;
		foreach( $cats as $cat) {
			$cat=intval($cat);
			$name=$categories[$index[$cat]]['name'];
			$this->_html .='
					<tr>
						<td>'.$ix.'.</td>
						<td>'.$this->select_cat($categories,$ix,$cat).'</td>
						<td></td>
					</tr>';
			$ix++;
		}
		$this->_html .='
				<tr>
					<td>'.$ix.'.</td>
					<td>'.$this->select_cat($categories,$ix,0).'</td>
					<td> <- '.$this->l('New category').'</td>
				</tr>';
		$this->_html .='
				</table>
			</fieldset>
			<br />
			<input class="button" name="mycatSubmit" value="'.$this->l('Update settings').'" type="submit" />&nbsp;&nbsp;&nbsp;&nbsp;
		</form>';
	}


	private function select_catXXX($cats, $num_sel, $id_sel=0)
	{
		$result='<select name="cat_'.$num_sel.'">' ."\n";
		$result .= '<option value="0"'.$id.'"'.($id==$id_sel ? ' selected="selected"' : '').">--</option>\n";
		foreach( $cats as $cat){
			$id=$cat['id'];
			$result .= '<option value="'.$id.'"'.($id==$id_sel ? ' selected="selected"' : '').'>'.$cat['name']."</option>\n";
		}
		$result .= "</select>\n";
	 	return( $result );
	}

	private function select_cat($cats, $num_sel, $id_sel=0)
	{
		global $cookie;
		$result = Category::getCategories(intval($cookie->id_lang), true,false);
		$cats=array();
		foreach ($result AS $row)
		{
				$name = preg_replace('/^[0-9]+\./', '', $row['name']);
				$cats[] = array('id' => $row['id_category'], 'id_parent' => $row['id_parent'], 'name' => $name);
		}


		$result='<select name="cat_'.$num_sel.'">' ."\n";
		$result .= '<option value="0"'.$id.'"'.($id==$id_sel ? ' selected="selected"' : '').">--</option>\n";
		foreach( $cats as $cat){
			$id=$cat['id'];
			$result .= '<option value="'.$id.'"'.($id==$id_sel ? ' selected="selected"' : '').'>'.$cat['name']."</option>\n";
		}
		$result .= "</select>\n";
	 	return( $result );
	}

}

?>
