<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/6/2015
 * Time: 10:22 AM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Connection/Connection.php');

class Religion {

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
    public function getUserReligion($userId)
    {
        if($this->status)
        {
            if(!$this->fetchUserReligion($userId))
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
    private function fetchUserReligion($userId)
    {
        $this->query = "SELECT religionId FROM profile WHERE UserID = ".$userId;
        $this->result = $this->db->Select($this->query);
        if($this->result && mysqli_num_rows($this->result) > 0)
        {
            $this->result = mysqli_fetch_assoc($this->result);
            $religionId   = $this->result['religionId'];
            $this->query  = "SELECT * FROM religionsect WHERE religionsectId = ".$religionId;
            $this->result = $this->db->Select($this->query);
            if($this->result && mysqli_num_rows($this->result) > 0)
            {
                array_push($this->data, ["Status"=>"ok"]);
                $row = mysqli_fetch_assoc($this->result);
                array_push($this->data, [
                    "Id"         =>  $row['religionsectId'],
                    "ReligionId" =>  $row['religionId'],
                    "SectId"     =>  $row['sectId']
                ]);
                return true;
            }
        }
        return false;
    }


    /**
     * gets all the religions
     * @return array
     */
    public function getReligions()
    {

        if($this->status)
        {
            $this->query = "SELECT * FROM religion";
            $this->result = $this->db->Select($this->query);
            if($this->result && mysqli_num_rows($this->result) > 0)
            {
                array_push($this->data, ["Status"=>"ok"]);
                while(($row = mysqli_fetch_assoc($this->result))!=false)
                {
                   array_push($this->data, [ "id"=>$row['religionId'],  "name"=>$row['type'] ]);
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
     * Gets the sects of the specific provided religion
     * @param $religionId
     * @return array
     */
    public function getSects($religionId)
    {
        if($this->status)
        {
           $this->query = "SELECT sectId from religionsect WHERE religionId = ".$religionId;
           $this->result = $this->db->Select($this->query);
           if($this->result)
           {
               $temp = array();
               array_push($this->data, ["Status"=>"ok"]);
               if(mysqli_num_rows($this->result) > 0)
               {
                   while(($row = mysqli_fetch_assoc($this->result)) != false)
                   {
                       $temp[] = $row['sectId'];
                   }
                   $this->retrieveSects($temp, $this->db);
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
     * gets the relative religion sects
     * @param $temp
     * @param $db
     * @return array
     */
    private function retrieveSects($temp, $db)
    {
       $query = "SELECT * FROM sect WHERE sectId = ";
       for($i=0; $i<count($temp); $i++)
       {
           $this->query = $query . $temp[$i];
           $this->result = $db->Select($this->query);
           if($this->result)
           {
               while(($row = mysqli_fetch_assoc($this->result)) != false)
               {
                   array_push($this->data, [
                                             "id"=>$row['sectId'], "name"=>$row['type']
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