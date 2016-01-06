<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 1/6/2016
 * Time: 2:24 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Connection/Connection.php');


class QuickSearch {

    private $db;
    private $query;
    private $connection;
    private $result;
    private $status;
    private $data;
    private $error;

    public function __construct()
    {
        $this->data = array();
        $this->status = true;
        $this->db = new DBConnection();
        $this->connection = $this->db->DBConnect();
        if(!$this->connection)
        {
            $this->status = false;
            array_push($this->data, ["Status"=>"error", "Message" => mysqli_error($this->connection)]);
        }
    }

    /**
     * * * get the list of matching partners through searching criteria
     * the attributes involved in the searching criteria would be as follows
     * + gender information
     * + age information      (both high range and low range)
     * + religion Information (both religion and sect)
     * + state information    (both country and city)
     *
     * Once all the attributes are satisfied the system will perform the search operation to find the matching
     * partners list.
     * The list of matching partner will contain partner
     * + gender
     * + age
     * + religion (religion & sect)
     * + state    (country & state)
     * + username
     * + approved image -- if the user does not have any image or in case the uploaded image is not approved then the default image will be shown
     *   instead
     *
     * The System will search through series of age constraints which is observed normally during partner searching in real world..
     *
     * @param $gender
     * @param int $ageLow
     * @param int $ageHigh
     * @param $religion
     * @param $sect
     * @param $country
     * @param $city
     * @return array
     */
    public function getMatchingPartnersList($gender, $ageLow = 18, $ageHigh = 35,$religion = 1, $sect, $country, $city)
    {
        if($this->status)
        {
             if($this->searchWithinReach($gender, $ageLow, $ageHigh, $religion, $sect, $country, $city))
              {
                 return $this->data;
              }
             else
             {
                 array_push($this->data, ["Status"=>"error", "Message"=>$this->error]);
             }
        }
        else
        {
            array_push($this->data, ["Status"=>"error", "Message"=>"Error occurred during connection"]);
        }
        return $this->data;
    }


    private function searchWithinReach($gender, $ageLow, $ageHigh,$religion, $sect, $country, $city)
    {
         $partnerAge = $this->getPartnerAge($ageLow, $ageHigh);
        if( ( $rid =  $this->getReligionSect($religion,$sect) > 0 ) && ( $sid =  $this->getState($country,$city)  > 0 ) )
        {

        }
         return false;
    }


    /**
     * Get the full age range include in the given attributes
     * @param $ageLow
     * @param $ageHigh
     * @return String enclosed in commas
     */
    private function getPartnerAge($ageLow, $ageHigh)
    {
        $array = range($ageLow, $ageHigh);
        sort($array);
        $string = implode(',', $array);
        return $string;
    }

    private function getReligionSect($religion, $sect)
    {
        $this->query = "SELECT religionsectId FROM religionsect WHERE religionId = $religion AND sectId = $sect";
        $this->result = $this->db->Select($this->query);
        if($this->result && mysqli_num_rows($this->result) > 0)
        {
            $row = mysqli_fetch_assoc($this->result);
            $rid = $row['religionsectId'];
            return $rid;
        }
        $this->error .= "Error occurred during transaction of religionSect identification \n";
        return 0;
    }

    private  function getState($countryId, $cityId)
    {
        $this->query = "SELECT state.stateid FROM state WHERE countryid = $countryId AND cityid = $cityId";
        $this->result = $this->db->Select($this->query);
        if($this->result && mysqli_num_rows($this->result) > 0)
        {
            $row = mysqli_fetch_assoc($this->result);
            $rid = $row['stateid'];
            return $rid;
        }
        $this->error .= "Error occurred during transaction of State identification \n";
        return 0;
    }

    private function getPartnersList($gender, $age, $religionSect, $state)
    {
        $this->query = "SELECT UserID,dob FROM profile WHERE age IN ($age) AND genderId = $gender AND religionId = $religionSect AND stateId = $state";
        $this->result= $this->db->Select($this->query);
        if($this->result)
        {
            if(mysqli_num_rows($this->result) > 0)
            {
                while(($row = mysqli_fetch_assoc($this->result)) != false)
                {
                  $userId  = $row['UserID'];
                  $dob     = $row['dob'];
                }
            }
            else
            {
                $this->error .= "Sorry we didn't find any matches..  \n";
            }
        }
        else
        {
            $this->error .= "Extraction of partner information interrupted due to some error \n";
        }
        return false;
    }
}