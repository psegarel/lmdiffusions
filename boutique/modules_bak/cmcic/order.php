<?php
// Module de paiement par Cre@Web06.fr
// Version 1.10, gère le paiement comptant et le paiement multiple

include(dirname(__FILE__).'/../../config/config.inc.php');

@ini_set('display_errors', 'off');

header("Pragma: no-cache");
header("Content-type: text/plain");

// Modes activés
$cmcic_active	= (bool)Configuration::get('CMCIC_ACTIVE');
$cmcicnf_active	= (bool)Configuration::get('CMCICNF_ACTIVE');


// Récupération des infos du compte (infos communes) si au moins un mode de paiement actif
if( $cmcic_active or $cmcicnf_active )
{
	$MyTpe["retourbanque"] = Configuration::get('CMCIC_URLCGI2');
	$MyTpe["retourok"]     = Configuration::get('CMCIC_URLOK');
	$MyTpe["retournok"]    = Configuration::get('CMCIC_URLNOK');
	$MyTpe["version"]	   = Configuration::get('CMCIC_VERSION');
	
	define ("CMCIC_VERSION", $MyTpe["version"]);
	define ("CMCIC_URLOK", $MyTpe["retourok"]);
	define ("CMCIC_URLKO", $MyTpe["retournok"]);
} else {
	// On ne va pas plus loin
	exit;
}

// Récupération des infos suivant les modes de paiement actifs
if( $cmcic_active )
{
	$MyTpe["tpe"] 			= Configuration::get('CMCIC_TPE');
	$MyTpe["codesociete"] 	= Configuration::get('CMCIC_CODESOCIETE');
	$MyTpe["cle"]           = Configuration::get('CMCIC_CLE');
	$MyTpe["serveur"]       = Configuration::get('CMCIC_SERVEUR');
	
	define ("CMCIC_CLE", $MyTpe["cle"]);
	define ("CMCIC_TPE", $MyTpe["tpe"]);
	define ("CMCIC_CODESOCIETE", $MyTpe["codesociete"]);
	define ("CMCIC_SERVEUR", $MyTpe["serveur"]);
}
if( $cmcicnf_active )
{
	$MyTpe["tpenf"] 			= Configuration::get('CMCICNF_TPE');
	$MyTpe["codesocietenf"] 	= Configuration::get('CMCICNF_CODESOCIETE');
	$MyTpe["clenf"]				= Configuration::get('CMCICNF_CLE');
	$MyTpe["serveurnf"]       	= Configuration::get('CMCICNF_SERVEUR');
	
	define ("CMCICNF_CLE", $MyTpe["clenf"]);
	define ("CMCICNF_TPE", $MyTpe["tpenf"]);
	define ("CMCICNF_CODESOCIETE", $MyTpe["codesocietenf"]);
	define ("CMCICNF_SERVEUR", $MyTpe["serveurnf"]);
}


// Fichiers des cryptages hmac euroinformation
require_once(_PS_MODULE_DIR_."cmcic/CMCIC_Tpe.inc.php");

// Récupération des valeurs de retour de la banque
$CMCIC_bruteVars = getMethode();


// Fonction de récupération de la référence du panier
function recupReferencePanier($ref){
	return (int)substr($ref,0,-4);
}

if( !$CMCIC_bruteVars )
{
	$cgi2_fields = '';
	printf(CMCIC_CGI2_RECEIPT,CMCIC_CGI2_MACNOTOK.$cgi2_fields);
	exit;
}

$idcartrecup = intval(recupReferencePanier($CMCIC_bruteVars['reference']));

$cart = new Cart($idcartrecup);
$MyTpe["langue"] = strtoupper(Language::getIsoById($cart->id_lang));

// Pour compatibilité avec le kit euroinformation
$sVersion		= $MyTpe["version"];
$sNumero		= $MyTpe["tpe"];	
$sCodeSociete	= $MyTpe["codesociete"];
$sLangue		= $MyTpe["langue"];
$sUrlOK			= $MyTpe["retourok"];
$sUrlKO			= $MyTpe["retournok"];
$sUrlpaiement	= $MyTpe["serveur"];
$sCodeSocietenf = $MyTpe["codesocietenf"];
$sUrlpaiementnf = $MyTpe["serveurnf"];

if(isset($CMCIC_bruteVars["montantech"])){
	$oTpe = new CMCIC_Tpe_nf();
} else {
	$oTpe = new CMCIC_Tpe();
}
$oHmac = new CMCIC_Hmac($oTpe);

if( !isset($CMCIC_bruteVars['motifrefus']) )
	$CMCIC_bruteVars['motifrefus'] = '';
if( !isset($CMCIC_bruteVars['originecb']) )
	$CMCIC_bruteVars['originecb'] = '';
if( !isset($CMCIC_bruteVars['bincb']) )
	$CMCIC_bruteVars['bincb'] = '';
if( !isset($CMCIC_bruteVars['hpancb']) )
	$CMCIC_bruteVars['hpancb'] = '';
if( !isset($CMCIC_bruteVars['ipclient']) )
	$CMCIC_bruteVars['ipclient'] = '';
if( !isset($CMCIC_bruteVars['originetr']) )
	$CMCIC_bruteVars['originetr'] = '';
