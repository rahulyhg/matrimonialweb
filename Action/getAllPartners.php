<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/12/2015
 * Time: 12:02 AM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/PartnerController.php');

   $Object = new PartnerController();
   $result = $Object->getAllPartnerList();
   echo  json_encode($result);