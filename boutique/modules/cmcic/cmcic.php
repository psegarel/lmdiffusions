<?php

//Class fournie par CM-CIC V3.0h
@include_once('classes/CMCIC_Tpe.inc.php');

class Cmcic extends PaymentModule
{
	private	$_html = '';
	private $_postErrors = array();

	public function __construct()
	{
		$this->name = 'cmcic';
		$this->tab = 'Payment';
		$this->version = '1.3';
		
		$this->currencies = true;
		$this->currencies_mode = 'radio';

        parent::__construct();

		$this->page = basename(__FILE__, '.php');
                $this->displayName = 'CM-CIC';
                 $this->description = $this->l('Accepts payments by CM-CIC');
		$this->confirmUninstall = $this->l('Are you sure you want to delete your details ?');
	}

	public function getCmcicUrl()
	{
			return Configuration::get('CMCIC_SERVER');
	}

	public function install()
	{
		if (!parent::install()
			OR !Configuration::updateValue('CMCIC_TPE','0000001')
			OR !Configuration::updateValue('CMCIC_CLE', '12345678901234567890123456789012345678P0')
                        OR !Configuration::updateValue('CMCIC_VERSION', '3.0')
                        OR !Configuration::updateValue('CMCIC_CODESOCIETE','yours')
			OR !Configuration::updateValue('CMCIC_URLOK', 'http://www.google.fr')
                        OR !Configuration::updateValue('CMCIC_URLKO', 'http://www.google.nz')
                        OR !Configuration::updateValue('CMCIC_NETWORK', '145.226.0.0')
			OR !$this->registerHook('payment')
			OR !$this->registerHook('paymentReturn'))
			return false;
		return true;
	}

	public function uninstall()
	{
		if (!Configuration::deleteByName('CMCIC_SERVER')
			OR !Configuration::deleteByName('CMCIC_TPE')
                        OR !Configuration::deleteByName('CMCIC_CLE')
                        OR !Configuration::deleteByName('CMCIC_VERSION')
                        OR !Configuration::deleteByName('CMCIC_CODESOCIETE')
                        OR !Configuration::deleteByName('CMCIC_URLOK')
                        OR !Configuration::deleteByName('CMCIC_URLKO')
                        OR !Configuration::deleteByName('CMCIC_NETWORK')
			OR !parent::uninstall())
			return false;
		return true;
	}

	public function getContent()
	{
		$this->_html = '<h2>CM-CIC</h2>';
		if (isset($_POST['submitCmcic']))
		{
			if (empty($_POST['company_code']))
				$this->_postErrors[] = $this->l('Company code is required.');
			if (!isset($_POST['tpe_number']))
				$this->_postErrors[] = $this->l('TPE number is required.');
                        if (!isset($_POST['key']))
				$this->_postErrors[] = $this->l('Security key is required.');
                        if (!isset($_POST['bank_server']))
				$this->_postErrors[] = $this->l('Bank server is required.');
                        elseif (!Validate::isUrl($_POST['bank_server']))
				$this->_postErrors[] = $this->l('Bank server URL is not valid.');
			if (!sizeof($this->_postErrors))
			{
				Configuration::updateValue('CMCIC_TPE', $_POST['tpe_number']);
                                Configuration::updateValue('CMCIC_CLE', strval($_POST['key']));
                                Configuration::updateValue('CMCIC_CODESOCIETE', strval($_POST['company_code']));
                                Configuration::updateValue('CMCIC_URLOK', '');
                                Configuration::updateValue('CMCIC_URLKO', '');
                                Configuration::updateValue('CMCIC_SERVER', $_POST['bank_server']);
                                
				$this->displayConf();
			}
			else
				$this->displayErrors();
		}

		$this->displayCmcic();
		$this->displayFormSettings();
		return $this->_html;
	}

