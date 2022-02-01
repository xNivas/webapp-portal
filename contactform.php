<?php

if(isset($_POST['submit'])){
	$imie=$_POST['imie'];
	$mail=$_POST['email'];
	$wiadomosc=$_POST['wiadomosc'];

$mailTo = "177509@student.ue.wroc.pl"
$headers= "Od: ".$mailFrom;
$txt ="Otrzymałeś maila od ".$imie.".\n\n".$wiadomosc;


mail($mailTo,$txt,$headers);
header("Location: kontakt.php?mailsend")
}
