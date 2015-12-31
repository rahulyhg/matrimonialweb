<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/7/2015
 * Time: 10:59 PM
 */

error_reporting(0);

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Connection/Connection.php');
require_once($_SERVER['DOCUMENT_ROOT']. '/matrimonialweb/Entity/AES.php');

class User {

    protected $db;
    protected $status;
    protected $data;
    protected $connection;
    protected $query;
    protected $result;
    protected $Aes;
    protected $blockSize;
    protected $userId;

    /**
     * Constructor which loads the database connection
     */
    public function __construct()
    {
        $this->blockSize = 128;
        $this->data = array();
        $this->status = true;
        $this->db = new DBConnection();
        $this->result = $this->db->DBConnect();
        $this->connection = $this->result;
        if(!$this->result)
        {
            $this->status = false;
            array_push($this->data, ["Status"=>"error", "Message" => mysqli_error($this->connection)]);
        }
    }

    /**
     * returns the DB object
     * @return DBConnection
     */
    public function getDb(){
        return $this->db;
    }

    /**
     * gets the Database connection status
     * @return bool
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Gets the success , data , and error information
     * @return array
     */
    public function getData(){
        return $this->data;
    }

    /**sets the User Id of the user
     * @param $userId : bigint
     */
    private function setUser($userId){
        $this->userId = $userId;
    }

    /**
     * Gets the user Id
     * @return mixed
     */
    public function getUserId(){
        return $this->userId;
    }

    /**
     * Activate user because the user has visited our link
     * @param $userId
     * @return array
     */
    public function activateUserByLink($userId)
    {
        if($this->status)
        {
            $userId = $this->decryptField($userId);
            $this->query = "UPDATE user SET Active = 1 WHERE UserID = ".$userId;
            $this->result = $this->db->Select($this->query);
            if($this->result)
            {
                array_push($this->data, ["Status"=>"ok"]);
            }
            else
            {
                array_push($this->data, ["Status"=>"error", "Message"=>"Error occurred during Activation"]);
            }
        }
        else
        {
            array_push($this->data, ["Status"=>"error", "Message"=>"Error occurred during database connection"]);
        }
        return $this->data;
    }


    /**
     * role is to register a newly user and create credentials.
     * @return bool
     */
    public function createUser()
    {
        // check database connection
        if($this->status)
        {
            //forcefully start session
            if (!session_start()) {
                session_start();
            }
            //check session is valid
            if(!isset($_SESSION['basicInfo']) || empty($_SESSION['basicInfo']))
            {
                //session is not valid
                array_push($this->data, [ "Status"=>"Error", "Message"=>"No values provided"  ]);
            }
            else
            {
                //echo "session checked and ready to register <br/>";
                //Hooray!! got a connection and a session
                //now lets register some user
                if($this->register())
                {
                    //Wow we have a new user
                    session_write_close();
                    return true;
                }
            }
        }
        else
        {
            //Database connection error throw error
            array_push($this->data, [ "Status"=>"Error", "Message"=>mysqli_error($this->connection)  ]);
        }
        //close the session
        session_write_close();
        return false;
    }


    /**
     * Register the user in to the database
     * @return bool
     * @throws Exception
     */
    private function register()
    {
        //gets the values from stored session
        $username = $_SESSION['basicInfo'][1]['Username'];
        $email    = $_SESSION['basicInfo'][1]['Email'];
        $password = $_SESSION['basicInfo'][1]['Password'];
        $date     = date('Y-m-d');
        //encrypt password using AES
        $this->Aes = new AES($password, $this->blockSize);
        //gets the encrypted password
        $password  = $this->Aes->encrypt();
        //echo $password . '<br/>';
        $this->query = "INSERT INTO user( UserName, Email, Password, Active, CreatedAt) VALUES ( '$username' , '$email' , '$password', 0 , '$date' )";
        //echo $this->query . '<br/>';
        $this->result= $this->db->Select($this->query);
        if($this->result)
        {
            $this->query = "SELECT MAX(UserID) as UserId FROM user";
            $this->result = $this->db->Select($this->query);
            if($this->result)
            {
                array_push($this->data, ["Status" => "ok"]);
                $id = mysqli_fetch_assoc($this->result);
                $this->setUser($id['UserId']);
                //user is registered now issue its membership
                if($this->issueMembership($this->getUserId()))
                {
                    //creating encrypted sessions
                    $_SESSION['id']       = $this->encryptPass($this->getUserId());
                    $_SESSION['email']    = $this->encryptPass($email);
                    $_SESSION['userName'] = $this->encryptPass($username);
                    return true;
                }
            }
            else
            {
                array_push($data, ["Status"=>"error", "Message"=>"Internal error occured"]);
                return false;
            }
        }
        else{

            array_push($this->data, [
                                      "Status"=>"error", "Message"=>mysqli_error($this->connection)
            ]);
        }
        return false;
    }

