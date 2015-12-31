<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/6/2015
 * Time: 9:57 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/FieldController.php');

   $Object = new FieldController();
   $result = $Object->getAllFields();
   echo json_encode($result);