<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 1/2/2016
 * Time: 12:59 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/ProfessionController.php');

               $Object = new NotificationController();
               $result = $Object->getNotification();
               echo json_encode($result);