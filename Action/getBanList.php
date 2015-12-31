<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/31/2015
 * Time: 1:44 PM
 */
require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/BlockListController.php');



        $Object  = new BlockListController();
        $data    = $Object->getBanList();
        echo json_encode($data);
