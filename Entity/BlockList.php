<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/30/2015
 * Time: 11:32 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Entity/User.php');

class BlockList {

    protected $db;
    protected $status;
    protected $data;
    protected $connection;
    protected $query;
    protected $result;
    protected $user;
    protected $userId;

    private $temp;

    public function __construct()
    {
        $this->temp = array();
        $this->data = array();
        $this->user = new User();
        $this->db = $this->user->getDb();
        $this->status = $this->user->getStatus();
    }

    /**
     * Block the person which is annoying
     * @param $partnerId
     * @param $reason
     * @return array
     */
    public function addToBlockList($partnerId, $reason)
    {
        if($this->status)
        {
            $this->userId = $this->user->forceGetUserId();
            $this->userId = $this->user->decryptField($this->userId);
            $partnerId    = $this->user->decryptField($partnerId);
            if($this->blockMember($this->userId,$partnerId,$reason))
            {
                array_push($this->data, ["Status"=>"ok"]);
            }
            else
            {
                array_push($this->data, ["Status"=>"error", "Message"=>"Error occurred during banning user"]);
            }
        }
        else
        {
            array_push($this->data, ["Status"=>"error", "Message"=>"Connection error"]);
        }
        return $this->data;
    }

    /**
     * Helping method for blocking user
     * @param $userId
     * @param $partnerId
     * @param $reason
     * @return bool
     */
    private function blockMember($userId, $partnerId, $reason)
    {
        $this->userId = $this->user->decryptField($userId);
        $partnerId    = $this->user->decryptField($partnerId);
        $date = date('Y-m-d H:m:s');
        $this->query = "INSERT INTO block ( blockeduser, reason, createdAt) VALUES ( '$partnerId', '$reason' , '$date')";
        $this->result = $this->db->Select($this->query);
        if($this->result)
        {
           $this->query = "SELECT MAX(detailsId) AS details FROM block";
           $this->result = $this->db->Select($this->query);
           if($this->result && mysqli_num_rows($this->result) > 0)
           {
               $row = mysqli_fetch_assoc($this->result);
               $id  = $row['details'];
               $this->query = "INSERT INTO blocklist( UserID, detailsId) VALUES ( $userId, $id)";
               $this->result = $this->db->Select($this->query);
               if($this->result)
               {
                   return true;
               }
           }
        }
        return false;
    }

    /**
     * Remove the user from the block list
     * @param $partnerId
     * @return array
     */
    public function removeBlock($partnerId)
    {
        if($this->status)
        {
            $this->userId = $this->user->forceGetUserId();
            $this->query = "SELECT blocklist.detailsId FROM block,blocklist WHERE blocklist.UserID =$userId and block.blockeduser = $partnerId";
            $this->result = $this->db->Select($this->query);
            if($this->result && mysqli_num_rows($this->result) > 0)
            {
                $row = mysqli_fetch_assoc($this->result);
                $id  = $row['detailsId'];
                $this->query = "DELETE FROM block WHERE block.detailsId = $id";
                $this->result = $this->db->Select($this->query);
                if($this->result)
                {
                    $this->query = "DELETE FROM blocklist WHERE blocklist.detailsId = $id";
                    $this->result = $this->db->Select($this->query);
                    if($this->result)
                    {
                        array_push($this->data, ["Status"=>"ok"]);
                    }
                    else
                    {
                        array_push($this->data, ["Status"=>"error", "Message"=>"Error occurred during deleting inner ban"]);
                    }
                }
                else
                {
                    array_push($this->data, ["Status"=>"error", "Message"=>"Error occurred during deleting ban"]);
                }
            }
            else
            {
                array_push($this->data, ["Status"=>"error", "Message"=>"Error occurred during removing ban"]);
            }
        }
        else
        {
            array_push($this->data, ["Status"=>"error", "Message"=>"Connection error"]);
        }
        return $this->data;
    }

    /**
     * Get the list of ban users
     * @return array
     */
    public function getBlockList()
    {
        if($this->status)
        {
            $this->userId = $this->user->forceGetUserId();
            if($this->getBlockedUserDetails($this->userId))
            {
               if($this->getBlockUserInformation($this->temp))
               {

               }
            }
        }
        else
        {
            array_push($this->data, ["Status"=>"error", "Message"=>"Connection error"]);
        }
        return $this->data;
    }

    private function getBlockedUserDetails($userId)
    {
        $id = $this->user->decryptField($userId);
        $this->query = "SELECT blocklist.detailsId FROM blocklist WHERE blocklist.UserID = $id";
        $this->result = $this->db->Select($this->query);
        if($this->result)
        {
            if(mysqli_num_rows($this->result) > 0)
            {
                while(($row = mysqli_fetch_assoc($this->result)) != false)
                {
                    $details = $row['detailsId'];
                    $this->query = "SELECT * FROM block WHERE block.detailsId = $details";
                    $this->result = $this->db->Select($this->query);
                    if($this->result && mysqli_num_rows($this->result) > 0)
                    {
                        $fetch = mysqli_fetch_assoc($this->result);
                        array_push($this->temp, [
                                          "User" => $fetch['blockeduser'], "Reason"=>$fetch['reason'],
                                          "Date" => $fetch['createdAt']
                        ]);

                    }
                    else
                    {
                        array_push($this->data, ["Status"=>"error", "Message"=>"Internal error occurred"]);
                        return false;
                    }
                }
                return true;
            }
            else
            {
                array_push($this->data, ["Status"=>"error", "Message"=>"User has not banned anyone yet"]);
                return false;
            }
        }
        array_push($this->data, ["Status"=>"error", "Message"=>"database query error"]);
        return false;
    }

    private function getBlockUserInformation($array)
    {
        $information = array();
        for($i=0; $i<count($array); $i++)
        {
            $reason = $array[$i]['Reason'];
            $time   = $array[$i]['Date'];
            $id     = $array[$i]['User'];
            $this->query = "SELECT s.UserName, m.image FROM user s,image m WHERE s.UserID = $id and m.UserID = $id  and approved = 1";
            $this->result = $this->db->Select($this->query);
            if($this->result && mysqli_num_rows($this->result) > 0)
            {
                $row   = mysqli_fetch_assoc($this->result);
                $name  = $row['UserName'];
                $image = base64_encode($row['image']);
                array_push($information, [
                                         "User" => $name, "Image"=>$image, "Reason"=>$reason, "Date"=>$time]);
            }
            else
            {
                array_push($this->data, ["Status"=>"error", "Message"=>"error occurred during extracting information"]);
                return false;
            }
        }
        array_push($this->data, ["Status"=> "ok"]);
        array_push($this->data, $information);
        return true;
    }
}