if( !isset($CMCIC_bruteVars['veres']) )
	$CMCIC_bruteVars['veres'] = '';
if( !isset($CMCIC_bruteVars['pares']) )
	$CMCIC_bruteVars['pares'] = '';
if( !isset($CMCIC_bruteVars['bincb']) )
	$CMCIC_bruteVars['bincb'] = '';
if( !isset($CMCIC_bruteVars['montantech']) )
	$CMCIC_bruteVars['montantech'] = '';
if( !isset($CMCIC_bruteVars['texte-libre']) )
	$CMCIC_bruteVars['texte-libre'] = '';
	
	
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
					  	  $CMCIC_bruteVars['pares']);
						  $CMCIC_bruteVars['montantech'];



// Requête mysql pour la base cmcic_paiements
$sql_save_responsepayment = "INSERT INTO "._DB_PREFIX_."cmcic_paiements (id_cart,reference,date,montant,text_libre,code_retour,cvx,vld,brand,status3ds,numauto,motifrefus,originecb,bincb,hpancb,ipclient,originetr,veres,pares,montantech)
							    VALUES ('".$idcartrecup."','".$CMCIC_bruteVars['reference']."','".htmlentities($CMCIC_bruteVars['date'])."',
							  			'".htmlentities($CMCIC_bruteVars['montant'])."','".htmlentities($CMCIC_bruteVars['texte-libre'])."','".htmlentities($CMCIC_bruteVars['code-retour'])."',
							  			'".htmlentities($CMCIC_bruteVars['cvx'])."','".$CMCIC_bruteVars['vld']."','".$CMCIC_bruteVars['brand']."',
							  			'".htmlentities($CMCIC_bruteVars['status3ds'])."','".htmlentities($CMCIC_bruteVars['numauto'])."','".htmlentities($CMCIC_bruteVars['motifrefus'])."',
							  			'".htmlentities($CMCIC_bruteVars['originecb'])."','".htmlentities($CMCIC_bruteVars['bincb'])."','".htmlentities($CMCIC_bruteVars['hpancb'])."',
							  			'".htmlentities($CMCIC_bruteVars['ipclient'])."','".htmlentities($CMCIC_bruteVars['originetr'])."','".htmlentities($CMCIC_bruteVars['veres'])."',
							  			'".htmlentities($CMCIC_bruteVars['pares'])."','".htmlentities($CMCIC_bruteVars['montantech'])."')";


// Si il y a un montant d'échéance
if(!$CMCIC_bruteVars['montantech'])
{ // Paiement 1 fois
	$libelle_paiement = 'Paiement comptant CB';
} else { // Paiement plusieurs fois
	$libelle_paiement = 'Paiement en '.Configuration::get('CMCICNF_NBMENS').' fois CB';
}


// Si paiement test
if($CMCIC_bruteVars['code-retour']=="payetest")
	$libelle_paiement = $libelle_paiement.' test';


// Recherche du paiement en BDD
$payments = Db::getInstance()->ExecuteS("select * from "._DB_PREFIX_."cmcic_paiements where id_cart=".$idcartrecup);

// Conditions d'enregistrement en BDD
if($payments && $CMCIC_bruteVars['montantech']){ // Si paiement présent, et montant échéance présent dans le retour
	Db::GetInstance()->Execute($sql_save_responsepayment);
} elseif (!$payments) { // Si aucun paiement présent en bdd
	Db::GetInstance()->Execute($sql_save_responsepayment);
}

// Conversion du libellé en UTF8
$libelle_paiement = utf8_encode($libelle_paiement);


// Contrôle HMAC du retour
if ($oHmac->computeHmac($cgi2_fields) == strtolower($CMCIC_bruteVars['MAC']))
	{
	
	switch($CMCIC_bruteVars['code-retour']) {
		case "Annulation" :
			// Paiement refusé, pas d'enregistrement de la commande, client retourne à son panier d'achat
			printf(CMCIC_CGI2_RECEIPT,CMCIC_CGI2_MACOK);
			break;

		case "payetest":
			// Paiement accepté en mode test, enregistrement de la commande
			printf(CMCIC_CGI2_RECEIPT,CMCIC_CGI2_MACOK);
			
			include_once('cmcic.php');
			$EI = new CMCIC();
			$montant = number_format(floatval($CMCIC_bruteVars['montant']), 2, '.', '');
			$EI->validateOrder($idcartrecup, '2', $montant, $EI->displayName,$libelle_paiement.'Paiement No '.intval($CMCIC_bruteVars['reference']),array(),null,false,$cart->secure_key);
			break;

		case "paiement":
			// Paiement accepté, enregistrement de la commande
			printf(CMCIC_CGI2_RECEIPT,CMCIC_CGI2_MACOK);
			
			include_once('cmcic.php');
			$EI = new CMCIC();
			$montant = number_format(floatval($CMCIC_bruteVars['montant']), 2, '.', '');
			$EI->validateOrder($idcartrecup, '2', $montant, $EI->displayName,'Paiement No '.intval($CMCIC_bruteVars['reference']),array(),null,false,$cart->secure_key);
			break;
			
	}

}
else
{
	// your code if the HMAC doesn't match
	printf(CMCIC_CGI2_RECEIPT,CMCIC_CGI2_MACNOTOK.$cgi2_fields);
}




?>
