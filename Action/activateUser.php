<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/30/2015
 * Time: 2:13 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/UserController.php');

        $data = array();

        if(isset($_POST['id']))
        {
            $id = $_POST['id'];
            if(strlen($id) > 0)
            {
                $Object = new UserController();
                $data   = $Object->activateUserByLink($id);
            }
            else
            {
                array_push($data, ["Status"=>"error", "Message"=>"Authentication token cant be empty"]);
            }
        }
        else
        {
            array_push($data, ["Status"=>"error", "Message"=>"some error occurred"]);
        }
echo json_encode($data);