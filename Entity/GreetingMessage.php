<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 1/4/2016
 * Time: 5:30 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Entity/User.php');

class GreetingMessage {

    protected $db;
    protected $status;
    protected $data;
    protected $connection;
    protected $query;
    protected $result;
    protected $user;
    protected $userId;

    public function __construct()
    {
        $this->data = array();
        $this->user = new User();
        $this->db = $this->user->getDb();
        $this->status = $this->user->getStatus();
    }

    /**
     * Send the greetings/Salam message to the partner
     * @param $to
     * @param $message
     * @return mixed
     */
    public function sendExpressMessage($to, $message)
    {
        if($this->status)
        {
            if($this->sendMessage($to, $message))
            {
               array_push($this->data, ["Status"=>"ok"]);
            }
        }
        else
        {
            array_push($this->data, ["Status"=>"error", "Message"=>"connection error occurred"]);
        }
        return $this->data;
    }

    private function sendMessage($to, $message)
    {
        $userId = $this->user->forceGetUserId();
        $userId = $this->user->decryptField($userId);
        $to     = $this->user->decryptField($to);
        $data   = date('Y-m-d H:m:s');
        $this->query = "INSERT INTO details ( details.from, details.to, message, CreatedAt) VALUES('$userId', '$to', '$message', '$data')";
        $this->result = $this->db->Select($this->query);
        if($this->result)
        {
            $this->query = "SELECT MAX(detailsId) AS d FROM details";
            $this->result = $this->db->Select($this->query);
            if($this->result && mysqli_num_rows($this->result) > 0)
            {
                $row = mysqli_fetch_assoc($this->result);
                $detailsId = $row['d'];
                $this->query = "INSERT INTO message (detailsId, UserID) VALUES ($detailsId, $userId)";
                $this->result = $this->db->Select($this->query);
                if($this->result)
                {
                    return true;
                }
                else
                {
                    array_push($this->data, ["Status"=>"error", "Message"=>"error occurred during sending message"]);
                }
            }
            else
            {
                array_push($this->data, ["Status"=>"error", "Message"=>"error occurred during transaction"]);
            }
        }
        else
        {
            array_push($this->data, ["Status"=>"error", "Message"=>"error occurred during insertion"]);
        }
        return false;
    }
}