<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/29/2015
 * Time: 12:33 AM
 */


require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Entity/User.php');

class Profession {

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
     * Update the user professional status
     *  + education status
     *  + field status
     *  + working status
     *  + salary status
     *  + currency  status in which user is earning salary
     * @param $educationId
     * @param $fieldId
     * @param $workingId
     * @param $salary
     * @param $currencyId
     * @return array
     */
    public  function updateUserProfession($educationId, $fieldId, $workingId, $salary, $currencyId)
    {
       if($this->status)
       {
           if($this->updateUserProfessionalInformation($educationId,$fieldId,$workingId, $salary, $currencyId))
           {
               array_push($this->data,["Status"=>"ok"]);
           }
           else
           {
               return $this->data;
           }
       }
       else
       {
            array_push($this->data, ["Status"=>"error", "Message"=>"Connection problem detected"]);
       }
       return $this->data;
    }


    /**
     * Gets the professional information
     * + salary
     * + education
     * + field
     * + workingType
     * @return array
     */
    public function getProfessionalInformation()
    {
        if($this->status)
        {
            $userId = $this->user->forceGetUserId();
            $userId = $this->user->decryptField($userId);
            if($this->getProfessionalFromProfile($userId))
            {
                if($this->getDetails($this->temp))
                {

                }
            }
        }
        else
        {
            array_push($this->data, ["Status"=>"error", "Message"=>"Error occurred during connection"]);
        }
        return $this->data;
    }

    /**
     * + First get the professionId from the profile
     * + After that fetch the EducationID, FieldID, OccupationID, FieldID, Salary from the profession table
     * @param $userId
     * @return bool
     */
    private function getProfessionalFromProfile($userId)
    {
        $this->query = "SELECT profile.professionId FROM profile WHERE profile.professionId = $userId";
        $this->result = $this->db->Select($this->query);
        if($this->result && mysqli_num_rows($this->result) > 0)
        {
            $row = mysqli_fetch_assoc($this->result);
            $id  = $row['professionId'];
            $this->query = "SELECT * FROM profession WHERE profession.professionId = $id";
            $this->result = $this->db->Select($this->query);
            if($this->result && mysqli_num_rows($this->result) > 0)
            {
                $row = mysqli_fetch_assoc($this->result);
                $eduId   = $row['eduId'];
                $fieldId = $row['fieldId'];
                $occuId  = $row['occupationId'];
                $salary  = $row['salary'];
                array_push($this->temp, ["Education"=>$eduId, "Field"=>$fieldId, "Occupation"=>$occuId,
                                         "Salary"=>$salary]);
                return true;
            }
            else
            {
                array_push($this->data, ["Status"=>"error", "Message"=>"Error occurred during profession fields extraction"]);
                return false;
            }
        }
        array_push($this->data, ["Status"=>"error", "Message"=>"Error occurred during profession extraction"]);
        return false;
    }

    /**
     * Once all the fields have been extracted form the profile and the profession table
     * now extract the fields such as
     * + Education Type
     * + Occupation Type
     * + Field Type
     * After the data has been extracted now enclosed all the extracted data into the array
     * @param $array
     * @return bool
     * @see getProfessionalFromProfile($userId)
     */
    private function getDetails($array)
    {
       $education  = $array[0]['Education'];
       $field      = $array[0]['Field'];
       $occupation = $array[0]['Occupation'];
       $salary     = $array[0]['Salary'];

       $this->query = "SELECT education.type AS e , field.type AS f, occupation.type AS o FROM
                       education,field,occupation WHERE education.eduId = $education and field.fieldId = $field and
                       occupation.occupationId = $occupation";
       $this->result = $this->db->Select($this->query);
       if($this->result && mysqli_num_rows($this->result) > 0)
       {
           $row = mysqli_fetch_assoc($this->result);
           $Education  = $row['e'];
           $Field      = $row['f'];
           $Occupation = $row['o'];
           array_push($this->data, ["Status"=>"ok"]);
           array_push($this->data, [
                                      "Education"=>$Education, "Field"=>$Field, "Occupation"=>$Occupation,
                                      "Salary"=>$salary
           ]);
           return true;
       }
       else
       {
           array_push($this->data, ["Status"=>"error", "Message"=>"Error occurred during fetching information"]);
       }
       return false;
    }

    /**
     * update tje user professional information
     * @param $educationId
     * @param $fieldId
     * @param $occupationId
     * @param $salary
     * @param $currencyId
     * @return bool
     */
    private function  updateUserProfessionalInformation($educationId, $fieldId, $occupationId, $salary, $currencyId)
    {
        $userId = $this->user->forceGetUserId(); //Get the logged in userId
        $userId = $this->user->decryptField($userId); // As the id is encrypted so decrypt it using same algorithm
        //run a query to the user professional Information
        $this->query  = "SELECT professionId FROM profile WHERE UserID = $userId";
        $this->result = $this->db->Select($this->query);
        if($this->result && mysqli_num_rows($this->result) > 0) //check for valid response
        {
            //fetch the professional identification of the user
            $row          = mysqli_fetch_assoc($this->result);
            $professionId = $row['professionId'];
           //now update using given information
           $this->query = "UPDATE profession SET eduId = $educationId, fieldId = $fieldId, occupationId = $occupationId,
                           salary = $salary, currencyId = $currencyId WHERE professionId = $professionId ";

            //update fields using above information
            $this->result = $this->db->Select($this->query);
            if($this->result ) //check for valid response
            {
                //all fields are updated.. WOW well played
                return true;
            }
            else
            {
                //Mission abort... some error detected
                array_push($this->data, ["Status"=>"error" , "Message"=>"Error occurred during updating professional information"]);
            }
        }
        else
        {
            //Retreat error ahead.. I repeat error ahead.. MAYDAY MAYDAY.....
            array_push($this->data, ["Status"=>"error" , "Message"=>"Error occurred during transaction"]);
        }
        return false;
    }
}