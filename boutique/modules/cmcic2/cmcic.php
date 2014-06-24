<?php

//if (!defined('_CAN_LOAD_FILES_'))
//	exit;

class CMCIC extends PaymentModule{
  private $_html = '';
  private $_postErrors = array();
  
  public function __construct(){
    $this->name = 'cmcic';
    $this->tab = 'payments_gateways';
    $this->version = '1.11';
    parent::__construct();
    $this->page = basename(__FILE__, '.php');
    $this->displayName = $this->l('Paiement sécurisé CMCIC');
    $this->description = $this->l('Secure payment for CM-CIC bank');
    $this->confirmUninstall = $this->l('Are you sure to delete this module ?');
	$this->author = 'creaweb06.fr';
  }

  public function install(){
    if (!parent::install()
		OR !Configuration::updateValue('CMCIC_ACTIVE', '1')
        OR !Configuration::updateValue('CMCIC_TPE', '0000001')
        OR !Configuration::updateValue('CMCIC_CLE', '12345678901234567890123456789012345678P0')
        OR !Configuration::updateValue('CMCIC_VERSION', '3.0')
        OR !Configuration::updateValue('CMCIC_SERVEUR', 'https://paiement.creditmutuel.fr/test/paiement.cgi')
        OR !Configuration::updateValue('CMCIC_CODESOCIETE', 'yours')
		OR !Configuration::updateValue('CMCICNF_ACTIVE', '0')
		OR !Configuration::updateValue('CMCICNF_TPE', '0000001')
        OR !Configuration::updateValue('CMCICNF_CLE', '12345678901234567890123456789012345678P0')
        OR !Configuration::updateValue('CMCICNF_VERSION', '3.0')
        OR !Configuration::updateValue('CMCICNF_SERVEUR', 'https://paiement.creditmutuel.fr/test/paiement.cgi')
        OR !Configuration::updateValue('CMCICNF_CODESOCIETE', 'yours')
		OR !Configuration::updateValue('CMCICNF_MONTANTMINI', '300.00')
		OR !Configuration::updateValue('CMCICNF_NBMENS', '3')
		OR !Configuration::updateValue('CMCICNF_MODECALCUL', '2')
		OR !$this->installDb()
        OR !Configuration::updateValue('CMCIC_URLCGI2', 'http://'.htmlspecialchars($_SERVER['HTTP_HOST'].__PS_BASE_URI__, ENT_COMPAT, 'UTF-8').'modules/cmcic/order.php')
		OR !$this->registerHook('orderConfirmation')
		OR !$this->registerHook('payment')){
			return false;
		}
    return true;
  }

  public function uninstall(){
    if (!Configuration::deleteByName('CMCIC_ACTIVE')
		OR !Configuration::deleteByName('CMCIC_TPE')
        OR !Configuration::deleteByName('CMCIC_CLE')
        OR !Configuration::deleteByName('CMCIC_VERSION')
        OR !Configuration::deleteByName('CMCIC_SERVEUR')
        OR !Configuration::deleteByName('CMCIC_CODESOCIETE')
		OR !Configuration::deleteByName('CMCICNF_ACTIVE')
		OR !Configuration::deleteByName('CMCICNF_TPE')
		OR !Configuration::deleteByName('CMCICNF_CLE')
		OR !Configuration::deleteByName('CMCICNF_VERSION')
		OR !Configuration::deleteByName('CMCICNF_SERVEUR')
		OR !Configuration::deleteByName('CMCICNF_CODESOCIETE')
		OR !Configuration::deleteByName('CMCICNF_MONTANTMINI')
		OR !Configuration::deleteByName('CMCICNF_NBMENS')
		OR !Configuration::deleteByName('CMCICNF_MODECALCUL')
        OR !Configuration::deleteByName('CMCIC_URLCGI2')
        OR !parent::uninstall())
        return false;
    return true;
  }
  
  public function installDb()
  {
		$sql1 = 'CREATE TABLE if not exists '._DB_PREFIX_.'cmcic_paiements (id_cart INT NOT NULL, reference VARCHAR(12) NOT NULL, date VARCHAR(19) NOT NULL, montant VARCHAR(15) NOT NULL, text_libre TEXT NOT NULL, code_retour VARCHAR(20) NOT NULL, cvx VARCHAR(3) NOT NULL, vld VARCHAR(10) NOT NULL, brand VARCHAR(2) NOT NULL, status3ds TINYINT NOT NULL, numauto INT NOT NULL, motifrefus VARCHAR(15) NOT NULL, originecb VARCHAR(10) NOT NULL, bincb VARCHAR(10) NOT NULL, hpancb VARCHAR(50) NOT NULL, ipclient VARCHAR(20) NOT NULL, originetr VARCHAR(10) NOT NULL, veres VARCHAR(200) NOT NULL, pares VARCHAR(200) NOT NULL, montantech INT(15) NOT NULL, INDEX (id_cart), PRIMARY KEY (reference))';
		return Db::GetInstance()->Execute($sql1);
  }
  
