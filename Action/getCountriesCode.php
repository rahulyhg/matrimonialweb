<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/5/2015
 * Time: 10:26 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/CountryController.php');

$Object = new CountryController();
echo json_encode($Object->getCountries(false));