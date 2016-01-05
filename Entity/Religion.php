<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/6/2015
 * Time: 10:22 AM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Connection/Connection.php');
require_once($_SERVER['DOCUMENT_ROOT']. '/matrimonialweb/Entity/AES.php');


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
    protected $Aes;
    protected $blockSize;
    /**
     * Constructor which loads the database connection
     */
    public function __construct()
    {
        $this->data = array();
        $this->blockSize = 128;
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
     * Update the religion and sect attribute of the current logged in user
     * @param $religionId
     * @param $sectId
     * @return array
     */
    public function updateUserReligion($religionId, $sectId)
    {
        if($this->status)
        {
            if($this->updateReligion($religionId, $sectId))
            {
               array_push($this->data, ['Status'=>'ok']);
            }
        }
        else
        {
            array_push($this->data, ["Status"=>"error", "Message" => "Connection error"]);
        }
        return $this->data;
    }

    /**
     * helping function that will assist in updating record
     * @param $religionId
     * @param $sectId
     * @return bool
     */
    private function updateReligion($religionId, $sectId)
    {
        //start the session
        if(!session_start())
        {
            session_start();
        }
        if(!isset($_SESSION['id']) || !empty($_SESSION['id']))
        {
           $id = $_SESSION['id'];
           $id = $this->decryptField($id);
           $this->query = "SELECT religionsect.religionsectId FROM religionsect WHERE religionId = $religionId AND sectId = $sectId";
           $this->result = $this->db->Select($this->query);
           if($this->result && mysqli_num_rows($this->result) > 0)
           {
               $row = mysqli_fetch_assoc($this->result);
               $key = $row['religionsectId'];
               $this->query = "UPDATE profile SET religionId = $key WHERE UserID = $id";
               $this->result = $this->db->Select($this->query);
               if($this->result )
               {
                  return true;
               }
               else
               {
                   array_push($this->data, ["Status"=>"error", "Message"=>"error occurred during updation"]);
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