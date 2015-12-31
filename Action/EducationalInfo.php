<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/7/2015
 * Time: 12:35 AM
 */


session_start();
$data = array();

if(isset($_POST['education']) && isset($_POST['field']) && isset($_POST['working']) && isset($_POST['currency']) &&
    isset($_POST['salary']))
{
    $education   =  $_POST['education'];
    $field       =  $_POST['field'];
    $working     =  $_POST['working'];
    $currency    =  $_POST['currency'];
    $salary      =  $_POST['salary'];

    if($education > 0 && $field > 0 && $working > 0 && $currency > 0 && $salary != "")
    {
        $salary = intval($salary);
        array_push($data, ["Status"=>"ok"]);
        if($salary >= 100)
        {
            array_push($data, [
                                "education"=>$education, "field"=>$field, "working"=>$working,
                                "currency"=>$currency, "salary"=>$salary
            ]);

            $_SESSION['educational'] = $data;
            session_write_close();
            echo json_encode($data);
        }
        else
        {
            array_push($data, ["Status"=>"error", "Message"=>"Invalid Salary detected "]);
            echo json_encode($data);
        }

    }
    else
    {
        array_push($data, ["Status"=>"error", "Message"=>"All fields must be provided "]);
        echo json_encode($data);
    }
}
else
{
    array_push($data, ["Status"=>"error", "Message"=>"Some Error occurred "]);
    echo json_encode($data);
}