  public function getContent()
  {
    
	$this->_html .= '<h2>'.$this->l('CM-CIC Payment').'</h2>';
    	
	$this->displayEuroInformation();
	
	if (Tools::isSubmit('submitCmCic')){
	
		// Champs obligatoires paiement comptant //
		if(Tools::getValue('CMCIC_ACTIVE')=='1'){
			if (!Tools::getValue('CMCIC_TPE')){
				$this->_postErrors[] = $this->l('TPE number required for cash payment');
			} else {
				Configuration::updateValue('CMCIC_TPE', Tools::getValue('CMCIC_TPE'));
			}
			if (!Tools::getValue('CMCIC_CLE')){
				$this->_postErrors[] = $this->l('HMAC key required for cash payment');
			} else {
				Configuration::updateValue('CMCIC_CLE', Tools::getValue('CMCIC_CLE'));
			}
			if (!Tools::getValue('CMCIC_CODESOCIETE')){
				$this->_postErrors[] = $this->l('Company code required for cash payment');
			} else {
				Configuration::updateValue('CMCIC_CODESOCIETE', Tools::getValue('CMCIC_CODESOCIETE'));
			}
		} else {
			Configuration::updateValue('CMCIC_TPE', Tools::getValue('CMCIC_TPE'));
			Configuration::updateValue('CMCIC_CLE', Tools::getValue('CMCIC_CLE'));
			Configuration::updateValue('CMCIC_CODESOCIETE', Tools::getValue('CMCIC_CODESOCIETE'));
		}
		//////////////////////////////////////////////
	
		// Champs obligatoires paiements multiples //
		if(Tools::getValue('CMCICNF_ACTIVE')=='1'){
			if (!Tools::getValue('CMCICNF_TPE')){
				$this->_postErrors[] = $this->l('TPE number required for multiple payment');
			} else {
				Configuration::updateValue('CMCICNF_TPE', Tools::getValue('CMCICNF_TPE'));
			}
			if (!Tools::getValue('CMCICNF_CLE')){
				$this->_postErrors[] = $this->l('HMAC key required for multiple payment');
			} else {
				Configuration::updateValue('CMCICNF_CLE', Tools::getValue('CMCICNF_CLE'));
			}
			if (!Tools::getValue('CMCICNF_CODESOCIETE')){
				$this->_postErrors[] = $this->l('Company code required for multiple payment');
			} else {
				Configuration::updateValue('CMCICNF_CODESOCIETE', Tools::getValue('CMCICNF_CODESOCIETE'));
			}
		} else {
			Configuration::updateValue('CMCICNF_TPE', Tools::getValue('CMCICNF_TPE'));
			Configuration::updateValue('CMCICNF_CLE', Tools::getValue('CMCICNF_CLE'));
			Configuration::updateValue('CMCICNF_CODESOCIETE', Tools::getValue('CMCICNF_CODESOCIETE'));
		}
		/////////////////////////////////////////////

		// Enregistrements des autres valeurs //
		Configuration::updateValue('CMCIC_ACTIVE', Tools::getValue('CMCIC_ACTIVE'));
		Configuration::updateValue('CMCIC_SERVEUR', Tools::getValue('CMCIC_SERVEUR'));
		Configuration::updateValue('CMCICNF_ACTIVE', Tools::getValue('CMCICNF_ACTIVE'));
		Configuration::updateValue('CMCICNF_SERVEUR', Tools::getValue('CMCICNF_SERVEUR'));
		Configuration::updateValue('CMCICNF_MONTANTMINI', Tools::getValue('CMCICNF_MONTANTMINI'));
		Configuration::updateValue('CMCICNF_NBMENS', Tools::getValue('CMCICNF_NBMENS'));
		Configuration::updateValue('CMCICNF_MODECALCUL', Tools::getValue('CMCICNF_MODECALCUL'));
        
		if($this->_postErrors){
			$this->displayErrors();
		} else {
			$this->displayConf();
		}


	}
	
    $this->_displayForm();
    return $this->_html;
 }
  
  public function displayConf()
  {
    $this->_html .= '
    <div class="conf confirm">
      <img src="../img/admin/ok.gif" alt="Confirmation" />
      '.$this->l('Settings Saved').'
    </div>';
  }
  
  public function displayErrors()
  {
    $nbErrors = sizeof($this->_postErrors);
    $this->_html .= '
    <div class="alert error">
      <h3>'.($nbErrors > 1 ? $this->l('There are') : $this->l('There is')).' '.$nbErrors.' '.($nbErrors > 1 ? $this->l('errors') : $this->l('error')).'</h3>
      <ol>';
    foreach ($this->_postErrors AS $error)
      $this->_html .= '<li>'.$error.'</li>';
    $this->_html .= '
      </ol>
    </div>';
  }
  
  public function displayEuroInformation()
  {
    $this->_html .= '
    <img src="../modules/cmcic/img/euroinformation.gif" style="float:left; margin-right:15px;" />
    <b>'.$this->l('This module allow you to accept payment with CM-CIC.').'</b><br /><br />
    '.$this->l('Banks available : CIC, Cr&eacute;dit Mutuel, and OBC').'<br />
    '.$this->l('You must create first your ecommerce account with your bank. ').'<br />
	'.$this->l('Before installation, please read the help section').'<br /><br />
	'.$this->l('Only one website authorized by purchasing one license.').'<br />
	'.$this->l('To purchase additional licenses or other modules : ').'<a href="http://www.creaweb06.fr" target="_blank">www.Cre@Web06.fr</a><br />
	'.$this->l('Possible installation on your prestashop on request').'
    <br /><br /><br />';
  }

