<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/8/2015
 * Time: 12:54 AM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/ProfileController.php');

  $Object = new Profile();
  $result = $Object->createProfile();


  echo json_encode($result);

