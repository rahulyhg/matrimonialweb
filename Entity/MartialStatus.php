<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/6/2015
 * Time: 2:25 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Connection/Connection.php');
require_once($_SERVER['DOCUMENT_ROOT']. '/matrimonialweb/Entity/AES.php');

class MartialStatus {

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
     * update the user martial status
     * @param $martialStatus
     * @return array
     */
    public function updateUserMartialStatus($martialStatus)
    {
       if($this->status)
       {
           if($this->updateStatus($martialStatus))
           {
               array_push($this->data, ["Status"=>"ok"]);
           }
           else
           {
               return $this->data;
           }
       }
       else
       {
           array_push($this->data, ["Status"=>"error", "Message"=>"connection error occurred"]);
       }
       return $this->data;
    }

    /**
     * assist in updating martial status of the current logged in user
     * @param $martialStatus
     * @return bool
     */
    private function updateStatus($martialStatus)
    {
        if(!session_start())
        {
            session_start();
        }
        if(!isset($_SESSION['id']) || !empty($_SESSION['id']))
        {
            $id = $_SESSION['id'];
            $id = $this->decryptField($id);
            $this->query = "UPDATE profile SET martialId = $martialStatus WHERE UserID = $id";
            $this->result = $this->db->Select($this->query);
            if($this->result)
            {
                return true;
            }
            else
            {
                array_push($this->data, ["Status"=>"error", "Message"=>" problem occurred during updation"]);
            }
        }
        else
        {
            array_push($this->data, ["Status"=>"error", "Message"=>"authorization problem occurred"]);
        }
        return false;
    }

    /**
     * GEts the user Martial status
     * @param $userId
     * @return array
     */
    public function getUerMartialStatus($userId)
    {
        if($this->status)
        {
            $this->query = "SELECT profile.martialId FROM profile WHERE profile.UserID = $userId";
            $this->result= $this->db->Select($this->query);
            if($this->result && mysqli_num_rows($this->result) > 0)
            {
                $row = mysqli_fetch_assoc($this->result);
                $martialId = $row['martialId'];
                $this->query = "SELECT martial.type FROM martial WHERE martialid = ".$martialId;
                $this->result= $this->db->Select($this->query);
                if($this->result && mysqli_num_rows($this->result) > 0)
                {
                    array_push($this->data, ["Status"=>"ok"]);
                    $row = mysqli_fetch_assoc($this->result);
                    $type = $row['type'];
                    array_push($this->data, ["Martial" => $type]);
                }
                else
                {
                    array_push($this->data, ["Status"=>"error", "Message" => "Invalid transaction occur during getting martial status"]);
                }
            }
            else
            {
                array_push($this->data, ["Status"=>"error", "Message" => "Invalid transaction"]);
            }
        }
        return $this->data;
    }

    /**
     * fetch all the martial statuses
     * @return array
     */
    public function getAllStatus()
    {
        if($this->status)
        {
            $this->query = "SELECT * FROM martial";
            $this->result = $this->db->Select($this->query);
            if($this->result && mysqli_num_rows($this->result) > 0)
            {
                array_push($this->data, ["Status"=>"ok"]);
                while(($row = mysqli_fetch_assoc($this->result))!=false)
                {
                    array_push($this->data, [ "id"=>$row['martialid'],  "name"=>$row['type'] ]);
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