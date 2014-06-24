<?php
//il vous suffit de mettre votre adresse email a la ligne 35 


//On récupère les valeurs du formulaire

$tel = $_POST['tel'];



 
?>
<?php //On créée le message email

$msg = "
Nom= $nom
Tel= $tel
E-mail= $email";

$recipient = "contact@peruk.fr"; 
$subject = "Formulaire contact site peruk"; //On met le sujet du mail

$mailheaders = "From: peruk  <> \n"; //depuis où il a été posté


mail($recipient, $subject, $msg, $mailheaders); // message confirmation que le mail a bien été envoyé


?> 
<SCRIPT LANGUAGE="JavaScript">document.location.href="http://www.peruk.fr/valider.html"</SCRIPT>