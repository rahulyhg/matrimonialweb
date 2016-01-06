<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 1/6/2016
 * Time: 11:18 AM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/ProfessionController.php');

//$educationId, $fieldId, $occupationId, $salary, $currencyId

$data = array();

if(isset($_POST['educationId']) && isset($_POST['fieldId'])&& isset($_POST['occupationId'])&&
   isset($_POST['salary'])&& isset($_POST['currencyId']))
{
    $education  = $_POST['educationId'];
    $field      = $_POST['fieldId'];
    $occupation = $_POST['occupationId'];
    $salary     = $_POST['salary'];
    $currency   = $_POST['currencyId'];

    if(intval($education) > 0 && intval($field) > 0   && intval($occupation) > 0   && intval($salary) > 0   &&
       intval($currency) > 0)
    {
        $Object = new ProfessionController();
        $data   = $Object->updateUserProfessionalInformation($education, $field, $occupation, $salary, $currency);
        echo json_encode($data);
    }
    else
    {
        array_push($data,["Status"=>"error", "Message"=>"Invalid arguments detected !!!.."]);
    }
}
else
{
    array_push($data,["Status"=>"error", "Message"=>"Something went terribly wrong !!!.."]);
}
echo json_encode($data);