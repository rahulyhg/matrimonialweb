<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/6/2015
 * Time: 9:36 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/EducationController.php');

  $Object = new EducationController();
  $result = $Object->getEducationList();
  echo json_encode($result);