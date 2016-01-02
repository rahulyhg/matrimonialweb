<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/31/2015
 * Time: 5:20 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Entity/User.php');

class Notification {

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
     * Create the new notification for the user
     * @param $message
     * @param $userId
     * @return array
     */
    public function pushNotification($message,$userId)
    {
        if($this->status)
        {
            $id           = $userId;
            $date         = date('Y-m-d H:m:s');
            $this->query = "INSERT INTO notification (UserID, seen, CreatedAt, message) VALUES ( $id, 0, '$date', '$message')";
            $this->result = $this->db->Select($this->query);
            if($this->result)
            {
                array_push($this->data, ["Status"=>"ok"]);
            }
            else
            {
                array_push($this->data, ["Status"=>"error", "Message"=>"Error occurred during pushing notification"]);
            }
        }
        else
        {
            array_push($this->data, ["Status"=>"error", "Message"=>"Error occurred during connection"]);
        }
        return $this->data;
    }

    /**
     * user has seen the notification
     * set the attribute to seen...
     * @param $notificationId
     * @return array
     */
    public  function seenNotification($notificationId)
    {
        if($this->status)
        {
            $this->userId = $this->user->forceGetUserId();
            $this->userId = $this->user->decryptField($this->userId);
            $this->query = "UPDATE notification SET notification.seen = 1  WHERE Notificationid = $notificationId and  UserID = ".$this->userId;
            $this->result = $this->db->Select($this->query);
            if($this->result)
            {
                array_push($this->data, ["Status"=>"ok"]);
            }
            else
            {
                array_push($this->data, ["Status"=>"error", "Message"=>"Error occurred during updating notification status"]);
            }
        }
        else
        {
            array_push($this->data, ["Status"=>"error", "Message"=>"Error occurred during connection"]);
        }
        return $this->data;
    }

    /**
     * Gets the list of user Notifications
     * sort the notifications by the element of dateTime and seen
     * @return array
     */
    public function getNotifications()
    {
        if($this->status)
        {

           $this->userId = $this->user->forceGetUserId();
           $this->userId = $this->user->decryptField($this->userId);
           $this->query = "SELECT notification.message, notification.seen, notification.CreatedAt FROM notification WHERE UserID = ".$this->userId;
           $this->result = $this->db->Select($this->query);
           if($this->result && mysqli_num_rows($this->result) > 0)
           {
               array_push($this->data, ["Status"=>"ok"]);
               while(($row = mysqli_fetch_assoc($this->result)) != false)
               {
                    $message = $row['message'];
                    $seen    = $row['seen'];
                    $time    = $row['CreatedAt'];
                    array_push($this->data,[
                                             "Message" => $message,
                                             "Seen"    => $seen,
                                             "Time"    => $time
                    ]);
               }
               $this->sortNotifications();
           }
           else
           {
               array_push($this->data, ["Status"=>"error", "Message"=>"Error occurred during Fetching notifications"]);
           }
        }
        else
        {
            array_push($this->data, ["Status"=>"error", "Message"=>"Error occurred during connection"]);
        }
        return $this->data;
    }

    /**
     * Sort the notifications based on timeStamps and seen property
     */
    private function sortNotifications()
    {



    }
}