<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 1/12/2016
 * Time: 12:07 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/QuickSearchController.php');

    $gender = 1; $ageHigh = 35; $agelow = 18;  $religion = 1; $sect = 2;
    $country = 1; $city = 179;

    $Object = new QuickSearchController();
    $result = $Object->performQuickSearch($gender,$ageHigh, $agelow, $religion, $sect, $country, $city);
    echo json_encode($result);