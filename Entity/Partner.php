<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/11/2015
 * Time: 9:41 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Entity/User.php');

class Partner {

    protected $db;
    protected $status;
    protected $data;
    protected $connection;
    protected $query;
    protected $result;
    protected $user;
    protected $userId;

    private $expressMessagePartners;
    private $chatPartners;
    private $timeStamps;


    public function __construct()
    {
        $this->expressMessagePartners = array();
        $this->chatPartners = array();
        $this->timeStamps = array();
        $this->data = array();
        $this->user = new User();
        $this->db = $this->user->getDb();
        $this->status = $this->user->getStatus();
    }

    /**
     * gets all the partnerList which the user have ever send Express Messages or
     * chat with along with their names and respective images
     * @return array
     */
    public function getAllPartnersList()
    {
        //first of all check DB connection status
        if($this->status)
        {
           //YEAH!! we got a connection.. now let things done... its time to get the userId
            $this->userId  = $this->user->forceGetUserId();
            //decrypt using same algorithm
            $this->userId  = $this->user->decryptField($this->userId);
            if($this->getExpressMessagePartners($this->userId, 'express') && $this->getexpressMessagePartners($this->userId, 'chat'))
            {
               //now we got the partnersLists of both the express and chat
               //first check if the user have ever contacted anyone through express messages
               $this->arrangeData();
            }
            else
            {
                array_push($this->data, ["Status"=>"error", "Message" => "Error occurred during Express Messages partner list " ]);
            }

        }
        else
        {   //oh gosh!! we lost it... must retreat now :(
            array_push($this->data, ["Status"=>"error", "Message" => "DB connection error" ]);
        }
        return $this->data;
    }

    /**
     * Get the list of all the partners List along with their userName,Image which the user have
     * send express messages
     * @param $userId
     * @param $switch:   express | chat
     * @return bool
     */
    private function getExpressMessagePartners($userId, $switch)
    {
        switch($switch)
        {
            case 'express':
                $this->query = "SELECT d.to FROM details d  WHERE d.from = $userId";
                break;
            case 'chat':
                $this->query = "SELECT d.to FROM chatdetails d  WHERE d.from = $userId";
                break;
        }
        $this->result = $this->db->Select($this->query);
        if($this->result)
        {
            $temp = array();
            if(mysqli_num_rows($this->result) > 0)
            {
                while(($row = mysqli_fetch_assoc($this->result)) != false)
                {
                   $partnerId = $row['to']; // gets the Partner Identification
                   //get the partner userName as well its profile picture
                   $this->query = "SELECT s.UserName, m.image FROM user s,image m WHERE s.UserID = $partnerId and m.UserID = $partnerId  and approved = 1";
                   $this->result = $this->db->Select($this->query);
                   if($this->result)
                   {
                      $row = mysqli_fetch_assoc($this->result);
                      $userName = $row['UserName'];
                      $image    = base64_encode($row['image']);
                      array_push($temp, [ "PartnerId"=>$this->user->encryptId($partnerId), "UserName"=>$userName, "Image"=>$image]);
                   }
                   else {return false;}
                }
            }
            else
            {
                //looks like user has not meet someone yet!!!
                if($switch == 'express'){
                    array_push($this->expressMessagePartners, ["Status"=>"ok"]);
                }
                else{
                    array_push($this->chatPartners, ["Status"=>"ok"]);
                }
            }
            //store the array according to the user passes '$switch' argument
            if($switch == 'express' && count($temp) > 0){
                array_push($this->expressMessagePartners, ["Status"=>"ok"]);
                array_push($this->expressMessagePartners, $temp);
            }
            elseif($switch == 'chat' && count($temp) > 0){
                array_push($this->chatPartners, ["Status"=>"ok"]);
                array_push($this->chatPartners, $temp);
            }
            return true;
        }
        return false;
    }

    /**
     * arrange the both arrays and eliminate duplicity with both the arrays
     */
    private function arrangeData()
    {
      //check for express messages
       if(count($this->expressMessagePartners) > 1)
      {
          array_push($this->data,$this->expressMessagePartners);
      }
      //check if user has initiated chat with anyone
      if(count($this->chatPartners) > 1 )
      {
          array_push($this->data,$this->chatPartners);
      }
      //if both the arrays contains data arrange them to avoid duplication
      if(count($this->expressMessagePartners) > 2 && count($this->chatPartners) > 2)
      {
          //iterate both the results to avoid duplication
          for($i=1; $i< count($this->expressMessagePartners); $i++) {

              $value = $this->expressMessagePartners[$i]['PartnerId'];
              for($j=1; $j<count($this->chatPartners); $j++) {

                  if($value == $this->chatPartners[$j]['PartnerId']) {
                  }
                  //get the length of the array and check if the value does not match till end
                  elseif( $i == (count($this->chatPartners) -1) && $value != $this->chatPartners[$j]['PartnerId'])
                  {
                      array_push($this->data,$this->chatPartners[$j]);
                  }
              }
          }
      }
    }
}