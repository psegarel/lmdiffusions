<?php
/**	domGoogleOne : Module pour site sous PrestaShop.
 *	Ajout du bouton Google +1 dans vos pages. 
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

class domgoogleone extends Module
{
	public function __construct()
	{
		$this->name = 'domgoogleone';
		if(_PS_VERSION_<'1.4')
			$this->tab = $this->l('created or adapted by Domi');
		else
			$this->tab = 'front_office_features';
		$this->version = 1.0;
		$this->author = 'Dominique PAUL';
		$this->siteauthor = 'www.aideaunet.com';
		
		parent::__construct();
		$this->displayName = $this->l('Google+1');
		if(_PS_VERSION_<'1.4')
			$this->displayName = $this->l('Adds a Google+1 button.');
		else
			$this->displayName = $this->l('Created Domi : Adds a Google+1 button.');
		$this->description = $this->l('This module adds the Google button');
		$this->confirmUninstall = $this->l('Do you really want to uninstall this module ?');
	}

	
	public function install()
	{
		 if (!parent::install() 
			 || !Configuration::updateValue('MOD_DOMGOOGLEONE_ACTIVE', 'on') 
			 || !$this->registerHook('ExtraLeft') 
       || !$this->installDb())
				return false;
			return true;
	}

	public function uninstall()
	{
		if(!parent::uninstall() || 
		   !Configuration::deleteByName('MOD_DOMGOOGLEONE_ACTIVE') ||
       !$this->uninstallDB())				
		  return false;
		return true;
	}
	
	  public function installDb()
  {
    if (!Db::getInstance()->Execute('
    CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'domgoogleone` (
      `id_googleone` INT UNSIGNED NOT NULL PRIMARY KEY ,
      `type` VARCHAR( 128 ) NOT NULL,
      `lang` VARCHAR( 128 ) NOT NULL,
      `total`TINYINT( 1 ) NOT NULL
    ) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;')) return false;
		if (!Db::getInstance()->Execute('INSERT INTO `'._DB_PREFIX_.'domgoogleone` (`id_googleone`, `type`, `lang`, `total`) 
				VALUES (1, \'medium\',\'fr\',1)')) return false;
    return true;
  }

  private function uninstallDb()
  {
    Db::getInstance()->ExecuteS('DROP TABLE `'._DB_PREFIX_.'domgoogleone`');
    return true;
  }
  
  private function setConfig()
  {
		if(Tools::getValue('plusone-include-count')=="on") $compteur=1; else $compteur=0; 
  	return Db::getInstance()->Execute('
					UPDATE '._DB_PREFIX_.'domgoogleone SET type = "'.Tools::getValue('plusone-type').'",
					lang = "'.Tools::getValue('plusone-lang').'",
					total = '.$compteur.'
					WHERE id_googleone = 1');
  }
  
  	private function getConfig()
	{	
		return Db::getInstance()->ExecuteS('SELECT * FROM `'._DB_PREFIX_.'domgoogleone`');
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
		$this->_html .= '<div style="height:120px;margin-top:30px;">';
		$this->getForm();
		$this->_html .= '</div>';
				
		$this->_html .= '		
					<div style="margin:0 auto;float:none;display:block;"><center><input type="submit" name="submit'.$this->extension.'" value="&nbsp;'.$this->l('Save').'&nbsp;" class="button" /></center></div>
				</form>';
		$this->getLicence();
		$this->_html .= '<div>&nbsp;<br />
				<p><span style="font-weight:bold">NOTA : </span>
					<span>Afin d\'appaitre dans les "fiches produits", le module est greffé par défaut dans le Hook "ExtraLeft", <br />
						Pensez à le greffer sur les autres Hook où vous souhaitez le voir apparaitre.
					</span>
				</p></div>';		
		$this->_html .= '</fieldset>';
		$this->displayDon();
		return $this->_html;
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
	

	function getForm() {
		$config = $this->getConfig();
		$this->_html .= '
				<div> 
					<div> 
						<label>'.$this->l('Size:').'&nbsp;</label> 
          </div> 
          <div style="float:left; margin-left: 20px;"> 
						<div style="margin-top:5px;">
							<input group="plusone-type" id="plusone-type-small" name="plusone-type" type="radio" value="small"';
		($config[0]['type']=="small")? $this->_html .= ' checked="checked"':$this->_html .= '';$this->_html .= '> 
							<label style="float:none;" for="plusone-type-small">'.$this->l('Small').'&nbsp;(15&nbsp;px)</label>
						</div> 
						<div style="margin-top:5px;">
							<input group="plusone-type" id="plusone-type-medium" name="plusone-type" type="radio" value="medium"';
		($config[0]['type']=="medium")? $this->_html .= ' checked="checked"':$this->_html .= '';$this->_html .= '> 
							<label style="float:none;" for="plusone-type-medium">'.$this->l('Medium').'&nbsp;(20&nbsp;px)</label> 
						</div> 
						<div style="margin-top:5px;">
							<input group="plusone-type" id="plusone-type-standard" name="plusone-type" type="radio" value="standard"';
		($config[0]['type']=="standard")? $this->_html .= ' checked="checked"':$this->_html .= '';$this->_html .= '>  
							<label style="float:none;" for="plusone-type-standard">'.$this->l('Standard').'&nbsp;(24&nbsp;px)</label> 
						</div> 
						<div style="margin-top:5px;">
							<input group="plusone-type" id="plusone-type-tall" name="plusone-type" type="radio"value="tall"';
		($config[0]['type']=="tall")? $this->_html .= ' checked="checked"':$this->_html .= '';$this->_html .= '> 
							<label style="float:none;" for="plusone-type-tall">'.$this->l('Tall').'&nbsp;(60 px)</label> 
						</div>
          </div> 
				</div>
				<div style="float:left;margin-left:100px;">
          <div style="float:left;">
						<label for="plusone-lang">'.$this->l('Language:').'&nbsp;</label> 
          </div> 
          <div style="float:left;"> 
						<select id="plusone-lang" name="plusone-lang"> ';
		$this->_html .= '<option value="ar"'; ($config[0]['lang']=='ar')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>Arabic</option>';
    $this->_html .= '<option value="bg"'; ($config[0]['lang']=='bg')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>Bulgarian</option>'; 
    $this->_html .= '<option value="ca"'; ($config[0]['lang']=='ca')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>Catalan</option>';
    $this->_html .= '<option value="zh-CN"'; ($config[0]['lang']=='zh-CN')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>Chinese (Simplified)</option>';
    $this->_html .= '<option value="zh-TW"'; ($config[0]['lang']=='zh-TW')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>Chinese (Traditional)</option>';
    $this->_html .= '<option value="hr"'; ($config[0]['lang']=='hr')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>Croatian</option>';
    $this->_html .= '<option value="cs"'; ($config[0]['lang']=='cs')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>Czech</option>';
    $this->_html .= '<option value="da"'; ($config[0]['lang']=='da')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>Danish</option>';
    $this->_html .= '<option value="nl"'; ($config[0]['lang']=='nl')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>Dutch</option>';
		$this->_html .= '<option value="en-US"'; ($config[0]['lang']=='en-US')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>English (US)</option>';
		$this->_html .= '<option value="en-GB"'; ($config[0]['lang']=='en-GB')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>English (UK)</option>';
    $this->_html .= '<option value="et"'; ($config[0]['lang']=='et')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>Estonian</option>';
    $this->_html .= '<option value="fil"'; ($config[0]['lang']=='fil')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>Filipino</option>';
    $this->_html .= '<option value="fi"'; ($config[0]['lang']=='fi')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>Finnish</option>';
		$this->_html .= '<option value="fr"'; ($config[0]['lang']=='fr')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>French</option>'; 
    $this->_html .= '<option value="de"'; ($config[0]['lang']=='de')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>German</option>';
    $this->_html .= '<option value="el"'; ($config[0]['lang']=='el')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>Greek</option>';
    $this->_html .= '<option value="iw"'; ($config[0]['lang']=='iw')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>Hebrew</option>';
    $this->_html .= '<option value="hi"'; ($config[0]['lang']=='hi')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>Hindi</option>';
    $this->_html .= '<option value="hu"'; ($config[0]['lang']=='hu')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>Hungarian</option>';
    $this->_html .= '<option value="id"'; ($config[0]['lang']=='id')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>Indonesian</option>';
    $this->_html .= '<option value="it"'; ($config[0]['lang']=='it')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>Italian</option>';
    $this->_html .= '<option value="ja"'; ($config[0]['lang']=='ja')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>Japanese</option>';
    $this->_html .= '<option value="ko"'; ($config[0]['lang']=='ko')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>Korean</option>';
    $this->_html .= '<option value="lv"'; ($config[0]['lang']=='lv')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>Latvian</option>';
    $this->_html .= '<option value="lt"'; ($config[0]['lang']=='lt')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>Lithuanian</option>';
		$this->_html .= '<option value="ms"'; ($config[0]['lang']=='ms')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>Malay</option>';
		$this->_html .= '<option value="no"'; ($config[0]['lang']=='no')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>Norwegian</option>';
		$this->_html .= '<option value="fa"'; ($config[0]['lang']=='fa')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>Persian</option>';
		$this->_html .= '<option value="pl"'; ($config[0]['lang']=='pl')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>Polish</option>';
		$this->_html .= '<option value="pt-BR"'; ($config[0]['lang']=='pt-BR')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>Portuguese (Brazil)</option>';
		$this->_html .= '<option value="pt-PT"'; ($config[0]['lang']=='pt-PT')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>Portuguese (Portugal)</option>';
		$this->_html .= '<option value="ro"'; ($config[0]['lang']=='ro')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>Romanian</option>';
		$this->_html .= '<option value="ru"'; ($config[0]['lang']=='ru')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>Russian</option>';
		$this->_html .= '<option value="sr"'; ($config[0]['lang']=='sr')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>Serbian</option>';
		$this->_html .= '<option value="sv"'; ($config[0]['lang']=='sv')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>Swedish</option>';
		$this->_html .= '<option value="sk"'; ($config[0]['lang']=='sk')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>Slovak</option>';
		$this->_html .= '<option value="sl"'; ($config[0]['lang']=='sl')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>Slovenian</option>';
		$this->_html .= '<option value="es"'; ($config[0]['lang']=='es')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>Spanish</option>';
		$this->_html .= '<option value="es-419"'; ($config[0]['lang']=='es-419')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>Spanish (Latin America)</option>';
		$this->_html .= '<option value="th"'; ($config[0]['lang']=='th')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>Thai</option>';
		$this->_html .= '<option value="tr"'; ($config[0]['lang']=='tr')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>Turkish</option>';
		$this->_html .= '<option value="uk"'; ($config[0]['lang']=='uk')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>Ukrainian</option>';
		$this->_html .= '<option value="vi"'; ($config[0]['lang']=='vi')? $this->_html .= ' selected':$this->_html .= '';$this->_html .= '>Vietnamese</option>';
    $this->_html .= '</select> 
          </div> ';
    
		$this->_html .= '
					<div style="float:none;margin-top:30px;">
	          <div>
							<label for="plusone-include-count">'.$this->l('Include count:').'&nbsp;</label> 
            </div> 
            <div style="float:left; margin-top:5px;"> 
              <input ';
    if ($config[0]['total']==1) $this->_html .= 'checked="checked" ';
    $this->_html .= 'id="plusone-include-count" type="checkbox" name="plusone-include-count"> 
            </div> 
          </div> 
				</div>';
	}
	
	function getLicence()
	{
		$this->_html .= '
				<div style="margin: 30px 0 0 20px;">
					Module créer par '.$this->author.'<br />
					D\'autres modules sur <a href="http://'.$this->siteauthor.'" target="_news">'.$this->siteauthor.'</a>
				</div>';
	}
	
	function hookLeftColumn($params)
	{
		global $smarty;
		
		$config = $this->getConfig();
		$smarty->assign('type',$config[0]['type']);
		$smarty->assign('lang',$config[0]['lang']);
		$smarty->assign('total',$config[0]['total']);
		$smarty->assign('moduleinfo', $this->name.' - '.$this->version.' - author: '.$this->author);
		$smarty->assign('modulename', $this->name);
		return $this->display(__FILE__, 'domgoogleone.tpl');
	}
	function hookRightColumn($params)
	{
		return $this->hookLeftColumn($params);
	} 
	function hookFooter($params)
	{
		return $this->hookLeftColumn($params);
	}
	public function hookExtraLeft($params)
	{
		return $this->hookLeftColumn($params);
	}

	public function hookExtraRight($params)
	{
		return $this->hookLeftColumn($params);
	}	
	
}


