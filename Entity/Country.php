<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/5/2015
 * Time: 9:55 PM
 */


require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Connection/Connection.php');
require_once($_SERVER['DOCUMENT_ROOT']. '/matrimonialweb/Entity/AES.php');

class Country
{

    /**
     * @var
     * private fields
     */
    protected $db;
    protected $status;
    protected $data;
    protected $connection;
    protected $query;
    protected $result;
    protected $blockSize;
    protected $Aes;
    /**
     * Constructor which loads the database connection
     */
    public function __construct()
    {
        $this->db = new DBConnection();
        $this->data = array();
        $this->status = true;
        $this->blockSize = 128;
        $this->connection = $this->db->DBConnect();
        if(!$this->connection)
        {
            $this->status = false;
            array_push($this->data, ["Status"=>"error", "Message" => mysqli_error($this->connection)]);
        }
    }

    /**
     * Update the user states
     * @param $countryId
     * @param $cityId
     * @return array
     */
    public function updateUserState($countryId, $cityId)
    {
        if($this->status)
        {
           if($this->updateStates($countryId, $cityId))
           {
               array_push($this->data, [ "Status"=>"ok"]);
           }
           else
           {
              return $this->data;
           }
        }
        else
        {
            array_push($this->data, [ "Status"=>"Error", "Message"=>"Database connection error"]);
        }
        return $this->data;
    }

    /**
     * update the state property of the current logged in user
     * @param $countryId
     * @param $cityId
     * @return bool
     */
    private function updateStates($countryId, $cityId)
    {
        //start the session
        if(!session_start())
        {
            session_start();
        }
        if(!isset($_SESSION['id']) || !empty($_SESSION['id']))
        {
            $userId = $_SESSION['id'];
            $userId = $this->decryptField($userId);
            $this->query = "SELECT state.stateid FROM state WHERE state.countryid = $countryId and state.cityid = $cityId";
            $this->result = $this->db->Select($this->query);
            if($this->result && mysqli_num_rows($this->result) > 0)
            {
                $row = mysqli_fetch_assoc($this->result);
                $stateId = $row['stateId'];
                $this->query = "UPDATE profile SET stateId = $stateId WHERE UserID = $userId";
                $this->result = $this->db->Select($this->query);
                if($this->result)
                {
                    return true;
                }
                else
                {
                    array_push($this->data, ["Status"=>"error", "Message"=>" error occurred during transaction"]);
                }
            }
            else
            {
                array_push($this->data, ["Status"=>"error", "Message"=>"transaction error occurred"]);
            }
        }
        else
        {
            array_push($this->data, ["Status"=>"error", "Message"=>"authorization error occurred"]);
        }
        return false;
    }

    /**
     * Update the cell attribute of the user
     * @param $cell
     * @return bool
     */
    public function updateUserCell($cell, $userId)
    {
        if($this->status)
        {
           $userId = $this->decryptField($userId);
           $this->query = "UPDATE profile SET phone = '$cell' WHERE profile.UserID = $userId";
           $this->result = $this->db->Select($this->query);
           if($this->result)
           {
               array_push($this->data, [ "Status"=>"ok"]);
           }
           else
           {
               array_push($this->data, [ "Status"=>"Error", "Message"=>" error occurred during updating fields"]);
           }
        }
        else
        {
            array_push($this->data, [ "Status"=>"Error", "Message"=>"Database connection error"]);
        }
        return $this->status;
    }

    /**
     * fetch the given user state information along with its state and city
     * @param $userId
     * @return array
     */
    public function getUserCountry($userId)
    {
        if($this->status)
        {
             if(!$this->fetchUserCountry($userId))
             {
                 array_push($this->data, ["Status"=>"error", "Message"=>"Error occurred while getting information"]);
             }
        }
        else
        {
            array_push($this->data, ["Status"=>"error", "Message"=>"Error occurred while database connection"]);
        }
        return $this->data;
    }