  public function _displayForm(){

	$conf = Configuration::getMultiple(array('CMCIC_ACTIVE', 'CMCIC_TPE', 'CMCIC_CLE', 'CMCIC_VERSION', 'CMCIC_SERVEUR', 'CMCIC_CODESOCIETE', 'CMCICNF_ACTIVE', 'CMCICNF_TPE', 'CMCICNF_CLE', 'CMCICNF_VERSION', 'CMCICNF_SERVEUR', 'CMCICNF_CODESOCIETE', 'CMCICNF_MONTANTMINI', 'CMCICNF_NBMENS', 'CMCICNF_MODECALCUL', 'CMCIC_URLCGI2'));

	$CMCIC_URLCGI2 = $conf['CMCIC_URLCGI2'];

	$urlcictest = 'https://ssl.paiement.cic-banques.fr/test/paiement.cgi';
    $urlcicprod = 'https://ssl.paiement.cic-banques.fr/paiement.cgi';
    $urlobctest = 'https://ssl.paiement.banque-obc.fr/test/paiement.cgi';
    $urlobcprod = 'https://ssl.paiement.banque-obc.fr/paiement.cgi';
    $urlcmtest  = 'https://paiement.creditmutuel.fr/test/paiement.cgi';
    $urlcmprod  = 'https://paiement.creditmutuel.fr/paiement.cgi';


	$this->_html .= '
	
	<style type="text/css">  
	<!-- 
	
		ul.tabs {
			margin: 0;
			padding: 0;
			float: left;
			list-style: none;
			height: 32px; 
			border-bottom: 1px solid #999;
			border-left: 1px solid #999;
			width: 100%;
		}
		ul.tabs li {
			float: left;
			margin: 0;
			padding: 0;
			width: 200px;
			height: 31px; 
			line-height: 31px; 
			border: 1px solid #999;
			border-left: none;
			margin-bottom: -1px; 
			overflow: hidden;
			position: relative;
			background: #e0e0e0;
		}
		ul.tabs li a {
			text-decoration: none;
			color: #000;
			display: block;
			font-size: 1.2em;
			text-align: center;
			outline: none;
		}
		ul.tabs li a:hover {
			background: #ccc;
		}
		html ul.tabs li.active, html ul.tabs li.active a:hover  {
			background: #fff;
			border-bottom: 1px solid #fff; 
		}
	
	--> 
	</style> 
	
	<script type="text/javascript">
	
			$(document).ready(function() {
			
			$(".tab_content").hide();
			$("ul.tabs li:first").addClass("active").show();
			$(".tab_content:first").show();

			$("ul.tabs li").click(function() {

				$("ul.tabs li").removeClass("active");
				$(this).addClass("active");
				$(".tab_content").hide();

				var activeTab = $(this).find("a").attr("href");
				$(activeTab).fadeIn();
				return false;
			});

		});
	
	</script>
	
	
	<fieldset>
		<legend><img src="../img/admin/contact.gif" />'.$this->l('Settings').'</legend>
		<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
		
		<ul class="tabs">
			<li>
				<a href="#TabConf_01">'.$this->l('Cash Payment').'</a>
			</li>
			<li>
				<a href="#TabConf_02">'.$this->l('Multiple Payment').'</a>
			</li>
			<li>
				<a href="#TabConf_03">'.$this->l('Help Setup').'</a>
			</li>
		</ul>
	
		
		
		
		<div style="border: 1px solid #999;border-top: none;overflow: hidden;clear: both;float: left; width: 100%;background: #fff;">

		<div id="TabConf_01" class="tab_content">
			<br /><br />
			  <label>'.$this->l('Enable cash payment :').'</label>
			  <div class="margin-form">
			  <input type="checkbox" name="CMCIC_ACTIVE" value="1" '.((Tools::getValue('CMCIC_ACTIVE') or $conf['CMCIC_ACTIVE']) ? 'checked' : '').' />
			  </div>
			  <br />
			  <label>'.$this->l('TPE number :').'</label>
			  <div class="margin-form">
			  <input type="text" name="CMCIC_TPE" size=10 maxlength=8 value="'.((!Tools::getValue('CMCIC_TPE')) ? $conf['CMCIC_TPE'] : Tools::getValue('CMCIC_TPE')).'" />
			  </div>
			  <br />
			  <label>'.$this->l('Company code :').'</label>
			  <div class="margin-form">
			  <input type="text" name="CMCIC_CODESOCIETE" size=55 maxlength=42 value="'.((!Tools::getValue('CMCIC_CODESOCIETE')) ? $conf['CMCIC_CODESOCIETE'] : Tools::getValue('CMCIC_CODESOCIETE')).'" />
			  </div>
			  <br />
			  <label>'.$this->l('HMAC Key control :').'</label>
			  <div class="margin-form">
			  <input type="text" name="CMCIC_CLE" size=55 maxlength=42 value="'.((!Tools::getValue('CMCIC_CLE')) ? $conf['CMCIC_CLE'] : Tools::getValue('CMCIC_CLE')).'" />
			  </div>
			  <br />
			  <label>'.$this->l('Your Bank :').'</label>
			  <div class="margin-form">
			  <input type="radio" name="CMCIC_SERVEUR" value="'.htmlentities($urlcicprod).'" '.((Tools::getValue('CMCIC_SERVEUR')==htmlentities($urlcicprod) or $conf['CMCIC_SERVEUR']==htmlentities($urlcicprod)) ? ' checked' : '' ).'/> CIC Production&nbsp;
			  <input type="radio" name="CMCIC_SERVEUR" value="'.htmlentities($urlcictest).'" '.((Tools::getValue('CMCIC_SERVEUR')==htmlentities($urlcictest) or $conf['CMCIC_SERVEUR']==htmlentities($urlcictest)) ? ' checked' : '' ).'/> CIC Test
			  </div>
			  <div class="margin-form">
			  <input type="radio" name="CMCIC_SERVEUR" value="'.htmlentities($urlcmprod).'" '.((Tools::getValue('CMCIC_SERVEUR')==htmlentities($urlcmprod) or $conf['CMCIC_SERVEUR']==htmlentities($urlcmprod)) ? ' checked' : '' ).'/> Cr&eacute;dit Mutuel Production&nbsp;
			  <input type="radio" name="CMCIC_SERVEUR" value="'.htmlentities($urlcmtest).'" '.((Tools::getValue('CMCIC_SERVEUR')==htmlentities($urlcmtest) or $conf['CMCIC_SERVEUR']==htmlentities($urlcmtest)) ? ' checked' : '' ).'/> Cr&eacute;dit Mutuel Test
			  </div>
			  <div class="margin-form">
			  <input type="radio" name="CMCIC_SERVEUR" value="'.htmlentities($urlobcprod).'" '.((Tools::getValue('CMCIC_SERVEUR')==htmlentities($urlobcprod) or $conf['CMCIC_SERVEUR']==htmlentities($urlobcprod)) ? ' checked' : '' ).'/> OBC Production&nbsp;
			  <input type="radio" name="CMCIC_SERVEUR" value="'.htmlentities($urlobctest).'" '.((Tools::getValue('CMCIC_SERVEUR')==htmlentities($urlobctest) or $conf['CMCIC_SERVEUR']==htmlentities($urlobctest)) ? ' checked' : '' ).'/> OBC Test
			  </div>
			  <br />
		</div>

		<div id="TabConf_02" class="tab_content">
			<br /><br />
			  <label>'.$this->l('Enable multiple payment :').'</label>
			  <div class="margin-form">
			  <input type="checkbox" name="CMCICNF_ACTIVE" value="1" '.((Tools::getValue('CMCICNF_ACTIVE') or $conf['CMCICNF_ACTIVE']) ? 'checked' : '').' />
			  </div>
			  <br />
			  <label>'.$this->l('TPE number :').'</label>
			  <div class="margin-form">
			  <input type="text" name="CMCICNF_TPE" size=10 maxlength=8 value="'.((!Tools::getValue('CMCICNF_TPE')) ? $conf['CMCICNF_TPE'] : Tools::getValue('CMCICNF_TPE') ).'" />
			  </div>
			  <br />
			  <label>'.$this->l('Company code :').'</label>
			  <div class="margin-form">
			  <input type="text" name="CMCICNF_CODESOCIETE" size=55 maxlength=42 value="'.((!Tools::getValue('CMCICNF_CODESOCIETE')) ? $conf['CMCICNF_CODESOCIETE'] : Tools::getValue('CMCICNF_CODESOCIETE') ).'" />
			  </div>
			  <br />
			  <label>'.$this->l('HMAC Key control :').'</label>
			  <div class="margin-form">
			  <input type="text" name="CMCICNF_CLE" size=55 maxlength=42 value="'.((!Tools::getValue('CMCICNF_CLE')) ? $conf['CMCICNF_CLE'] : Tools::getValue('CMCICNF_CLE') ).'" />
			  </div>
			  <br />
			  <label>'.$this->l('Minimum purchase :').'</label>
			  <div class="margin-form">
			  <input type="text" name="CMCICNF_MONTANTMINI" size=10 maxlength=42 value="'.((!Tools::getValue('CMCICNF_MONTANTMINI')) ? $conf['CMCICNF_MONTANTMINI'] : Tools::getValue('CMCICNF_MONTANTMINI') ).'" />
			  <span>'.$this->l('Is the total (VAT include) payable by the customer.').'</span>
			  </div>
			  <br />
			  <label>'.$this->l('Number of monthly :').'</label>
			  <div class="margin-form">
			  <input type="text" name="CMCICNF_NBMENS" size=10 maxlength=1 value="'.((!Tools::getValue('CMCICNF_NBMENS')) ? $conf['CMCICNF_NBMENS'] : Tools::getValue('CMCICNF_NBMENS') ).'" />
			  </div>
			  <br />
			  <label>'.$this->l('Method of calculation :').'</label>
			  <div class="margin-form">
			  <select name="CMCICNF_MODECALCUL">
				<option value="1" '.((Tools::getValue('CMCICNF_MODECALCUL')=='1' or $conf['CMCICNF_MODECALCUL']=='1') ? 'selected' : '' ).'>Mode 1</option>
				<option value="2" '.((Tools::getValue('CMCICNF_MODECALCUL')=='2' or $conf['CMCICNF_MODECALCUL']=='2') ? 'selected' : '' ).'>Mode 2</option>
			  </select>
			  </div>
			  <br />
			  <label>'.$this->l('Your Bank :').'</label>
			  <div class="margin-form">
			  <input type="radio" name="CMCICNF_SERVEUR" value="'.htmlentities($urlcicprod).'" '.((Tools::getValue('CMCICNF_SERVEUR')==htmlentities($urlcicprod) or $conf['CMCICNF_SERVEUR']==htmlentities($urlcicprod)) ? ' checked' : '' ).'/> CIC Production&nbsp;
			  <input type="radio" name="CMCICNF_SERVEUR" value="'.htmlentities($urlcictest).'" '.((Tools::getValue('CMCICNF_SERVEUR')==htmlentities($urlcictest) or $conf['CMCICNF_SERVEUR']==htmlentities($urlcictest)) ? ' checked' : '' ).'/> CIC Test
			  </div>
			  <div class="margin-form">
			  <input type="radio" name="CMCICNF_SERVEUR" value="'.htmlentities($urlcmprod).'" '.((Tools::getValue('CMCICNF_SERVEUR')==htmlentities($urlcmprod) or $conf['CMCICNF_SERVEUR']==htmlentities($urlcmprod)) ? ' checked' : '' ).'/> Cr&eacute;dit Mutuel Production&nbsp;
			  <input type="radio" name="CMCICNF_SERVEUR" value="'.htmlentities($urlcmtest).'" '.((Tools::getValue('CMCICNF_SERVEUR')==htmlentities($urlcmtest) or $conf['CMCICNF_SERVEUR']==htmlentities($urlcmtest)) ? ' checked' : '' ).'/> Cr&eacute;dit Mutuel Test
			  </div>
			  <div class="margin-form">
			  <input type="radio" name="CMCICNF_SERVEUR" value="'.htmlentities($urlobcprod).'" '.((Tools::getValue('CMCICNF_SERVEUR')==htmlentities($urlobcprod) or $conf['CMCICNF_SERVEUR']==htmlentities($urlobcprod)) ? ' checked' : '' ).'/> OBC Production&nbsp;
			  <input type="radio" name="CMCICNF_SERVEUR" value="'.htmlentities($urlobctest).'" '.((Tools::getValue('CMCICNF_SERVEUR')==htmlentities($urlobctest) or $conf['CMCICNF_SERVEUR']==htmlentities($urlobctest)) ? ' checked' : '' ).'/> OBC Test
			  </div>
			  <br />
		</div>

		<div id="TabConf_03" class="tab_content">
			<br /><br />
			
			<b><u>'.$this->l('Configuration steps (cash payment) :').'</u></b><br /><br />
			'.$this->l('1. Take your key file for cash payment with the technical support of CM-CIC').'<br />
			'.$this->l('2. Active cash payment in the module').'<br />
			'.$this->l('3. Enter your TPE number, and your company code given to you by CM-CIC support').'<br />
			'.$this->l('4. For your hmac key, take key version 3.0 with the script send you by CM-CIC support').'<br />
			'.$this->l('5. Edit your key with notepad or equivalent').'<br />
			'.$this->l('6. The hmac key is the "XXX...", example :').'<br />VERSION 1 XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXHMAC-SHA1#AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA<br />
			'.$this->l('7. Select your bank in test mode').'<br />
			'.$this->l('8. Send the CGI2 url at the CM-CIC technical support (See below)').'<br />
			'.$this->l('9. Once all set up, place an order from your shop, in test mode a clickable logo will let you perform a test dummy with a CB.').'<br />
			'.$this->l('10. If everything works correctly, select your bank in production mode').'<br />
			'.$this->l('11. It\'s finished ;)').'<br />
			<br /><br />
			
