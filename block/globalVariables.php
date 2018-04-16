<?php

date_default_timezone_set('UTC');
//$currentUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

$dbInventari = 'ies_inventari';
$dbStaff = 'ies_staff';
$dbHost = 'localhost';
$dbUsername = 'iesInventari_sys';
$dbUsernamePass = 'RgkTs92';

$firstWarningForContractEndDate = 30;  //რამდენი დღით ადრე გამოიტანოს პირველი გამაფრთხილებელი მესიჯი ხელშეკრულების ვადის გასვლის შესახებ
$secondWarningForContractEndDate = 15; //რამდენი დღით ადრე გამოიტანოს მეორე გამაფრთხილებელი მესიჯი ხელშეკრულების ვადის გასვლის შესახებ
$expDayForContractEndDate = 100;  //რამდენი დღე დღის მერე აღარ გამოიტანოს გამაფრთხილებელი მესიჯი ხელშეკრულების ვადის გასვლის შესახებ(თანამშრომელი რომელიც აღარ მუშაობს)

$firstWarningForSalaryCardEndDate = 30; //რამდენი დღით ადრე გამოიტანოს პირველი გამაფრთხილებელი მესიჯი სახელფასო ბარათის ვადის გასვლის შესახებ
$secondWarningForSalaryCardEndDate = 15; //რამდენი დღით ადრე გამოიტანოს მეორე გამაფრთხილებელი მესიჯი სახელფასო ბარათის ვადის გასვლის შესახებ
$expDayForSalaryCardEndDate = 100; //რამდენი დღე დღის მერე აღარ გამოიტანოს გამაფრთხილებელი მესიჯი სახელფასო ბარათის ვადის გასვლის შესახებ(თანამშრომელი რომელიც აღარ მუშაობს)

$siteMaintenanceUsername = 'admin';
$siteMaintenancePass = 'res0urcE!23';
$siteMaintenanceFirstname = '';
$siteMaintenanceLastname = 'ადმინისტრატორი';

$siteGuesteUsername = 'guest';
$siteGuestPass = 'Guest123';
$siteGuestFirstname = '';
$siteGuestLastname = 'სტუმარი';



?>
