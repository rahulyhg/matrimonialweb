<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 1/5/2016
 * Time: 5:47 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/MembershipController.php');

$Object = new MembershipController();
$result = $Object->getUserMembership();
//echo print_r($result);
echo json_encode($result);