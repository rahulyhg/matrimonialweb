<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/5/2015
 * Time: 9:55 PM
 */


require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Connection/Connection.php');

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

    /**
     * Constructor which loads the database connection
     */
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
}