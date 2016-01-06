<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/13/2015
 * Time: 12:48 AM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Connection/Connection.php');
require_once($_SERVER['DOCUMENT_ROOT']. '/matrimonialweb/Entity/AES.php');


class Membership {

    protected $db;
    protected $status;
    protected $data;
    protected $connection;
    protected $query;
    protected $result;
    private $premiumMembers;
    private $typeId;
    protected $Aes;
    protected $blockSize;

    public function __construct()
    {
        $this->blockSize = 128;
        $this->status = true;
        $this->premiumMembers = array();
        $this->data           = array();
        $this->db             = new DBConnection();
        $this->connection     = $this->db->DBConnect();
        $this->result         = $this->connection;
        if(!$this->result){
            $this->status = false;
        }
    }

    public function UpgradeMembership($userId)
    {

    }

    /**
     * Detect the user MemberShip Type
     * @return array
     */
    public function getUserMemberShip()
    {
        if($this->status)
        {
             if($this->getMembership())
             {
                 return $this->data;
             }
        }
        else
        {
            array_push($this->data, ["Status"=>"error", "Message"=>"Connection error occurred"]);
        }
        return $this->data;
    }

    private function getMembership()
    {
        if(!session_start())
        {
            session_start();
        }
        if(!isset($_SESSION['id']) || !empty($_SESSION['id']))
        {
            $id = $_SESSION['id'];
            $id = $this->decryptField($id);
            $this->query = "SELECT typeId FROM usermembership WHERE UserID = $id";
            $this->result = $this->db->Select($this->query);
            if($this->result && $this->getPremiumType())
            {
                $row = mysqli_fetch_assoc($this->result);
                $userType = $row['typeId'];
                if($userType == $this->typeId)
                {
                    //user is premium
                    array_push($this->data, ["Status"=>"ok", "Membership"=>"Premium"]);
                    return true;
                }
                else
                {
                    //user is free member
                    array_push($this->data, ["Status"=>"ok", "Membership"=>"Free"]);
                    return true;
                }
            }
            else
            {
                array_push($this->data, ["Status"=>"error", "Message"=>"error occurred during transaction"]);
            }
        }
        else
        {
            array_push($this->data, ["Status"=>"error", "Message"=>"Authorization error occurred"]);
        }
        return false;
    }

    /**
     * get the list of all the premium members
     *along with their username and their images
     * @return array
     */
    public function premiumMembersList()
    {
        //check db connection
        if($this->status)
        {
            // we got a connection.. now get the premium id
            if($this->getPremiumType())
            {
                //id retrieve.. extract the user identification
                if($this->getPremiumUsers($this->typeId) && count($this->data) > 1)
                {
                    //its time to crack some user information
                    //get user name and its image
                    $this->extractUserInformation();
                    //echo print_r($this->data). '<br/>';
                }
            }
        }
        else
        {
            // some error occur during db connection
            array_push($this->data, ["Status"=>"error", "Message"=>"Database connection error"]);
        }
        return $this->data;
    }

    /**
     * get the premium Type id
     * @return bool
     */
    private function getPremiumType()
    {
        $this->query  = "SELECT typeId FROM membership WHERE type = 'Premium'";
        $this->result = $this->db->Select($this->query);
        if($this->result && mysqli_num_rows($this->result) > 0)
        {
            $row = mysqli_fetch_assoc($this->result);
            $this->typeId = $row['typeId'];
            return true;
        }
        array_push($this->data, ["Status"=>"error", "Message"=>"Error occurred during membership type transaction"]);
        return false;
    }

    /**
     * extracts all the user identification from the given type Id
     * @param $id
     * @return bool
     */
    private function getPremiumUsers($id)
    {
        $this->query = "SELECT UserID FROM usermembership WHERE typeId = $id ";
        $this->result = $this->db->Select($this->query);
        if($this->result)
        {
            if(mysqli_num_rows($this->result) > 0)
            {
                //we have some premium members
                //extract them
                array_push($this->data, ["Status"=>"ok"]);
                while(($row = mysqli_fetch_assoc($this->result)) != false)
                {
                    array_push($this->data, [
                                              "userId" => $row['UserID']
                                            ]);
                }
            }
            else
            {
                array_push($this->data, ["Status"=>"ok"]);
            }
            return true;
        }
        else
        {
            array_push($this->data, ["Status"=>"error", "Message"=>"Error occurred during membership type transaction"]);
        }
        return false;
    }

    /**
     * extract user name image from the given user identification
     * @return bool
     */
    private function extractUserInformation()
    {
        $information = array();
        $temp = $this->data;
        unset($this->data);
        for($i=1; $i< count($temp); $i++)
        {
            $id = $temp[$i]['userId'];
            $this->query = "SELECT s.UserName, m.image FROM user s,image m WHERE s.UserID = $id and m.UserID = $id  and approved = 1";
            $this->result = $this->db->Select($this->query);
            if($this->result)
            {
                $row = mysqli_fetch_assoc($this->result);
                array_push($information, [
                                            "userName" => $row['UserName'],
                                            "image"    => base64_encode($row['image'])
                                         ]);
                if($i == count($temp) -1)
                {
                    $this->data = array();
                    array_push($this->data, ["Status" => "ok"]);
                    array_push($this->data, $information);
                    return true;
                }
            }
            else
            {
                unset($this->data);
                $this->data = array();
                array_push($this->data, ["Status"=>"error", "Message"=>"Error occurred during extracting user information"]);
                return false;
            }
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