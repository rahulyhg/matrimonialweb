<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/24/2015
 * Time: 8:16 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Entity/User.php');

class Age {

    protected $db;
    protected $status;
    protected $data;
    protected $connection;
    protected $query;
    protected $result;
    protected $user;
    protected $userId;

    private $age;

    public function __construct()
    {
        $this->userChat = array();
        $this->partnerChat = array();
        $this->timeStamps = array();
        $this->data = array();
        $this->user = new User();
        $this->db = $this->user->getDb();
        $this->status = $this->user->getStatus();
    }

    /**
     * get the age property
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * get the user age
     * @return bool
     */
    public function getUserAge()
    {
        if($this->status)
        {
           if($this->FetchUserAge())
           {
               return true;
           }
        }
        return false;
    }

    /**
     * Update the current User age
     * @param $userId
     * @param $age
     * @return array
     */
    public function updateAge($userId, $age)
    {
       if($this->status)
       {
           $this->query = "UPDATE profile SET age = $age WHERE UserID =  ".$userId;
           $this->result = $this->db->Select($this->query);
           if($this->result)
           {
               array_push($this->data, ["Status"=>"ok"]);
               return $this->data;
           }
       }
       array_push($this->data,["Status"=>"error", "Message"=>"Error occurred while updating field"]);
        return $this->data;
    }

    /**
     * fetch the required user age
     * @return bool
     */
    private function FetchUserAge()
    {
        $this->userId = $this->user->forceGetUserId();
        $this->userId = $this->user->decryptField($this->userId);
        $this->query  = "SELECT  age FROM profile WHERE UserID = ".$this->userId;
        $this->result = $this->db->Select($this->query);
        if($this->result && mysqli_num_rows($this->result) > 0)
        {
            $this->result = mysqli_fetch_assoc($this->result);
            $this->age = $this->result['age'];
            return true;
        }
        return false;
    }



}