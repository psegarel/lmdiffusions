<?php
//il vous suffit de mettre votre adresse email a la ligne 35 


//On r�cup�re les valeurs du formulaire

$tel = $_POST['tel'];



 
?>
<?php //On cr��e le message email

$msg = "
Nom= $nom
Tel= $tel
E-mail= $email";

$recipient = "contact@peruk.fr"; 
$subject = "Formulaire contact site peruk"; //On met le sujet du mail

$mailheaders = "From: peruk  <> \n"; //depuis o� il a �t� post�


mail($recipient, $subject, $msg, $mailheaders); // message confirmation que le mail a bien �t� envoy�


?> 
<SCRIPT LANGUAGE="JavaScript">document.location.href="http://www.peruk.fr/valider.html"</SCRIPT>