<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/6/2015
 * Time: 2:36 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Connection/Connection.php');

class Family {

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
     * Gets the user Family information which is as follows
     * + family Type (joint, nucleus)
     * + family type (middleClass, higher class etc)
     * @param $userId
     * @return array
     */
    public function getUserFamilyInformation($userId)
    {
        if($this->status)
        {
            $this->query  = "CALL getUserFamilyInformation($userId)";
            $this->result = $this->db->Select($this->query);
            if($this->result && mysqli_num_rows($this->result) > 0)
            {
                $row = mysqli_fetch_assoc($this->result);
                $familyType   = $row['type'];
                $familyStatus = $row['status'];
                array_push($this->data, ["Status"=>"ok"]);
                array_push($this->data, [
                                         "FamilyType"=>$familyType, "FamilyStatus"=>$familyStatus
                                        ]);
            }
            else
            {
                array_push($this->data, ["Status"=>"error", "Message"=>"Unable to fetch family background"]);
            }
        }
        else
        {
            array_push($this->data, ["Status"=>"error", "Message"=>"Unable to connect"]);
        }
        return $this->data;
    }

    /**
     * fetch the given user state information along with its state and city
     * @param $userId
     * @return array
     */
    public function getUserFamilyBackground($userId)
    {
        if($this->status)
        {

            if(!$this->fetchUserFamilyBackground($userId))
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
    private function fetchUserFamilyBackground($userId)
    {
        $this->query = "SELECT familyId FROM profile WHERE UserID = ".$userId;
        $this->result = $this->db->Select($this->query);
        if($this->result && mysqli_num_rows($this->result) > 0)
        {
            $this->result = mysqli_fetch_assoc($this->result);
            $familyId     = $this->result['familyId'];
            $this->query  = "SELECT * FROM family WHERE familyId = ".$familyId;
            $this->result = $this->db->Select($this->query);
            if($this->result && mysqli_num_rows($this->result) > 0)
            {
                array_push($this->data, ["Status"=>"ok"]);
                $row = mysqli_fetch_assoc($this->result);
                array_push($this->data, [
                    "FamilyId"         =>  $row['familyId'],
                    "TypeId"           =>  $row['familytypeid'],
                    "StatusId"         =>  $row['statusid']
                ]);
                return true;
            }
        }
        return false;
    }

    /**
     * gets all the family types
     * @return array
     */
    public function allFamilyTypes()
    {
        if($this->status)
        {
            $this->query = "SELECT * FROM familytype";
            $this->result = $this->db->Select($this->query);
            if($this->result && mysqli_num_rows($this->result) > 0)
            {
                array_push($this->data, ["Status"=>"ok"]);
                while(($row = mysqli_fetch_assoc($this->result))!=false)
                {
                    array_push($this->data, [ "id"=>$row['familytypeid'],  "name"=>$row['type'] ]);
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
            array_push($this->data, [ "Status"=>"Error", "Message"=>mysqli_error($this->connection)  ]);
            return $this->data;
        }
        return $this->data;
    }

    /**
     * gets all the family classes types
     * @return array
     */
    public function allFamilyClass()
    {
        if($this->status)
        {
            $this->query = "SELECT * FROM familystatus";
            $this->result = $this->db->Select($this->query);
            if($this->result && mysqli_num_rows($this->result) > 0)
            {
                array_push($this->data, ["Status"=>"ok"]);
                while(($row = mysqli_fetch_assoc($this->result))!=false)
                {
                    array_push($this->data, [ "id"=>$row['statusid'],  "name"=>$row['type'] ]);
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
            array_push($this->data, [ "Status"=>"Error", "Message"=>mysqli_error($this->connection)  ]);
            return $this->data;
        }
        return $this->data;
    }

}