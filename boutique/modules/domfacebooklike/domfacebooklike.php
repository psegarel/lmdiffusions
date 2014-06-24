<?php
/**	domFacebookLike : Module pour site sous PrestaShop.
 *	Ajout du bouton J'aime de Facebook dans vos pages. 
 *	
 *	Version	1.0
 *
 *	Copyright Dominique PAUL.
 * 	Site de l'auteur : http://www.aideaunet.com
 *  
 *	Les scripts PHP de ce module sont sous Copyright.
 *  La modification des scripts de ce module est strictement INTERDITE.
 *
 *  Seules les scripts TPL (scripts de thèmes) et CSS (feuilles de style) sont autorisés à modification.
 *
 * 	Ce module est en téléchargement libre sur le site de l'auteur,
 * 	La distribution de ce module est INTERDITE sur tout autre support sans accord préalable de l'auteur.
 *
 **/
 
if (!defined('_CAN_LOAD_FILES_') AND _PS_VERSION_ > '1.3.2')
	exit;

class domFacebookLike extends Module
{
	function __construct()
	{
		$this->name = 'domfacebooklike';
		if(_PS_VERSION_<'1.4')
			$this->tab = $this->l('created or adapted by Domi');
		else
			$this->tab = 'front_office_features';
		$this->version = 1.0;
		$this->author = 'Dominique PAUL';
		$this->siteauthor = 'www.aideaunet.com';
		
		parent::__construct();
		$this->displayName = $this->l('domFacebookLike');
		if(_PS_VERSION_<'1.4')
			$this->displayName = $this->l('Display the like button.');
		else
			$this->displayName = $this->l('Created Domi : Display the like button.');
		$this->description = $this->l('This module adds the like button Facebook');
		$this->confirmUninstall = $this->l('Do you really want to uninstall this module ?');
	}

	public function install()
	{
		 if (!parent::install() 
			 || !Configuration::updateValue('MOD_DOMFACEBOOKLIKE_ACTIVE', 'on') 
			 || !$this->registerHook('ExtraLeft')
			 || !$this->installDb())
				return false;
			return true;
	}

	public function uninstall()
	{
		if(!parent::uninstall()  
		   || !Configuration::deleteByName('MOD_DOMFACEBOOKLIKE_ACTIVE')
		   || !$this->uninstallDB())				
		  return false;
		return true;
	}
	
