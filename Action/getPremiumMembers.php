<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/13/2015
 * Time: 2:15 AM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/MembershipController.php');

    $Object = new MembershipController();
    $result = $Object->getPremiumMembers();
    //echo print_r($result);
    echo json_encode($result);