    /**
     * authenticate login
     * @param $username
     * @param $password
     * @return array
     */
    public function login($username, $password)
    {

        if ($this->status)
        {
            $password = $this->encryptPass($password);
            if($this->authenticateCredentials($username, $password, 'name') || $this->authenticateCredentials($username, $password, 'email'))
            {
                array_push($this->data, ["Status"=>"ok", "userId" => $this->forceGetUserId()]);
            }
            else
            {
                array_push($this->data, ["Status"=>"error", "Query"=>$this->query, "Message"=>"Invalid Username/Password"]);
            }
        }
        else {
            array_push($this->data, ["Status" => "Error", "Message" => "database connection error"]);
        }
        return $this->data;
    }

    /**
     * checks the provided credentials against both userName and Email
     * @param $username
     * @param $password
     * @param $switch  : name | email
     * @return bool
     */
    private function authenticateCredentials($username, $password, $switch)
    {
        switch($switch)
        {
            case 'name':
                $this->query = "SELECT * FROM user WHERE UserName = '$username' and Password = '$password' and Active = 1";
                break;
            case 'email':
                $this->query = "SELECT * FROM user WHERE Email = '$username' and Password = '$password'and Active = 1";
                break;
        }
        $this->result = $this->db->Select($this->query);
        if($this->result && mysqli_num_rows($this->result) > 0)
        {

            if(!session_start()) {
                session_start();
            }
            $id = mysqli_fetch_assoc($this->result);
            $id = $id['UserID'];
            $id = $this->encryptPass($id);
            $email = $id['Email'];
            $email = $this->encryptPass($email);
            $_SESSION['id'] = $id;
            $_SESSION['email'] = $email;
            $_SESSION['userName'] = $this->encryptPass($username);
            $this->setUser($id);
            session_write_close();
            return true;
        }
        return false;
    }

    /**
     * Encrypt the given field
     * @param $password
     * @return string
     * @throws Exception
     */
    private function encryptPass($password)
    {
        //encrypt password using AES
        $this->Aes = new AES($password, $this->blockSize);
        //gets the encrypted password
        $encoded  = $this->Aes->encrypt();
        return $encoded;

    }

    /**
     * issues the free membership to the newly registered user
     * @param $userId
     * @return bool
     */
    private function issueMembership($userId)
    {
        $data  = date('Y-m-d');

        $this->query = "INSERT INTO usermembership ( UserID, typeId, issuedate) VALUES ( $userId, 1, '$data')";
        $this->result = $this->db->Select($this->query);
        if($this->result)
        {
            return true;
        }
        array_push($this->data, ["Status"=>"error", "Message"=>"Unable to issue membership"]);
        return false;
    }

    /**
     * encrypt the Id
     * @param $userId
     * @return string
     * @throws Exception
     */
    public function encryptId($userId)
    {
        $this->Aes = new AES($userId, $this->blockSize);
        //gets the encrypted password
        $encoded  = $this->Aes->encrypt();
        return $encoded;
    }

    /**
     * decrypts the given attribute.
     * @param $field
     * @return string
     */
    public function decryptField($field)
    {
        $this->Aes = new AES($field,$this->blockSize);
        $this->Aes->setData($field);
        $decrypted = $this->Aes->decrypt();
        return $decrypted;
    }

    /**
     * forcibly start the session and retrieve the current user login encrypted Id
     * @return mixed: userId
     */
    public function forceGetUserId()
    {
        //forcibly start the session
        if(!session_start()) {
            session_start();
        }
        $this->userId = $_SESSION['id'];
        return $this->userId;
    }
}