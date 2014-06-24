<?php

require_once('../../config/config.inc.php');
require_once('../../init.php');

if (!$cookie->isLogged())
	Tools::redirect('../../authentication.php?back=modules/referralprogram/referralprogram-program.php');

$shop_name = htmlentities(Configuration::get('PS_SHOP_NAME'), NULL, 'utf-8');
$shop_url = 'http://'.$_SERVER['HTTP_HOST'];
$customer = new Customer(intval($cookie->id_customer));

$file = file_get_contents(dirname(__FILE__).'/mails/'.strval(preg_replace('#\.{2,}#', '.', Tools::getValue('mail'))));

$file = str_replace('{shop_name}', $shop_name, $file);
$file = str_replace('{shop_url}', $shop_url.__PS_BASE_URI__, $file);
$file = str_replace('{shop_logo}', $shop_url._PS_IMG_.'logo.jpg', $file);
$file = str_replace('{firstname}', $customer->firstname, $file);
$file = str_replace('{lastname}', $customer->lastname, $file);
$file = str_replace('{email}', $customer->email, $file);
$file = str_replace('{firstname_friend}', 'XXXXX', $file);
$file = str_replace('{lastname_friend}', 'xxxxxx', $file);
$file = str_replace('{link}', 'authentication.php?create_account=1', $file);
$file = str_replace('{discount}', Discount::display(floatval(Configuration::get('referralprogram_DISCOUNT_VALUE')), intval(Configuration::get('referralprogram_DISCOUNT_TYPE')), new Currency($cookie->id_currency)), $file);

echo $file;

?>