			<b><u>'.$this->l('Configuration steps (multiple payment) :').'</u></b><br /><br />
			'.$this->l('1. Take your key file for multiple payment with the technical support of CM-CIC').'<br />
			'.$this->l('2. Active multiple payment in the module').'<br />
			'.$this->l('3. Enter your TPE number, and your company code given to you by CM-CIC support for the multiple payment').'<br />
			'.$this->l('4. For your hmac key, take key version 3.0 with the script send you by CM-CIC support').'<br />
			'.$this->l('5. Edit your key with notepad or equivalent').'<br />
			'.$this->l('6. The hmac key is the "XXX...", example :').'<br />VERSION 1 XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXHMAC-SHA1#AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA<br />
			'.$this->l('7. Set the number of payments with 2, 3 or 4 monthly').'<br />
			'.$this->l('8. Set the minimum order (all included)').'<br />
			'.$this->l('9. Set the mode, mode 1 (monthly identical) or mode 2 (first monthly rounded up)').'<br />
			'.$this->l('10. Select your bank in test mode').'<br />
			'.$this->l('11. Send the CGI2 url at the CM-CIC technical support (See below)').'<br />
			'.$this->l('12. Once all set up, place an order from your shop, in test mode a clickable logo will let you perform a test dummy with a CB.').'<br />
			'.$this->l('13. If everything works correctly, select your bank in production mode').'<br />
			'.$this->l('14. It\'s finished ;)').'<br />
			
			
			<br /><br /><br />
			
			  <label>'.$this->l('Bank return (CGI2) :').'</label>
			  <div class="margin-form">
			  '.$CMCIC_URLCGI2.'
			  </div>
			<br />
		</div>
		
		</div>
		<br /><br /><br />
		<center><input type="submit" name="submitCmCic" value="'.$this->l('Save').'" class="button" /></center>
	</fieldset>
	</form>';

  }
  
  	public function hookOrderConfirmation($params)
	{
		global $smarty, $cookie;		
		
		if ($params['objOrder']->module != $this->name)
			return;

		if ($params['objOrder']->valid)
			$smarty->assign(array('status' => 'ok', 'id_order' => $params['objOrder']->id));
		else
			$smarty->assign('status', 'failed');

		return $this->display(__FILE__, 'confirmation.tpl');
	
	}


  public function hookPayment($params){

	global $smarty, $cookie, $cart;
    

	// Préparation des valeurs des variables
	$address 		= new Address((int)$cart->id_address_invoice);
    $customer 		= new Customer((int)$cart->id_customer);
    $id_currency 	= (int)$cart->id_currency;
    $currency 		= new Currency((int)$id_currency);
	
	$cmcic_active	= (bool)Configuration::get('CMCIC_ACTIVE');
	$cmcicnf_active = (bool)Configuration::get('CMCICNF_ACTIVE');

	// Préparation du paiement comptant si activé
	if( $cmcic_active )
	{
		$MyTpe["tpe"]          = Configuration::get('CMCIC_TPE');
		$MyTpe["codesociete"]  = Configuration::get('CMCIC_CODESOCIETE');
		$MyTpe["cle"]          = Configuration::get('CMCIC_CLE');
		$MyTpe["serveur"]      = Configuration::get('CMCIC_SERVEUR');
		
		$sCodeSociete = $MyTpe["codesociete"];
		$sUrlpaiement = $MyTpe["serveur"];
	}
	
	// Préparation du paiement nFois si activé
	if( $cmcicnf_active )
	{
		$MyTpe["tpenf"]		   	= Configuration::get('CMCICNF_TPE');
		$MyTpe["codesocietenf"] = Configuration::get('CMCICNF_CODESOCIETE');
		$MyTpe["clenf"]         = Configuration::get('CMCICNF_CLE');
		$MyTpe["serveurnf"]	   = Configuration::get('CMCICNF_SERVEUR');
		
		$sCodeSocietenf = $MyTpe["codesocietenf"];
		$sUrlpaiementnf = $MyTpe["serveurnf"];
		
		$nbmens		= Configuration::get('CMCICNF_NBMENS');
		$modecalcul = Configuration::get('CMCICNF_MODECALCUL');
	}
	
	
	// Paramètres généraux si au moins un type de paiement actif
	if( $cmcic_active or $cmcicnf_active )
	{
		$MyTpe["retourbanque"] = Configuration::get('CMCIC_URLCGI2');
		$MyTpe["retourok"]     = htmlspecialchars('http://'.$_SERVER['HTTP_HOST'].__PS_BASE_URI__.'order-confirmation.php?id_cart='.$cart->id.'&id_module='.$this->id.'&key=', ENT_COMPAT, 'UTF-8').$customer->secure_key;
		$MyTpe["retournok"]    = htmlspecialchars('http://'.$_SERVER['HTTP_HOST'].__PS_BASE_URI__.'order.php', ENT_COMPAT, 'UTF-8');
		$MyTpe["reference"]    = $cart->id.date("is");
		$MyTpe["devise"]       = strtoupper($currency->iso_code);
		$MyTpe["commentaire"]  = "Commande - Panier #".$cart->id;
		$MyTpe["langue"]       = strtoupper(Language::getIsoById(intval($cookie->id_lang)));
		$MyTpe["version"]	   = Configuration::get('CMCIC_VERSION');	
		$MyTpe["montant"]      = number_format(Tools::convertPrice($params['cart']->getOrderTotal(true, 3), $currency), 2, '.', '');
		$MyTpe["submit"]	   = $this->l('Paiement sécurisé par carte bancaire');
		$MyTpe["date"]		   = date("d/m/Y:H:i:s");
		$MyTpe["email"]		   = $customer->email;
		
		$sVersion		= $MyTpe["version"];
		$sLangue		= $MyTpe["langue"];
		$sUrlOK			= $MyTpe["retourok"];
		$sUrlKO			= $MyTpe["retournok"];
		$montant		= $MyTpe["montant"];
    }

	
    // Fichiers de fonctions de cryptage Euro Information 1.04
    require_once(_PS_MODULE_DIR_."cmcic/CMCIC_Config.php");
	require_once(_PS_MODULE_DIR_."cmcic/CMCIC_Tpe.inc.php");
    
    $oTpe 		= new CMCIC_Tpe($sLangue);
    $oHmac		= new CMCIC_Hmac($oTpe);
	$oTpenf 	= new CMCIC_Tpe_nf($sLangue);
	$oHmacnf 	= new CMCIC_Hmac($oTpenf);


	// Fonction pour ajouter 1 mois à la date avec gestion de l'arrondi des jours
	function giveDatePlusMonth($nb)
	{
		$date_next = array();
		$actual_month = (int)date("m");
		// Si c'est le mois de décembre, on remet à 0 pour le calcul
		if( $actual_month == 12 )
			$actuel_month = 0;
		// Calcul de la date et vérification que le mois correspond avec le mois voulu
		$date_next['day'] 	= (int)date("d");
		$date_next['month']	= $actual_month + $nb;
		$date_next['year']	= (int)date("Y");
		// Si le mois calculé est supérieur à 12, on corrige
		if( $date_next['month'] > 12 )
			$date_next['month'] = $date_next['month'] - 12;
		// Vérification que la date existe
		if( checkdate($date_next['month'],$date_next['day'],$date_next['year']) == false )
			while( checkdate($date_next['month'],$date_next['day'],$date_next['year']) == false )
			{
				$date_next['day']--;
			}
		// On retourne la date au bon format
		return $date_next['day'].'/'.$date_next['month'].'/'.$date_next['year'];
	}

	
	// Préparation des montants des échéances si le paiement nFois est activé
	if( $cmcicnf_active )
	{
		switch ($nbmens){
			case '2':
				// Paiement en 2 fois
				$date1 = date("d/m/Y");
				$date2 = giveDatePlusMonth(1);
				if($modecalcul=='1'){
					$mensualite1 = round(($montant/2),2);
					$mensualite2 = round(($montant-$mensualite1),2);
				} else if($modecalcul=='2'){
					$mensualite2 = round(($montant/2),0);
					$mensualite1 = ($montant-$mensualite2);
				}
				break;
			
			case '3':
				// Paiement en 3 fois
				$date1 = date("d/m/Y");
				$date2 = giveDatePlusMonth(1);
				$date3 = giveDatePlusMonth(2);
				if($modecalcul=='1'){
					$mensualite1 = round(($montant/3),2);
					$mensualite2 = round(($montant/3),2);
					$mensualite3 = ($montant - $mensualite1 - $mensualite2);
				} else if($modecalcul=='2'){
					$mensualite3 = round(($montant/3),0);
					$mensualite2 = round(($montant/3),0);
					$mensualite1 = ($montant-$mensualite2-$mensualite3);
				}
				break;
				
			case '4':
				// Paiement en 4 fois
				$date1 = date("d/m/Y");
				$date2 = giveDatePlusMonth(1);
				$date3 = giveDatePlusMonth(2);
				$date4 = giveDatePlusMonth(3);
				if($modecalcul=='1'){
					$mensualite1 = round(($montant/4),2);
					$mensualite2 = round(($montant/4),2);
					$mensualite3 = round(($montant/4),2);
					$mensualite4 = ($montant - $mensualite1 - $mensualite2 - $mensualite3);
				} else if($modecalcul=='2'){
					$mensualite4 = round(($montant/4),0);
					$mensualite3 = round(($montant/4),0);
					$mensualite2 = round(($montant/4),0);
					$mensualite1 = ($montant-$mensualite2-$mensualite3-$mensualite4);
				}
				break;
				
			default:
				// Idem paiement 3 fois par défaut
				$date1 = date("d/m/Y");
				$date2 = giveDatePlusMonth(1);
				$date3 = giveDatePlusMonth(2);
				if($modecalcul=='1'){
					$mensualite1 = round(($montant/3),2);
					$mensualite2 = round(($montant/3),2);
					$mensualite3 = ($montant - $mensualite1 - $mensualite2);
				} else if($modecalcul=='2'){
					$mensualite3 = round(($montant/3),0);
					$mensualite2 = round(($montant/3),0);
					$mensualite1 = ($montant-$mensualite2-$mensualite3);
				}
				break;
		}
	
		$mensualite1 = number_format(Tools::convertPrice($mensualite1, $currency), 2, '.', '');
		$mensualite2 = number_format(Tools::convertPrice($mensualite2, $currency), 2, '.', '');
		if(isset($mensualite3))
			$mensualite3 = number_format(Tools::convertPrice($mensualite3, $currency), 2, '.', '');
		if(isset($mensualite4))
			$mensualite4 = number_format(Tools::convertPrice($mensualite4, $currency), 2, '.', '');
			
		// Création des variables qui n'existeraient pas
		if( !isset($date3) )
			$date3 = '';
		if( !isset($date4) )
			$date4 = '';
		if( !isset($mensualite3) )
			$mensualite3 = '';
		if( !isset($mensualite4) )
			$mensualite4 = '';
			
		// Clé de contrôle paiement nFois
		$Hmac1_nf = $oHmacnf->computeHmac(sprintf(CMCIC_CTLHMACSTR,$MyTpe["version"],$MyTpe["tpenf"]));    
		$CtlHmac_nf = sprintf(CMCIC_CTLHMAC,$MyTpe["version"],$MyTpe["tpenf"],$Hmac1_nf);    
		$PHP1_FIELDS_nf = sprintf(CMCIC_CGI1_FIELDS,   $oTpenf->sNumero,$MyTpe["date"],$MyTpe["montant"],$MyTpe["devise"],$MyTpe["reference"],
													$MyTpe["commentaire"],$sVersion,$sLangue,$sCodeSocietenf,
													$MyTpe["email"],intval($nbmens),$date1,$mensualite1.$MyTpe["devise"],$date2,$mensualite2.$MyTpe["devise"],$date3,(($mensualite3) ? $mensualite3.$MyTpe["devise"] : '' ),$date4,(($mensualite4) ? $mensualite4.$MyTpe["devise"] : '' ),"");    											
		$sMac_nf = $oHmacnf->computeHmac($PHP1_FIELDS_nf);
		///////////////////////////////////////

	}
	

	if( $cmcic_active )
	{
		// Clé de contrôle paiement comptant
		$Hmac1 = $oHmac->computeHmac(sprintf(CMCIC_CTLHMACSTR,$MyTpe["version"],$MyTpe["tpe"]));
		$CtlHmac = sprintf(CMCIC_CTLHMAC,$MyTpe["version"],$MyTpe["tpe"],$Hmac1);
		$PHP1_FIELDS = sprintf(CMCIC_CGI1_FIELDS,   $oTpe->sNumero,$MyTpe["date"],$MyTpe["montant"],$MyTpe["devise"],$MyTpe["reference"],
													$MyTpe["commentaire"],$sVersion,$sLangue,$sCodeSociete,
													$MyTpe["email"],"","","","","","","","","","");    											
		$sMac = $oHmac->computeHmac($PHP1_FIELDS);
		///////////////////////////////////////
	}
	
	
	if( $cmcic_active or $cmcicnf_active )
	{
		if(substr_count($MyTpe["serveur"],"cic")>0){
			$smarty->assign('Bank', "logo-cic-moy.jpg");
		} elseif(substr_count($MyTpe["serveur"],"creditmutuel")>0){
			$smarty->assign('Bank', "logo-cm-moy.jpg");
		} elseif(substr_count($MyTpe["serveur"],"obc")>0){
			$smarty->assign('Bank', "obc.gif");
		}
	}


	// Variables générales si un type de paiement actif
	if( $cmcic_active or $cmcicnf_active )
	{
		$smarty->assign('version',$sVersion);
		$smarty->assign('date',$MyTpe["date"]);
		$smarty->assign('devise',$MyTpe["devise"]);
		$smarty->assign('montant',$MyTpe["montant"]);
		$smarty->assign('reference',$MyTpe["reference"]);
		$smarty->assign('urlRetourNOK',$MyTpe["retournok"]);
		$smarty->assign('urlRetourOK',$MyTpe["retourok"]);
		$smarty->assign('langue',$MyTpe["langue"]);
		$smarty->assign('commentaire',HtmlEncode($MyTpe["commentaire"]));
		$smarty->assign('mail',$MyTpe["email"]);
	}
	// Paiement comptant si activé
	if( $cmcic_active )
	{
		$smarty->assign('activecomptant',Configuration::get('CMCIC_ACTIVE'));
		$smarty->assign('Serveur',$sUrlpaiement);
		$smarty->assign('tpe',$oTpe->sNumero);
		$smarty->assign('codesociete',$MyTpe["codesociete"]);
		$smarty->assign('Hmac',$sMac);
		$smarty->assign('texte_paiement',$this->l('Paiement sécurisé par carte bancaire'));
	}
	// Paiement multiple si activé
	if( $cmcicnf_active )
	{
		$smarty->assign('activenfois',Configuration::get('CMCICNF_ACTIVE'));
		$smarty->assign('montantmini',Configuration::get('CMCICNF_MONTANTMINI'));
		$smarty->assign('Serveur_nf',$sUrlpaiementnf);
		$smarty->assign('tpenf',$oTpenf->sNumero);
		$smarty->assign('codesocietenf',$MyTpe["codesocietenf"]);
		$smarty->assign('nbmens',$nbmens);
		$smarty->assign('date1',$date1);
		$smarty->assign('date2',$date2);
		// si date3 existe
		if( isset($date3) )
			$smarty->assign('date3',$date3);
		// si date4 existe
		if( isset($date4) )
			$smarty->assign('date4',$date4);
		$smarty->assign('mensualite1',$mensualite1);
		$smarty->assign('mensualite2',$mensualite2);
		// si mensualite3 existe
		if( isset($mensualite3) )
			$smarty->assign('mensualite3',$mensualite3);
		// si mensualite4 existe
		if( isset($mensualite4) )
			$smarty->assign('mensualite4',$mensualite4);
		$smarty->assign('Hmac_nf',$sMac_nf);
		$smarty->assign('texte_paiement_nf',$this->l('Paiement en ').$nbmens.$this->l('X sans frais par CB'));
	}


    return $this->display(__FILE__, 'cmcic.tpl');
    
	}

}

?>
