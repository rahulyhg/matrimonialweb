<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/5/2015
 * Time: 11:07 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Connection/Connection.php');

/**
 *
 */
define("UNIQUE","1");
define("NOT_UNIQUE","0");

class Verifier {

    private $db;
    private $query;
    private $connection;
    private $result;
    private $status;
    private $data;

   public function __construct()
   {
       $this->data = array();
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
     * Checks if username already exists
     * return 1 if username is UNIQUE
     * return 0 if username already exists
     * @param $userName
     * @return mixed
     */
    public function verifyUserName($userName)
    {
        if($this->status)
        {
             $this->query = "SELECT * FROM user WHERE UserName = '$userName'";
             $this->result = $this->db->Select($this->query);
             if($this->result)
             {
                 //now checks for existence
                 $count = mysqli_num_rows($this->result);
                 if($count > 0)
                 {
                     //userName exists
                     array_push($this->data, [ "Status"=>"ok", "verify"=>NOT_UNIQUE ]);
                 }
                 else
                 {
                     //Hooray we have a new user
                     array_push($this->data, [ "Status"=>"ok", "verify"=>UNIQUE ]);
                 }
             }
            else
            {
               array_push($this->data, ["Status"=>"error", "Message"=>mysqli_error($this->connection)]);
            }
        }
        return $this->data;
    }

    /**
     * Checks if email already exists
     * return 1 if username is UNIQUE
     * return 0 if username already exists
     * @param $email
     * @return mixed
     */
    public function verifyEmail($email)
    {
        if($this->status)
        {
            $this->query = "SELECT * FROM user WHERE Email = '$email'";
            $this->result = $this->db->Select($this->query);
            if($this->result)
            {
                //now checks for existence
                $count = mysqli_num_rows($this->result);
                if($count > 0)
                {
                    //userName exists
                    array_push($this->data, [ "Status"=>"ok", "verify"=>NOT_UNIQUE ]);
                }
                else
                {
                    //Hooray we have a new user
                    array_push($this->data, [ "Status"=>"ok", "verify"=>UNIQUE ]);
                }
            }
            else
            {
                array_push($this->data, ["Status"=>"error", "Message"=>mysqli_error($this->connection)]);
            }
        }
        return $this->data;
    }

    /**
     * Checks if phone already exists
     * return 1 if phone is UNIQUE
     * return 0 if phone already exists
     * @param $cell
     * @return array
     */
    public function verifyCell($cell)
    {
        if($this->status)
        {
            $this->query = "SELECT * FROM profile WHERE phone = '$cell'";
            $this->result = $this->db->Select($this->query);
            if($this->result)
            {
                //now checks for existence
                $count = mysqli_num_rows($this->result);
                if($count > 0)
                {
                    //userName exists
                    array_push($this->data, [ "Status"=>"ok", "verify"=>NOT_UNIQUE ]);
                }
                else
                {
                    //Hooray we have a new user
                    array_push($this->data, [ "Status"=>"ok", "verify"=>UNIQUE ]);
                }
            }
            else
            {
                array_push($this->data, ["Status"=>"error", "Message"=>mysqli_error($this->connection)]);
            }
        }
        return $this->data;
    }

}