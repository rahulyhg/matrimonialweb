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
     * Gets the list of user Notifications
     * sort the notifications by the element of dateTime and seen
     * @return array
     */
    public function getNotifications()
    {
        if($this->status)
        {
           $this->query = "";
           $this->result = $this->db->Select($this->query);
           if($this->result && mysqli_num_rows($this->result) > 0)
           {
               while(($row = mysqli_fetch_assoc($this->result)) != false)
               {

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