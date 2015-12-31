<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/29/2015
 * Time: 12:41 AM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/ProfessionController.php');




        $Object = new ProfessionController();
        $data   = $Object->getProfessionalInformation();
        echo json_encode($data);