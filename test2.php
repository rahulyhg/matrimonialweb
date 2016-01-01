<?php
ini_set('max_execution_time', 600);
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/29/2015
 * Time: 12:50 PM
 */

$temp = array();
$eduId   = 'education123132';
$fieldId = 'field1qwda';
$occuId  = 'occupationweqweqw';
$salary  = 'salary12345';
array_push($temp, ["Education"=>$eduId, "Field"=>$fieldId, "Occupation"=>$occuId,
    "Salary"=>$salary]);


/*
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Connection/Connection.php');


$db = new DBConnection();
$result = $db->DBConnect();

// echo print_r($_SESSION['basicInfo']) . '<br/>';

$file = $_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/csv/mail.csv';
$array = fromCSVFile($file);
//print_r($array);

for($i=0; $i<count($array); $i++)
{
    $countryName = $array[$i]['country_name'];
    $cityName    = $array[$i]['city_name'];
    if(strlen($cityName) > 1)
    {
         $query = "CALL mapCities('$countryName', '$cityName')";
         $result= $db->Select($query);
         echo $i . ' result: '. $result . '<br/>';
    }
}


function fromCSVFile( $file) {
    // open the CVS file
    $handle = @fopen( $file, "r");
    if ( !$handle ) {
        throw new \Exception( "Couldn't open $file!" );
    }

    $result = [];

    // read the first line
    $first = strtolower( fgets( $handle, 4096 ) );
    // get the keys
    $keys = str_getcsv( $first );

    // read until the end of file
    while ( ($buffer = fgets( $handle, 4096 )) !== false ) {

        // read the next entry
        $array = str_getcsv ( $buffer );
        if ( empty( $array ) ) continue;

        $row = [];
        $i=0;

        // replace numeric indexes with keys for each entry
        foreach ( $keys as $key ) {
            $row[ $key ] = $array[ $i ];
            $i++;
        }

        // add relational array to final result
        $result[] = $row;
    }

    fclose( $handle );
    return $result;
}
*/