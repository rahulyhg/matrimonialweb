<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/7/2015
 * Time: 2:17 AM
 */



$array = range(18, 35);
sort($array);
$string = implode(',',$array);
echo print_r($array) . '<br/>';
echo $string . '<br/>';

/*
require_once($_SERVER['DOCUMENT_ROOT'].'/matrimonialweb/swiftmailer/lib/swift_required.php');

$html = '<html> <body> <p> This is a fake email just for testing purpose </p></body>';
$transport = Swift_SmtpTransport::newInstance('smtp.ipage.com', 465, 'ssl');
$transport->setUsername('support@mabsapps.com');
$transport->setPassword('Mail1234');

$swift = Swift_Mailer::newInstance($transport);
$message = new Swift_Message('Testing subject');
$message->setFrom('support@mabsapps.com');
$message->setBody($html, 'text/html');
$message->setTo('haziq.ahmed92@gmail.com');
$message->addPart("testing text", 'text/plain');
$swift->send($message, $failures);




/*
require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Connection/Connection.php');

     $db = new DBConnection();
     $result  = $db->DBConnect();
     $param = 11;
     $query = "SELECT * FROM user";
     $result = $db->Select($query);
     if($result)
     {
        while(($row = mysqli_fetch_assoc($result)) != false)
        {
            echo print_r($row). '<br/>';
        }

     }
else
{
    echo 'Error';
}



/*
//error_reporting(0);

$partnerAge = array();
$userAge = 30;
$highRange  =   intval($userAge) + 5;
$lowRange   =   intval($userAge) - 5;
$array_High =   range($userAge,$highRange);
$array_Low  =   range($lowRange,$userAge);
$partnerAge = $array_High;
$partnerAge =  array_merge($partnerAge, $array_Low);
echo 'Before Sort <br/>';
print_r($partnerAge);
echo '<br/> After Sort <br/>';
sort($partnerAge);
print_r($partnerAge);

$string = "";
for($i=0; $i<count($partnerAge); $i++)
{
    $string .= $partnerAge[$i] . ',';
}
$string = rtrim($string, ',');
echo '<br/> String <br/>';
echo $string . '<br/>';

$c = date('Y');
$a = date('Y',strtotime("1992-10-31"));
echo $c - $a;



require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/ProfileController.php');

$date = date('Y-m-d h:m:s');
$timeStamp = strtotime($date);
echo  'Normal: ' . $date . '<br/>';
echo 'TimeStamp: ' . $timeStamp . '<br/>';
echo 'Normal: '. date('Y-m-d h:m:s', $timeStamp) . '<br/>';


$Object = new ProfileController();
 $result =  $Object->createProfile();
echo json_encode($result) . '<br/>';
session_start();

//$_SESSION['basicInfo']
//$_SESSION['socialInfo']
//$_SESSION['physical']
//$_SESSION['partner']

echo json_encode($_SESSION['basicInfo']). '<br/>';
echo json_encode($_SESSION['socialInfo']). '<br/>';
echo json_encode($_SESSION['physical']). '<br/>';
echo json_encode($_SESSION['educational']). '<br/>';
echo json_encode($_SESSION['partner']). '<br/>';



//echo $_SESSION['basicInfo'][1]['Cell'] . '<br/>';
*/