	public function installDb()
  {
    if (!Db::getInstance()->Execute('
    CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'domfacebooklike` (
      `id_facebooklike` INT UNSIGNED NOT NULL PRIMARY KEY ,
      `layout` VARCHAR( 32 ) NOT NULL,
      `show_faces` VARCHAR( 32 ) NOT NULL,
      `width` VARCHAR( 4 ) NOT NULL,
      `action` VARCHAR( 32 ) NOT NULL,
      `colorscheme` VARCHAR( 32 ) NOT NULL,
      `scrolling` VARCHAR( 32 ) NOT NULL,
      `frameborder` VARCHAR( 32 ) NOT NULL,
      `allowTransparency` VARCHAR( 32 ) NOT NULL,
      `style` VARCHAR( 500 ) NOT NULL
    	) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;')) return false;
		if (!Db::getInstance()->Execute(
				'INSERT INTO `'._DB_PREFIX_.'domfacebooklike` 
				(`id_facebooklike`, `layout`, `show_faces`, `width`, `action`, `colorscheme`, `scrolling`, `frameborder`, `allowTransparency`, `style`) 
				VALUES (1, \'standard\',\'false\',\'450\', \'like\',\'light\',\'no\',\'0\',\'true\',\'border:none; overflow:hidden; width:450px; height:25px\')')) return false;
    return true;
  }

  private function uninstallDb()
  {
    Db::getInstance()->ExecuteS('DROP TABLE `'._DB_PREFIX_.'domfacebooklike`');
    return true;
  }
  
  
  private function getConfig()
	{	
		return Db::getInstance()->ExecuteS('SELECT * FROM `'._DB_PREFIX_.'domfacebooklike`');
	}
	
	private function setConfig()
  {
  	return Db::getInstance()->Execute('
					UPDATE '._DB_PREFIX_.'domfacebooklike SET 
					layout = "'.Tools::getValue('fb-layout').'",
					show_faces = "'.Tools::getValue('fb-show_faces').'",
					action = "'.Tools::getValue('fb-action').'",
					colorscheme = "'.Tools::getValue('fb-colorscheme').'",
					width = "'.Tools::getValue('fb-width').'",
					style = "'.Tools::getValue('fb-style').'"
					WHERE id_facebooklike = 1');
  }
	
	public function getContent()
	{
		$output = '<h2>'.$this->displayName.'</h2>';
		if (Tools::isSubmit('submit'.$this->extension)){
			if ($this->setConfig())
				$output .= $this->displayConfirmation($this->l('Settings updated'));
			else
				$output .= $this->displayError($this->l('error when updating configuration'));
		}
		return $output.$this->displayForm();
	}
	
	public function displayForm()
	{
		$this->_html = '
		<fieldset>
			<legend><img src="'.$this->_path.'logo.gif" alt="" title="" />'.$this->l('Settings').'</legend>
				<form action="'.$_SERVER['REQUEST_URI'].'" method="post">';		
		$this->_html .= '<div style="margin-top:30px;">';
		$this->getForm();
		$this->_html .= '</div>';
				
		$this->_html .= '		
					<div style="margin:0 auto; clear:both; text-align:center;"><input type="submit" name="submit'.$this->extension.'" value="&nbsp;'.$this->l('Save').'&nbsp;" class="button" /></div>
				</form>';
		$this->_html .= '<div style="clear:both;padding-top: 30px;float:left;"><hr />';
		$this->getLicence();
		$this->getInformation();		
		$this->_html .= '</div></fieldset>';
		$this->displayDon();
		return $this->_html;
	}	
			

	function getForm() {
		$config = $this->getConfig();
		$this->_html .= '
				<div style="display:block; float:left; margin-bottom:40px;">';
		$this->_html .= '
					<div style="float:left;">
						<div style="float:left;margin-top: 5px;"> 
							<label>'.$this->l('button type:').'&nbsp;</label> 
		        </div> 
		        <div style="float:left; margin-left: 20px;"> 
							<div style="margin-top:5px;">
								<input group="fb-layout" id="fb-layout-standard" name="fb-layout" type="radio" value="standard"';
								($config[0]['layout']=="standard")? $this->_html .= ' checked="checked"':$this->_html .= '';$this->_html .= ' />  
								<label style="float:none;" for="fb-layout-standard">'.$this->l('Standard').'
								<span style="font-weight:normal;">&nbsp; ('.$this->l('width mini: 225px').')</span></label>
							</div> 
							<div style="margin-top:5px;">
								<input group="fb-layout" id="fb-layout-button_count" name="fb-layout" type="radio" value="button_count"';
								($config[0]['layout']=="button_count")? $this->_html .= ' checked="checked"':$this->_html .= '';$this->_html .= ' /> 
								<label style="float:none;" for="fb-layout-button_count">'.$this->l('button_count').'
								<span style="font-weight:normal;">&nbsp; ('.$this->l('width mini: 90px').')</span></label> 
							</div> 
							<div style="margin-top:5px;">
								<input group="fb-layout" id="fb-layout-box_count" name="fb-layout" type="radio" value="box_count"';
								($config[0]['layout']=="box_count")? $this->_html .= ' checked="checked"':$this->_html .= '';$this->_html .= ' />  
								<label style="float:none;" for="fb-layout-box_count">'.$this->l('box_count').'
								<span style="font-weight:normal;">&nbsp; ('.$this->l('width mini: 55px').')</span></label> 
							</div> 
						</div>
          </div>';
		$this->_html .= '
					<div style="clear:both;padding-top:20px;float:left;">
						<div style="float:left;margin-top: 5px;"> 
							<label>'.$this->l('action:').'&nbsp;</label> 
		        </div> 
		        <div style="float:left; margin-left: 20px;"> 
							<div style="margin-top:5px;">
								<input group="fb-action" id="fb-action-like" name="fb-action" type="radio" value="like"';
								($config[0]['action']=="like")? $this->_html .= ' checked="checked"':$this->_html .= '';$this->_html .= ' />  
								<label style="float:none;" for="fb-action-like">'.$this->l('Like').'</label>
							</div> 
							<div style="margin-top:5px;">
								<input group="fb-action" id="fb-action-recommend" name="fb-action" type="radio" value="recommend"';
								($config[0]['action']=="recommend")? $this->_html .= ' checked="checked"':$this->_html .= '';$this->_html .= ' />   
								<label style="float:none;" for="fb-action-recommend">'.$this->l('Recommend').'</label> 
							</div> 
						</div>
          </div>';
    $this->_html .= '
					<div style="clear:both;padding-top:20px;float:left;">
						<div style="float:left;margin-top: 5px;"> 
							<label>'.$this->l('show faces:').'&nbsp;</label> 
		        </div> 
		        <div style="float:left; margin-left: 20px;"> 
							<div style="margin-top:5px;">
								<input group="fb-show_faces" id="fb-show_faces-true" name="fb-show_faces" type="radio" value="true"';
								($config[0]['show_faces']=="true")? $this->_html .= ' checked="checked"':$this->_html .= '';$this->_html .= ' />  
								<label style="float:none;" for="fb-show_faces-true">'.$this->l('Yes').'</label>
							</div> 
							<div style="margin-top:5px;">
								<input group="fb-show_faces" id="fb-show_faces-false" name="fb-show_faces" type="radio" value="false"';
								($config[0]['show_faces']=="false")? $this->_html .= ' checked="checked"':$this->_html .= '';$this->_html .= ' /> 
								<label style="float:none;" for="fb-show_faces-false">'.$this->l('No').'</label> 
							</div> 
						</div>
          </div>';
    $this->_html .= '
					<div style="clear:both;padding-top:20px;float:left;">
						<div style="float:left;margin-top: 5px;"> 
							<label>'.$this->l('colorscheme:').'&nbsp;</label> 
		        </div> 
		        <div style="float:left; margin-left: 20px;"> 
							<div style="margin-top:5px;">
								<input group="fb-colorscheme" id="fb-colorscheme-light" name="fb-colorscheme" type="radio" value="light"';
								($config[0]['colorscheme']=="light")? $this->_html .= ' checked="checked"':$this->_html .= '';$this->_html .= ' /> 
								<label style="float:none;" for="fb-colorscheme-light">'.$this->l('Light').'</label>
							</div> 
							<div style="margin-top:5px;">
								<input group="fb-colorscheme" id="fb-colorscheme-dark" name="fb-colorscheme" type="radio" value="dark"';
								($config[0]['colorscheme']=="dark")? $this->_html .= ' checked="checked"':$this->_html .= '';$this->_html .= ' /> 
								<label style="float:none;" for="fb-colorscheme-dark">'.$this->l('Dark').'</label> 
							</div> 
						</div>
          </div>';
    $this->_html .= '
					<div style="clear:both;padding-top:20px;float:left;">
						<div style="float:left;margin-top: 5px;"> 
							<label>'.$this->l('Width:').'&nbsp;</label> 
		        </div> 
		        <div style="float:left; margin-left: 20px;"> 
							<div style="margin-top:5px;">
								<input type="text" size="4" id="fb-width" name="fb-width" value="'.$config[0]['width'].'" /> Pixels
							</div> 
						</div>
          </div>';
    $this->_html .= '
					<div style="clear:both;padding-top:20px;float:left;">
						<div style="float:left;margin-top: 5px;"> 
							<label>'.$this->l('Style:').'&nbsp;</label> 
		        </div> 
		        <div style="float:left; margin-left: 20px;"> 
							<div style="margin-top:5px;">
								<input type="text" size="80" id="fb-style" name="fb-style" value="'.$config[0]['style'].'" />
							</div> 
						</div>
          </div>';
    $this->_html .= '
				</div>';
	}
	
	function getLicence()
	{
		$this->_html .= '
				<div style="margin: 20px 0 0 20px;">
					Module créer par '.$this->author.'<br />
					D\'autres modules sur <a href="http://'.$this->siteauthor.'" target="_news">'.$this->siteauthor.'</a>
				</div>';
	}
	
	function getInformation()
	{
		$this->_html .= '<div>&nbsp;<br />
				<p><span style="font-weight:bold">NOTA : </span>
					<span>Afin d\'appaitre dans les "fiches produits", le module est greffé par défaut dans le Hook "ExtraLeft", <br />
						Pensez à le greffer sur les autres Hook où vous souhaitez le voir apparaitre.
					</span>
				</p></div>';		
	}
	
	public function displayDon()
	{
		$this->_html .= '<p>&nbsp;</p>
		<fieldset>
			<legend><img src="../img/admin/unknown.gif" alt="'.$this->l('free does not become paying').'" title="" />'.$this->l('free does not become paying').'</legend>';
		$this->_html .= '<p>Vous utilisez ici un module certe Gratuit, mais pensez que ce module à demandé pour sa réalisation plusieurs heures de développement à son concepteur.<br />';
		$this->_html .= 'Afin d\'encourager le développement de module gratuit, pensez à effectuer un don à leurs auteurs.</p>';
		$this->_html .= '<p>Dites vous simplement que le travail n\'est pas gratuit, seulement aujourd\'hui, au lieu d\'acheter un module à un prix fixé par son auteur, vous achetez un module au prix que vous souhaitez,	en effectuant vous même l\'achat sous forme de don au prix que vous estimez le plus juste afin d\'encourager l\'auteur à continuer ce type de formule.</p>';
		$this->_html .= '<p>Je ne vous cache pas que si ce mode de contribution ne fonctionne pas, dans l\'avenir, mes modules seront payant :-(</p>';
		$this->_html .= '<p>&nbsp;</p>';
		$this->_html .= '<div style="margin:0 auto; text-align:center;"><form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
							<input type="hidden" name="cmd" value="_s-xclick">
							<input type="hidden" name="hosted_button_id" value="HA4G6D6YSY9TW">
							<input type="image" src="https://www.paypalobjects.com/fr_FR/FR/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - la solution de paiement en ligne la plus simple et la plus sécurisée !">
							<img alt="" border="0" src="https://www.paypalobjects.com/fr_FR/i/scr/pixel.gif" width="1" height="1">
							</form></div>';
		$this->_html .= '<p>&nbsp;</p><p>You use this module may be free, but think that this module required for its completion several hours of development to its designer.
							To encourage the development of free module, consider making a donation to the poster.</p>
							<p>Just say that the work is not free, only now, instead of buying one unit at a price set by its author, you buy a module at the price you want, by yourself in the purchase a gift at the price you think the fairest to encourage the author to continue this type of formula.</p>
							<p>I will not deny that if this type of contribution does not work in the future, my modules will be paid :-(</p>';
		$this->_html .= '</fieldset>';
	}
	
	
	function hookLeftColumn($params){
		global $smarty;
		$config = $this->getConfig();
		$smarty->assign(array(
			'layout' => $config[0]['layout'], 
			'show_faces' => $config[0]['show_faces'],
			'width' => $config[0]['width'],
			'action' => $config[0]['action'],
			'colorscheme' => $config[0]['colorscheme'],
			'scrolling' => $config[0]['scrolling'],
			'frameborder' => $config[0]['frameborder'], 
			'allowTransparency' => $config[0]['allowTransparency'],
			'style' => $config[0]['style'],
			'moduleinfo' => $this->name.' - '.$this->version.' - '.$this->l('author:').' '.$this->author,
			'modulename' => $this->name,
			'adresseweb' => 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']
			));
		return $this->display(__FILE__, $this->name.'.tpl');
	}
	function hookRightColumn($params){
		return $this->hookLeftColumn($params);
	}
	function hookTop($params){
		return $this->hookLeftColumn($params);
	}
	public function hookExtraLeft($params) {
		return $this->hookLeftColumn($params);
	}
	public function hookExtraRight($params) {
		return $this->hookLeftColumn($params);
	}	
	function hookHome($params){
		global $smarty;
		$config = $this->getConfig();
		$smarty->assign(array(
			'layout' => $config[0]['layout'], 
			'show_faces' => $config[0]['show_faces'],
			'width' => $config[0]['width'],
			'action' => $config[0]['action'],
			'colorscheme' => $config[0]['colorscheme'],
			'scrolling' => $config[0]['scrolling'],
			'frameborder' => $config[0]['frameborder'], 
			'allowTransparency' => $config[0]['allowTransparency'],
			'style' => $config[0]['style'],
			'moduleinfo' => $this->name.' - '.$this->version.' - '.$this->l('author:').' '.$this->author,
			'modulename' => $this->name,
			'adresseweb' => 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']
			));
		return $this->display(__FILE__, $this->name.'-home.tpl');
	}
	

}
?>