    /**
     * fetch the user states information
     * @param $userId
     * @return bool
     */
    private function fetchUserCountry($userId)
    {
        $this->query = "SELECT stateId FROM profile WHERE UserID = ".$userId;
        $this->result = $this->db->Select($this->query);
        if($this->result && mysqli_num_rows($this->result) > 0)
        {
            $this->result = mysqli_fetch_assoc($this->result);
            $stateID      = $this->result['stateId'];
            $this->query  = "SELECT * FROM state WHERE stateid = ".$stateID;
            $this->result = $this->db->Select($this->query);
            if($this->result && mysqli_num_rows($this->result) > 0)
            {
                array_push($this->data, ["Status"=>"ok"]);
                $row = mysqli_fetch_assoc($this->result);
                array_push($this->data, [
                                           "StateId"   =>  $row['stateid'],
                                           "CountryId" =>  $row['countryid'],
                                           "CityId"    =>  $row['cityid']
                                        ]);
                return true;
            }
        }
        return false;
    }

    /**
     * This method is used for fetching all the countries with codes
     *  USAGE OF SWITCH
     *  TRUE- will return countries names only
     *  FALSE- will return countries codes only
     * @param $switch - boolean
     * @return mixed
     */
    public function getCountries($switch)
    {
        if($this->status)
        {
           $this->query = "SELECT * FROM country";
           $this->result = $this->db->Select($this->query);
           if($this->result && mysqli_num_rows($this->result) > 0)
           {
               array_push($this->data, ["Status"=>"ok"]);
               while(($row = mysqli_fetch_assoc($this->result))!=false)
               {
                     if($switch)
                     {
                        array_push($this->data, [ "id"=>$row['countryid'],  "name"=>$row['name'] ]);
                     }
                   else
                   {
                       array_push($this->data, [ "id"=>$row['countryid'], "name"=>$row['code'] ]);
                   }
               }
              return $this->data;
           }
           else
           {
              array_push($this->data, [ "Status"=>"Error", "Message"=>mysqli_error($this->connection)  ]);
              return $this->data;
           }
        }
        else
        {
            return $this->data;
        }
    }

    /**
     * retrieve the required states provided by the given country
     * @param $country
     * @return array
     */
    public function getStates($country)
    {
        if($this->status)
        {
            $this->query = "SELECT cityId from state WHERE countryId = ".$country;
            $this->result = $this->db->Select($this->query);
            if($this->result)
            {
                $temp = array();
                array_push($this->data, ["Status"=>"ok"]);
                if(mysqli_num_rows($this->result) > 0)
                {
                    while(($row = mysqli_fetch_assoc($this->result)) != false)
                    {
                        $temp[] = $row['cityId'];
                    }
                    $this->retrieveStates($temp, $this->db);
                    return $this->data;
                }
                else
                {
                    return $this->data;
                }

            }
            else
            {
                array_push($this->data, [ "Status"=>"Error", "Message"=>mysqli_error($this->connection)  ]);
                return $this->data;
            }

        }
        else
        {
            array_push($this->data, [ "Status"=>"Error", "Message"=>mysqli_error($this->connection)  ]);
            return $this->data;
        }
    }


    /**
     * private function to loop through city tables and fetch names along with their ids
     * @param $temp
     * @param $db
     * @return array
     */
    private function retrieveStates($temp, $db)
    {
        $query = "SELECT * FROM city WHERE cityId = ";
        for($i=0; $i<count($temp); $i++)
        {
            $this->query = $query . $temp[$i];
            $this->result = $db->Select($this->query);
            if($this->result)
            {
                while(($row = mysqli_fetch_assoc($this->result)) != false)
                {
                    array_push($this->data, [
                            "id"=>$row['cityid'], "name"=>$row['name']
                        ]
                    );
                }
            }
            else
            {
                array_push($this->data, [ "Status"=>"Error", "Message"=>mysqli_error($this->connection)  ]);
                break;
            }
        }
        return $this->data;

    }

    /**
     * decrypt the current field
     * @param $field
     * @return string
     * @throws Exception
     */
    private function decryptField($field)
    {
       $this->Aes = new AES($field, $this->blockSize);
       $this->Aes->setData($field);
       $encrypted = $this->Aes->decrypt();
       return $encrypted;
    }
}