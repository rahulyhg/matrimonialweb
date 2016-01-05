<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/6/2015
 * Time: 11:06 AM
 */


require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Connection/Connection.php');
require_once($_SERVER['DOCUMENT_ROOT']. '/matrimonialweb/Entity/AES.php');

class Language {

    /**
     * @var
     * private fields
     */
    protected $db;
    protected $status;
    protected $data;
    protected $connection;
    protected $query;
    protected $result;
    protected $Aes;
    protected $blockSize;
    /**
     * Constructor which loads the database connection
     */
    public function __construct()
    {
        $this->blockSize = 128;
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
     * Update the language attribute of the user
     * @param $languageId
     * @return array
     */
    public function updateUserLanguage($languageId)
    {
        if($this->status)
        {
            if($this->updateLanguage($languageId))
            {
                array_push($this->data,["Status"=>"ok"]);
            }
        }
        else
        {
            array_push($this->data, ["Status"=>"error", "Message"=>"Connection error occurred"]);
        }
        return $this->data;
    }

    private function updateLanguage($languageId)
    {
        if(!session_start())
        {
            session_start();
        }
        if(!isset($_SESSION['id']) || !empty($_SESSION['id']))
        {
            $id = $_SESSION['id'];
            $id = $this->decryptField($id);
            $this->query = "UPDATE profile SET languageId = $languageId WHERE UserID = $id";
            $this->result = $this->db->Select($this->query);
            if($this->result)
            {
                return true;
            }
            else
            {
                array_push($this->data, ["Status"=>"error", "Message"=>"error occurred during updation"]);
            }
        }
        else
        {
            array_push($this->data, ["Status"=>"error", "Message"=>"Authorization error occurred"]);
        }
        return false;

    }

    /**
     * gets all the Languages
     * @return array
     */
    public function getLanguages()
    {

        if($this->status)
        {
            $this->query = "SELECT * FROM language";
            $this->result = $this->db->Select($this->query);
            if($this->result && mysqli_num_rows($this->result) > 0)
            {
                array_push($this->data, ["Status"=>"ok"]);
                while(($row = mysqli_fetch_assoc($this->result))!=false)
                {
                    array_push($this->data, [ "id"=>$row['languageId'],  "name"=>$row['type'] ]);
                }
                return $this->data;
            }
            else
            {
                array_push($this->data, [ "Status"=>"Error", "Message"=>mysqli_error($this->connection)  ]);
                return $this->data;
            }
        }
        else
        {
            array_push($this->data, [ "Status"=>"Error", "Message"=>mysqli_error($this->connection)  ]);
            return $this->data;
        }
        //return $this->data;

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