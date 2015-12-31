<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/9/2015
 * Time: 11:01 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Entity/User.php');

class Chat {

    protected $db;
    protected $status;
    protected $data;
    protected $connection;
    protected $query;
    protected $result;
    protected $user;
    protected $userId;

    private $to;
    private $message;
    private $dateTime;
    private $timeStamps;
    private $userChat;
    private $partnerChat;

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
     * add the current chat message to the database
     * @param $to : The partner Id
     * @param $message : chat content (String)
     * @return array   : Status informing error or success
     */
    public function addMessage($to, $message)
    {
        if($this->user->getStatus())
        {
            $this->to = $this->user->decryptField($to);
            $this->message = $message;
            $this->dateTime  = date('Y-m-d h:m:s');
            //Gets the encrypted Id
            $this->userId  = $this->user->forceGetUserId();
            //decrypt using same algorithm
            $this->userId  = $this->user->decryptField($this->userId);
            //Now add some chat
            if($this->insertChat($this->userId, $this->to, $this->message, $this->dateTime))
            {
                array_push($this->data, ["Status"=>"ok"]);
            }
        }
        else
        {
            array_push($this->data, ["Status"=>"error", "Message"=>"Database connection occurred"]);
        }
        return $this->data;
    }

    /**
     * private function which stores the chat and then maps it into the data sets
     * @param $from : id of the message sending user
     * @param $to   : the recipient
     * @param $message : message content
     * @param $date: current Time stamp
     * @return bool
     */
    private function insertChat($from, $to, $message, $date)
    {
        //Insert it in the main chat table

        $this->query = "INSERT INTO chatdetails( chatdetails.from, chatdetails.to, message, createdAt)
                        VALUES
                        ( $from, $to, '$message', '$date')";
        $this->result = $this->db->Select($this->query);
        if($this->result)
        {
            //now its time to get eh stored Id
            $this->query = "SELECT * FROM chatdetails WHERE createdAt = '$date'";
            $this->result = $this->db->Select($this->query);
            if($this->result && mysqli_num_rows($this->result) > 0)
            {
                $id = mysqli_fetch_assoc($this->result);
                $id = $id['chatdetailsId'];
                $this->query = "INSERT INTO chat( chatdetailId, UserID) VALUES ( $id , $from)";
                $this->result = $this->db->Select($this->query);
                if($this->result)
                {
                    return true;
                }
                array_push($this->data, ["Status"=>"error", "Message" => "Unable to map message \n". mysqli_error($this->db->getConnection()) ]);
                return false;
            }
            array_push($this->data, ["Status"=>"error", "Message" => "Unable to store message \n". mysqli_error($this->db->getConnection()) ]);
            return false;
        }
        array_push($this->data, ["Status"=>"error", "Message" => "Unable to store message" ]);
        return false;
    }

    /**
     * Gets the sorted chat messages of user and its partner
     * @param $partner : PartnerId
     * @return array   : Messages list or error
     */
    public function getChatMessages($partner)
    {
        if($this->user->getStatus())
        {
            //Gets the encrypted Id
            $this->userId  = $this->user->forceGetUserId();
            //decrypt using same algorithm
            $this->userId  = $this->user->decryptField($this->userId);
            $partner       = $this->user->decryptField($partner);
            //transact both user and partner chat messages
            if($this->getMessages($this->userId, $partner, 'user') && $this->getMessages($this->userId, $partner ,'partner'))
            {
                //$this->timeStamps = $this->quickSort($this->timeStamps);
                $temp = $this->userChat;                              //store the contents in temp array
                $temp =   array_merge($temp, $this->partnerChat);     //merge both user and partner arrays into temp array
                array_multisort($this->timeStamps, SORT_ASC, $temp);  //sort the array by timeStamps
                array_push($this->data, ["Status"=>"ok"]);            //define status
                array_push($this->data, $temp);                       //move the sorted array into the final array
            }
            else
            {
                array_push($this->data, ["Status"=>"error", "Message"=>"Error occurred during chat transactions"]);
            }
        }
        else
        {
            array_push($this->data, ["Status"=>"error", "Message"=>"Database connection occurred"]);
        }
        return $this->data;
    }

    /**
     * Gets the messages depending upon the argument and convert the date time format to linux timestamps
     * the "$switch" argument by providing 'user' value will store the values in 'userChat' array. While
     * by providing 'partner' will store in the 'partnerChat' array
     * @param $user    : UserId
     * @param $partner : PartnerID
     * @param $switch  : used to decide which operation to performed either get user message or
     *                   partner message '$switch' can only accept two types arguments which are
     *                   user | partner
     * @return bool
     */
    private function getMessages( $user ,$partner, $switch)
    {
        switch($switch)
        {
            case 'partner':
              $this->query = "SELECT * FROM chatdetails d WHERE d.to = $user and d.from = $partner";
                break;
            case 'user':
                $this->query = "SELECT * FROM chatdetails d WHERE d.to = $partner and d.from = $user";
                break;
        }
        $this->result = $this->db->Select($this->query);
        if($this->result)
        {
           //check of number of rows effected
           if(mysqli_num_rows($this->result) > 0)
           {
               //Yahoo!! we have reached the source now extract the messages
               while( ($row = mysqli_fetch_assoc($this->result)) != false)
               {
                   //check for the "$switch" to decide which array to store to
                   if($switch == 'user')
                   {
                       //store in the "$userChat" array
                       $date = $row['createdAt']; //gets the dateTime
                       $date = strtotime($date); //Time stamp conversion
                       array_push($this->userChat, [ "id"        => $row['chatdetailsId'],
                                                     "message"   => $row['message'],
                                                     "timeStamp" => $date ,
                                                     "type"      => "user"
                                                   ]
                                  );
                       //store the timestamps
                       $this->timeStamps[] = $date;
                   }
                   else
                   {
                       //store them in the "$partnerChat" array
                       $date = $row['createdAt']; //gets the dateTime
                       $date = strtotime($date); //Time stamp conversion
                       array_push($this->partnerChat, [     "id"        => $row['chatdetailsId'],
                                                            "message"   => $row['message'],
                                                            "timeStamp" => $date ,
                                                            "type"      => "partner"
                                                      ]
                                  );
                       //store the timestamps
                       $this->timeStamps[] = $date;
                   }
               }
               return true;
           }
           else
           {
               //User has not initiated chat with this user yet!!!
               return true;
           }
        }
        array_push($this->data, ["Status"=>"error", "Message" => "Unable to fetch User chat \n". mysqli_error($this->db->getConnection()) ]);
        return false;
    }

    /**
     * apply quick sort to sort timeStamps
     * @param $array : array which is to to sort
     * @return array : sortedArray
     */
    private function quickSort($array) {
        if(count($array) < 2) return $array;

        $left = $right = array();

        reset($array);
        $pivot_key = key($array);
        $pivot = array_shift($array);

        foreach($array as $k => $v) {
            if($v < $pivot)
                $left[$k] = $v;
            else
                $right[$k] = $v;
        }

        return array_merge($this->quickSort($left), array($pivot_key => $pivot), $this->quickSort($right));
    }
}