	public function displayConf()
	{
		$this->_html .= '
		<div class="conf confirm">
			<img src="../img/admin/ok.gif" alt="'.$this->l('Confirmation').'" />
			'.$this->l('Settings updated').'
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
	
	
	public function displayCmcic()
	{
		$this->_html .= '
		<img src="../modules/cmcic/images/logocmcicpaiement.gif" style="float:left; margin-right:15px;margin-bottom:55px;" />
		<b>'.$this->l('This module allows you to accept payments by CM-CIC.').'</b><br /><br />
		'.$this->l('If the client chooses this payment mode, your CM-CIC account will be automatically credited.').'<br />
		'.$this->l('You need to have informations from your CM-CIC account first before using this module.').'<br /><br />
               	<div style="clear:both;">&nbsp;</div>';
	}

	public function displayFormSettings()
	{
                $conf = Configuration::getMultiple(array('CMCIC_CLE', 'CMCIC_TPE','CMCIC_CODESOCIETE', 'CMCIC_URLOK', 'CMCIC_URLKO','CMCIC_VERSION', 'CMCIC_SERVER'));
                
		$company_code = array_key_exists('company_code', $_POST) ? $_POST['company_code'] : (array_key_exists('CMCIC_CODESOCIETE', $conf) ? $conf['CMCIC_CODESOCIETE'] : '');
                $tpe_number = array_key_exists('tpe_number', $_POST) ? $_POST['tpe_number'] : (array_key_exists('CMCIC_TPE', $conf) ? $conf['CMCIC_TPE'] : '');
                $key = array_key_exists('key', $_POST) ? $_POST['key'] : (array_key_exists('CMCIC_CLE', $conf) ? $conf['CMCIC_CLE'] : '');
                $bank_server = array_key_exists('bank_server', $_POST) ? $_POST['bank_server'] : (array_key_exists('CMCIC_SERVER', $conf) ? $conf['CMCIC_SERVER'] : '');
               
                //Traitement pour "checker" le serveur enregistré
                $poscic  = strpos($bank_server,'cic'); $poscm   = strpos($bank_server,'creditmutuel');

		if($poscic!==false){
			if(strpos($bank_server,'test'))
				$check_cictest 	= ' checked';
			else
				$check_cicprod 	= ' checked';
		}elseif($poscm!==false){
			if(strpos($bank_server,'test'))
				$check_cmtest 	= ' checked';
			else
				$check_cmprod 	= ' checked';
		}


                //Definitions des variables pour accès par la classe de CM-CIC
                define('CMCIC_CLE',$key);define('CMCIC_TPE',$tpe_number);define('CMCIC_CODESOCIETE',$company_code);define('CMCIC_VERSION',$conf['CMCIC_VERSION']);

                //Control String
                $oTpe = new CMCIC_Tpe('FR');
                $oHmac = new CMCIC_Hmac($oTpe);

                //Control String for support
                $CtlHmac = sprintf(CMCIC_CTLHMAC, $oTpe->sVersion, $oTpe->sNumero, $oHmac->computeHmac(sprintf(CMCIC_CTLHMACSTR, $oTpe->sVersion, $oTpe->sNumero)));
		
		$this->_html .= '
		<form action="'.$_SERVER['REQUEST_URI'].'" method="post" style="clear: both;">
		<fieldset>
			<legend><img src="../img/admin/contact.gif" />'.$this->l('Settings').'</legend>
			<label>'.$this->l('Company code').'</label>
			<div class="margin-form"><input type="text" size="15" name="company_code" value="'.htmlentities($company_code, ENT_COMPAT, 'UTF-8').'" />
			<p class="hint clear" style="display: block; width: 501px;">'.$this->l('This code is provider by your bank').'</p></div><br /><br /><br />
                        <label>'.$this->l('Tpe number').'</label>
			<div class="margin-form"><input type="text" size="7" name="tpe_number" value="'.htmlentities($tpe_number, ENT_COMPAT, 'UTF-8').'" />
			<p class="hint clear" style="display: block; width: 501px;">'.$this->l('This number is provider by your bank').'</p></div><br /><br /><br />
                        <label>'.$this->l('Security Key').'</label>
			<div class="margin-form"><input type="text" size="60" name="key" value="'.htmlentities($key, ENT_COMPAT, 'UTF-8').'" />
			<p class="hint clear" style="display: block; width: 501px;">'.$this->l('This security key is provider by your bank').'</p></div><br /><br /><br /><br /><br /><br />
                        <label>'.$this->l('Bank Server').'</label>
			 <div class="margin-form">
                        <input type="radio" name="bank_server" value="https&#x3a;&#x2f;&#x2f;ssl.paiement.cic-banques.fr&#x2f;paiement.cgi" '.$check_cicprod.'/> CIC Production&nbsp;
                        <input type="radio" name="bank_server" value="https&#x3a;&#x2f;&#x2f;ssl.paiement.cic-banques.fr&#x2f;test&#x2f;paiement.cgi" '.$check_cictest.'/> CIC Test
                        </div>
                        <div class="margin-form">
                        <input type="radio" name="bank_server" value="https&#x3a;&#x2f;&#x2f;paiement.creditmutuel.fr&#x2f;paiement.cgi" '.$check_cmprod.'/> Cr&eacute;dit Mutuel Production&nbsp;
                        <input type="radio" name="bank_server" value="https&#x3a;&#x2f;&#x2f;paiement.creditmutuel.fr&#x2f;test&#x2f;paiement.cgi" '.$check_cmtest.'/> Cr&eacute;dit Mutuel Test
                        </div>
                        <br />
			<br /><center><input type="submit" name="submitCmcic" value="'.$this->l('Update settings').'" class="button" /></center>
		</fieldset>
		</form><br /><br />
		<fieldset class="width3">
			<legend><img src="../img/admin/warning.gif" />'.$this->l('Information').'</legend>
                        <b>'.$this->l('Control String').'</b>
			<div class="margin-form"><p class="hint clear" style="display: block; width: 501px;">'. $CtlHmac.'</p></div><br /><br /><br />
                         <b>'.$this->l('Return URL').'</b>
			<div class="margin-form"><p class="hint clear" style="display: block; width: 501px;">http&#x3a;&#x2f;&#x2f;'.htmlspecialchars($_SERVER['HTTP_HOST'].__PS_BASE_URI__, ENT_COMPAT, 'UTF-8').'modules&#x2f;cmcic&#x2f;validation.php</p></div><br /><br /><br />
		</fieldset>
                <br /><br />
                <div class="path_bar"><img src="../img/t/AdminModules.gif" />&nbsp;<a href="http://www.rioo.fr" target="_blank">Module développé par la société RIOO</a><br/>
                </div>';
	}

        public function getL($key)
	{
		$translations = array(
			'Cancellation' => $this->l('The transaction as been canceled.'),
                        'Transaction' => $this->l('CM-CIC transaction ID:'),
		);
		return $translations[$key];
	}

	public function hookPayment($params)
	{
		if (!$this->active)
			return ;

		global $smarty;

                //Recuperation des infos et initialisation variables
		$address = new Address(intval($params['cart']->id_address_invoice));
		$customer = new Customer(intval($params['cart']->id_customer));
		$version = Configuration::get('CMCIC_VERSION');
                $tpe_number = Configuration::get('CMCIC_TPE');
                $key = Configuration::get('CMCIC_CLE');
                $bank_server = Configuration::get('CMCIC_SERVER');
                $company_code = Configuration::get('CMCIC_CODESOCIETE');
		$currency = $this->getCurrency();
                $today = date("d/m/Y:H:i:s");
                // products + discounts + shipping cost
                $montant = number_format(Tools::convertPrice($params['cart']->getOrderTotal(true, 3), $currency), 2, '.', '');
                
                // Currency : ISO 4217 compliant
                $devise = $currency->iso_code;

                // Reference: unique, alphaNum (A-Z a-z 0-9), 12 characters max
                $reference = intval($params['cart']->id);

                // free texte : a bigger reference, session context for the return on the merchant website
                $texte_libre = '';

                // customer email
                $email = $customer->email;
                
                //Pour les échéances à faire dans la prochaine version
                // between 2 and 4
                //$sNbrEch = "4";
                $sNbrEch = "";

                // date echeance 1 - format dd/mm/yyyy
                //$sDateEcheance1 = date("d/m/Y");
                $sDateEcheance1 = "";

                // montant echeance 1 - format  "xxxxx.yy" (no spaces)
                //$sMontantEcheance1 = "0.26" . $sDevise;
                $sMontantEcheance1 = "";

                // date echeance 2 - format dd/mm/yyyy
                //$sDateEcheance2 = date("d/m/Y", mktime(0, 0, 0, date("m") +1 , date("d"), date("Y")));
                $sDateEcheance2 = "";

                // montant échéance 2 - format  "xxxxx.yy" (no spaces)
                //$sMontantEcheance2 = "0.25" . $sDevise;
                $sMontantEcheance2 = "";

                // date echeance 3 - format dd/mm/yyyy
                //$sDateEcheance3 = date("d/m/Y", mktime(0, 0, 0, date("m") +2 , date("d"), date("Y")));
                $sDateEcheance3 = "";

                // montant echeance 3 - format  "xxxxx.yy" (no spaces)
                //$sMontantEcheance3 = "0.25" . $sDevise;
                $sMontantEcheance3 = "";

                // date echeance 4 - format dd/mm/yyyy
                //$sDateEcheance4 = date("d/m/Y", mktime(0, 0, 0, date("m") +3 , date("d"), date("Y")));
                $sDateEcheance4 = "";

                // montant echeance 4 - format  "xxxxx.yy" (no spaces)
                //$sMontantEcheance4 = "0.25" . $sDevise;
                $sMontantEcheance4 = "";

                $sOptions = "";

		if (!Validate::isLoadedObject($address) OR !Validate::isLoadedObject($customer) OR !Validate::isLoadedObject($currency))
			return $this->l('CM-CIC error: (invalid address or customer)');

                 //Definitions des variables pour accès par la classe de CM-CIC
                define('CMCIC_CLE',$key);define('CMCIC_TPE',$tpe_number);define('CMCIC_CODESOCIETE',$company_code);define('CMCIC_VERSION',$version);

                 //Control String
                $oTpe = new CMCIC_Tpe('FR');
                $oHmac = new CMCIC_Hmac($oTpe);

                // Data to certify
                $PHP1_FIELDS = sprintf(CMCIC_CGI1_FIELDS,     $oTpe->sNumero,
                    $today,
                    $montant,
                    $devise,
                    $reference,
                    $texte_libre,
                    $oTpe->sVersion,
                    $oTpe->sLangue,
                    $oTpe->sCodeSociete,
                    $email,
                    $sNbrEch,
                    $sDateEcheance1,
                    $sMontantEcheance1,
                    $sDateEcheance2,
                    $sMontantEcheance2,
                    $sDateEcheance3,
                    $sMontantEcheance3,
                    $sDateEcheance4,
                    $sMontantEcheance4,
                    $sOptions);

                // MAC computation
                $sMAC = $oHmac->computeHmac($PHP1_FIELDS);
			
		$smarty->assign(array(
                        'version'=> $version,
			'tpe' => $tpe_number,
                        'bank_server' => $bank_server,
                        'today' => $today,
			'email' => $email,
                        'codesociete' => $company_code,
                        'lgue' => 'FR',
		        'amount' => $montant.$devise,
                        'smac' => $sMAC,
			'reference' => $reference,
                        'texte_libre' => $texte_libre,
			'url_retour' => 'http://'.htmlspecialchars($_SERVER['HTTP_HOST'], ENT_COMPAT, 'UTF-8').__PS_BASE_URI__.'index.php',
                        'url_retour_ok' => 'http://'.htmlspecialchars($_SERVER['HTTP_HOST'], ENT_COMPAT, 'UTF-8').__PS_BASE_URI__.'order-confirmation.php?key='.$customer->secure_key.'&id_cart='.intval($params['cart']->id).'&id_module='.intval($this->id),
                        //'url_retour_err' => 'http://'.htmlspecialchars($_SERVER['HTTP_HOST'], ENT_COMPAT, 'UTF-8').__PS_BASE_URI__.'order.php?key='.$customer->secure_key.'&id_cart='.intval($params['cart']->id).'&id_module='.intval($this->id)
                        'url_retour_err' => 'http://'.htmlspecialchars($_SERVER['HTTP_HOST'], ENT_COMPAT, 'UTF-8').__PS_BASE_URI__.'order-confirmation.php?key='.$customer->secure_key.'&id_cart='.intval($params['cart']->id).'&id_module='.intval($this->id),

		));

		return $this->display(__FILE__, 'cmcic.tpl');
	}

	public function hookPaymentReturn($params)
	{
		if (!$this->active)
			return ;

                //Tester l'etat de paiement de la commande
                //Si paiement ok et facture créée alors confirmation
                if($params['objOrder']->total_paid_real > 0 && $params['objOrder']->invoice_number > 0){

                   return $this->display(__FILE__, 'confirmation.tpl');
                }
                //Sinon message d'erreur
                else{
                    return $this->display(__FILE__, 'annulation.tpl');
                }
		
	}

	function validateOrder($id_cart, $id_order_state, $amountPaid, $paymentMethod = 'Unknown', $message = NULL, $extraVars = array(), $currency_special = NULL, $dont_touch_amount = false)
	{
		//$fp = fopen('log.html','a+');

                if (!$this->active)
			return ;

                //Si paiement OK
                if($id_order_state == _PS_OS_PAYMENT_){

                    //Vérifier si il existe une commande correspondant au cart aujourd'hui dont il manque le paiement
                    $sql = 'SELECT id_order FROM '._DB_PREFIX_.'orders where total_paid_real = 0 AND module = \'cmcic\' AND date_add LIKE \''.date('Y-m-d').'%\' AND id_cart='.intval($id_cart);
                    //fwrite($fp, $sql."<br>");
                    $resultat = Db::GetInstance()->Execute($sql);
                    $r = mysql_fetch_assoc($resultat);
                    //fwrite($fp, "nombre de lignes:".mysql_num_rows($resultat)."<br>");
                    /***********************************
                    *  Si il la commande éxistait précedemment
                    *  avec un manque de paiement il faut faire un update
                    **********************************************/
                    if(mysql_num_rows($resultat) > 0){

                        //fwrite($fp, "Il existe une ligne<br> ");
                        $id_order_current = intval($r['id_order']);
                        $cart = new Cart(intval($id_cart));
                        
                        /* Copying data from cart */
                        $order = new Order();
                        $order->id = $id_order_current;
                        $order->id_carrier = intval($cart->id_carrier);
                        $order->id_customer = intval($cart->id_customer);
                        $order->id_address_invoice = intval($cart->id_address_invoice);
                        $order->id_address_delivery = intval($cart->id_address_delivery);
                        $vat_address = new Address(intval($order->id_address_delivery));
                        $id_zone = Address::getZoneById(intval($vat_address->id));
                        $order->id_currency = ($currency_special ? intval($currency_special) : intval($cart->id_currency));
                        $order->id_lang = intval($cart->id_lang);
                        $order->id_cart = intval($cart->id);
                        $customer = new Customer(intval($order->id_customer));
                        $order->secure_key = pSQL($customer->secure_key);
                        $order->payment = substr($paymentMethod, 0, 32);
                        if (isset($this->name))
                            $order->module = $this->name;
                        $order->total_paid_real = floatval(number_format($amountPaid, 2, '.', ''));
                        $order->recyclable = $cart->recyclable;
                        $order->gift = intval($cart->gift);
                        $order->gift_message = $cart->gift_message;
                        $currency = new Currency($order->id_currency);
                        $amountPaid = floatval(Tools::convertPrice(floatval(number_format($amountPaid, 2, '.', '')), $currency));
                        $order->total_paid_real = $amountPaid;
                        $order->total_products = floatval(Tools::convertPrice(floatval(number_format($cart->getOrderTotal(false, 1), 2, '.', '')), $currency));
                        $order->total_discounts = floatval(Tools::convertPrice(floatval(number_format(abs($cart->getOrderTotal(true, 2)), 2, '.', '')), $currency));
                        $order->total_shipping = floatval(Tools::convertPrice(floatval(number_format($cart->getOrderShippingCost(), 2, '.', '')), $currency));
                        $order->total_wrapping = floatval(Tools::convertPrice(floatval(number_format(abs($cart->getOrderTotal(true, 6)), 2, '.', '')), $currency));
                        $order->total_paid = floatval(Tools::convertPrice(floatval(number_format($cart->getOrderTotal(true, 3), 2, '.', '')), $currency));

                        /* Mettre à jour le montant du paiement dans la table orders */
                        $sql = 'UPDATE '._DB_PREFIX_.'orders SET total_paid_real='.$order->total_paid_real.' where id_order='.$id_order_current.'';
                        //fwrite($fp, "Update:".$sql."<br>");
                        $resultat = Db::GetInstance()->Execute($sql);

                        /* Changer l'état de la commande dans l'historique */
                        $history = new OrderHistory();
                        $history->id_order = intval($id_order_current);
                        $history->changeIdOrderState(intval($id_order_state), intval($id_order_current));
                        $history->addWithemail(true, $extraVars);

                        //fwrite($fp, "Changement historique ok <br>");

                         /* Hook nouvelle commande */
                        $orderStatus = new OrderState(intval($id_order_state));

                        if (Validate::isLoadedObject($orderStatus)){
                                Hook::newOrder($cart, $order, $customer, $currency, $orderStatus);
                                foreach ($cart->getProducts() as $product)
                                    if ($orderStatus->logable)
                                        ProductSale::addProductSale($product['id_product'], $product['quantity']);
                         }

                         //fwrite($fp, "Hook ok <br>");

                         $invoice = new Address(intval($order->id_address_invoice));
					$delivery = new Address(intval($order->id_address_delivery));
					$carrier = new Carrier(intval($order->id_carrier));
					$delivery_state = $delivery->id_state ? new State(intval($delivery->id_state)) : false;
					$invoice_state = $invoice->id_state ? new State(intval($invoice->id_state)) : false;

					$data = array(

						'{firstname}' => $customer->firstname,
						'{lastname}' => $customer->lastname,
						'{email}' => $customer->email,
						'{delivery_company}' => $delivery->company,
						'{delivery_firstname}' => $delivery->firstname,
						'{delivery_lastname}' => $delivery->lastname,
						'{delivery_address1}' => $delivery->address1,
						'{delivery_address2}' => $delivery->address2,
						'{delivery_city}' => $delivery->city,
						'{delivery_postal_code}' => $delivery->postcode,
						'{delivery_country}' => $delivery->country,
						'{delivery_state}' => $delivery->id_state ? $delivery_state->name : '',
						'{delivery_phone}' => $delivery->phone,
						'{delivery_other}' => $delivery->other,
						'{invoice_company}' => $invoice->company,
						'{invoice_firstname}' => $invoice->firstname,
						'{invoice_lastname}' => $invoice->lastname,
						'{invoice_address2}' => $invoice->address2,
						'{invoice_address1}' => $invoice->address1,
						'{invoice_city}' => $invoice->city,
						'{invoice_postal_code}' => $invoice->postcode,
						'{invoice_country}' => $invoice->country,
						'{invoice_state}' => $invoice->id_state ? $invoice_state->name : '',
						'{invoice_phone}' => $invoice->phone,
						'{invoice_other}' => $invoice->other,
						'{order_name}' => sprintf("#%06d", intval($order->id)),
						'{date}' => Tools::displayDate(date('Y-m-d H:i:s'), intval($order->id_lang), 1),
						'{carrier}' => (strval($carrier->name) != '0' ? $carrier->name : Configuration::get('PS_SHOP_NAME')),
						'{payment}' => $order->payment,
						'{products}' => $productsList,
						'{discounts}' => $discountsList,
						'{total_paid}' => Tools::displayPrice($order->total_paid, $currency, false, false),
						'{total_products}' => Tools::displayPrice($order->total_paid - $order->total_shipping - $order->total_wrapping+ $order->total_discounts, $currency, false, false),
						'{total_discounts}' => Tools::displayPrice($order->total_discounts, $currency, false, false),
						'{total_shipping}' => Tools::displayPrice($order->total_shipping, $currency, false, false),
						'{total_wrapping}' => Tools::displayPrice($order->total_wrapping, $currency, false, false)
					);

					if (is_array($extraVars))
						$data = array_merge($data, $extraVars);

					// Join PDF invoice
					if (intval(Configuration::get('PS_INVOICE')) AND Validate::isLoadedObject($orderStatus) AND $orderStatus->invoice AND $order->invoice_number)
					{
						$fileAttachment['content'] = PDF::invoice($order, 'S');
						$fileAttachment['name'] = Configuration::get('PS_INVOICE_PREFIX', intval($order->id_lang)).sprintf('%06d', $order->invoice_number).'.pdf';
						$fileAttachment['mime'] = 'application/pdf';
					}
					else
						$fileAttachment = NULL;

                        if ($orderStatus->send_email AND Validate::isEmail($customer->email)){
                            //fwrite($fp, "Entrez if mail<br>");
                            Mail::Send(intval($order->id_lang), 'order_conf', 'Order confirmation', $data, $customer->email, $customer->firstname.' '.$customer->lastname, NULL, NULL, $fileAttachment);
                        }
                            
                        //fwrite($fp, "Mail ok <br>");

                        return true;

                    }
                    //Si nouvelle commande sans problème avec paiement ok
                    else{
                        $currency = $this->getCurrency();
                        $cart = new Cart(intval($id_cart));
                        $cart->id_currency = $currency->id;
                        $cart->save();
                        parent::validateOrder($id_cart, $id_order_state, $amountPaid, $paymentMethod, $message, $extraVars, $currency_special, true); 
                    }

                }else{
                        $currency = $this->getCurrency();
                        $cart = new Cart(intval($id_cart));
                        $cart->id_currency = $currency->id;
                        $cart->save();
                        parent::validateOrder($id_cart, $id_order_state, $amountPaid, $paymentMethod, $message, $extraVars, $currency_special, true);
                }

		//fclose($fp);
	}
}
