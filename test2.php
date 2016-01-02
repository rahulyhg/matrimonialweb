<?php
ini_set('max_execution_time', 600);
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/29/2015
 * Time: 12:50 PM
 */

$temp = array();
for($i = 0; $i < 100; $i++)
{

    $timestamp = mt_rand(1, time());
//Format that timestamp into a readable date string.
    $string = date("Y-m-d H:m:s", $timestamp);
    array_push($temp, [

        "Message" => generateRandomString(),
        "Seen" => rand(0,1),
        "Time"=> $string

    ]);
}


print_r($temp);
echo '<br/> ========================================================================================================================== <br/>';

//print_r(sorting($temp));
print_r(usort($temp,$temp));

usort($array, function($temp, $temp) {
    return strcmp($temp['Time'], $temp['Time']);
});

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function sorting($temp)
{
    for($i=1; $i<count($temp); $i++)
    {
        $date1 = $temp[$i]['Time'];
        //$date1 = strtotime($date1);
        $j = $i-1;
        $date2 = $temp[$j]['Time'];
        //$date2 = strtotime($date2);
        while($j >= 0 && $date2 > $date1)
        {
            $temp[$j+1]['Message'] = $temp[$j]['Message'];
            $temp[$j+1]['Seen'] = $temp[$j]['Seen'];
            $temp[$j+1]['Time'] = $temp[$j]['Time'];
            $j -= 1;
        }
        $temp[$j+1]['Message'] = $temp[$i]['Message'];
        $temp[$j+1]['Seen'] =    $temp[$i]['Seen'];
        $temp[$j+1]['Time'] =    $temp[$i]['Time'];
    }
    return $temp;
}







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