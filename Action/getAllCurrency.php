<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/7/2015
 * Time: 12:03 AM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/CurrencyController.php');

$Object = new CurrencyController();
$result = $Object->getCurrencyList();
echo json_encode($result);