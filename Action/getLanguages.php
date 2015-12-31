<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/6/2015
 * Time: 11:08 AM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/LanguageController.php');

     $Object = new LanguageController();
     $result = $Object->getLanguages();
     echo json_encode($result);