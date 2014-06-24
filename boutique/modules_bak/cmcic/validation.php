<?php

include(dirname(__FILE__).'/../../config/config.inc.php');

//Security test @IP CM-CIC
list($rn1, $rn2) = explode(".",$_SERVER['REMOTE_ADDR']);
list($cmcicn1, $cmcicn2) = explode(".",Configuration::get('CMCIC_NETWORK'));

//Same network?
$network_ok ='';
if(($rn1 == $cmcicn1) && ($rn2 == $cmcicn2)){
   $network_ok = true;
}else{
   $network_ok = false;
  //Caution exit script
   exit("CMCIC_BAD_IP");
}

include(dirname(__FILE__).'/cmcic.php');

//$fp = fopen('log.txt','a+');

//fwrite($fp, 'ACCES A VALIDATION');

$errors = '';
$result = false;
$cmcic = new Cmcic();

//fwrite($fp, 'POST:'.print_r($_POST));


// Begin Main : Retrieve Variables posted by CMCIC Payment Server
$CMCIC_bruteVars = getMethode();

//fwrite($fp, 'CMCIC_bruteVars:'.print_r($CMCIC_bruteVars) );


define('CMCIC_VERSION',Configuration::get('CMCIC_VERSION'));
define('CMCIC_TPE', Configuration::get('CMCIC_TPE'));
define('CMCIC_CLE',Configuration::get('CMCIC_CLE'));
define('CMCIC_CODESOCIETE',Configuration::get('CMCIC_CODESOCIETE'));

// TPE init variables
$oTpe = new CMCIC_Tpe();
$oHmac = new CMCIC_Hmac($oTpe);

//fwrite($fp, ',Référencement:'.$CMCIC_bruteVars["reference"]);
//fwrite($fp, ',date:'.$CMCIC_bruteVars["date"]);
//fwrite($fp, ',MAC:'.$CMCIC_bruteVars["MAC"]);
//fwrite($fp, ',Ref:'.$CMCIC_bruteVars["reference"]);
//fwrite($fp, ',Retour:'.$CMCIC_bruteVars["code-retour"]);
//fwrite($fp, ',3ds:'.$CMCIC_bruteVars["status3ds"]);

// Message Authentication
$cgi2_fields = sprintf(CMCIC_CGI2_FIELDS, $oTpe->sNumero,
$CMCIC_bruteVars["date"],
$CMCIC_bruteVars['montant'],
$CMCIC_bruteVars['reference'],
$CMCIC_bruteVars['texte-libre'],
$oTpe->sVersion,
$CMCIC_bruteVars['code-retour'],
$CMCIC_bruteVars['cvx'],
$CMCIC_bruteVars['vld'],
$CMCIC_bruteVars['brand'],
$CMCIC_bruteVars['status3ds'],
$CMCIC_bruteVars['numauto'],
$CMCIC_bruteVars['motifrefus'],
$CMCIC_bruteVars['originecb'],
$CMCIC_bruteVars['bincb'],
$CMCIC_bruteVars['hpancb'],
$CMCIC_bruteVars['ipclient'],
$CMCIC_bruteVars['originetr'],
$CMCIC_bruteVars['veres'],
$CMCIC_bruteVars['pares']
);

// Printing errors...
if ($oHmac->computeHmac($cgi2_fields) == strtolower($CMCIC_bruteVars['MAC'])) {

       //fwrite($fp, ', TEST MAC OK');
	
        switch($CMCIC_bruteVars['code-retour']) {
		case "Annulation" :
                    //fwrite($fp, ', ANNULATION');
                            $errors = $cmcic->getL('Cancellation');
                            $cmcic->validateOrder(intval($CMCIC_bruteVars['reference']), _PS_OS_ERROR_, 0, $cmcic->displayName, $errors.'<br />');
			break;

		case "payetest":
                    //fwrite($fp, ', PAYETEST OK');
                    $cart = new Cart(intval($CMCIC_bruteVars['reference']));
                    //fwrite($fp, ', New cart OK'.print_r($cart));
                    if (!$cart->id){
                        //fwrite($fp, ',Error 1:');
                        $errors = $cmcic->getL('cart').'<br />';
                    }
                    else{
                        //fwrite($fp, ',validate ok');
                        $cmcic->validateOrder(intval($CMCIC_bruteVars['reference']), _PS_OS_PAYMENT_, floatval($CMCIC_bruteVars['montant']), $cmcic->displayName, $cmcic->getL('Transaction').$CMCIC_bruteVars['numauto']);
                    }
                    break;

		case "paiement":
                    //fwrite($fp, ', PAIEMENT OK');
                    $cart = new Cart(intval($CMCIC_bruteVars['reference']));
                    //fwrite($fp, ', New cart OK'.print_r($cart));
                    if (!$cart->id){
                        //fwrite($fp, ',Error 1:');
                        $errors = $cmcic->getL('cart').'<br />';
                    }
                    else{
                        //fwrite($fp, ',validate ok');
                        $cmcic->validateOrder(intval($CMCIC_bruteVars['reference']), _PS_OS_PAYMENT_, floatval($CMCIC_bruteVars['montant']), $cmcic->displayName, $cmcic->getL('Transaction').$CMCIC_bruteVars['numauto']);
                    }
                    break;

		/*** ONLY FOR MULTIPART PAYMENT ***/
		case "paiement_pf2":
		case "paiement_pf3":
		case "paiement_pf4":
			// Payment has been accepted on the productive server for the part #N
			// return code is like paiement_pf[#N]
			// put your code here (email sending / Database update)
			// You have the amount of the payment part in $CMCIC_bruteVars['montantech']
			break;

		case "Annulation_pf2":
		case "Annulation_pf3":
		case "Annulation_pf4":
			// Payment has been refused on the productive server for the part #N
			// return code is like Annulation_pf[#N]
			// put your code here (email sending / Database update)
			// You have the amount of the payment part in $CMCIC_bruteVars['montantech']
			break;
			
	}

        $receipt = CMCIC_CGI2_MACOK;


} else {

        //fwrite($fp, ', TEST MAC KO');

	$receipt = CMCIC_CGI2_MACNOTOK.$cgi2_fields;
        $errors .= $receipt;

        $cmcic->validateOrder(intval($CMCIC_bruteVars['reference']), _PS_OS_ERROR_, 0, $cmcic->displayName, $errors.'<br />');
}
printf (CMCIC_CGI2_RECEIPT, $receipt);

//fwrite($fp, ',receipt:'.$receipt."\r\n");

//fclose($fp);

?>