<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/7/2015
 * Time: 10:58 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Entity/User.php');

class Profile
{

    protected $db;
    protected $status;
    protected $data;
    protected $connection;
    protected $query;
    protected $result;
    protected $user;
    protected $userId;

    private $religionId;
    private $sectId;
    private $stateId;
    private $religionSectId;
    private $familyId;
    private $familyTypeId;
    private $familyClassId;
    private $professionId;
    private $genderId;
    private $dob;
    private $phone;
    private $country;
    private $city;
    private $languageId;
    private $me;
    private $height;
    private $weight;
    private $martialId;
    private $disabilityId;
    private $partner;
    private $salary;
    private $currenyId;
    private $educationId;
    private $fieldId;
    private $workingId;

    /**
     * Constructor which loads the database connection
     */
    public function __construct()
    {
        $this->data = array();
        $this->status = true;
        $this->user = new User();
        $this->db = $this->user->getDb();
    }

    /**
     * Gets the basic profile information such as
     * + age
     * + DOB
     * + height
     * + weight
     * + User description
     * + partner preference information
     * @param $userId
     * @return array
     */
    public function getUserInformation($userId)
    {
        if($this->status)
        {
            $this->query = " SELECT age, dob, phone, height, weight, yourselfdescription, partnerpreference FROM profile WHERE profile.UserID = $userId;";
            $this->result = $this->db->Select($this->query);
            if($this->result && mysqli_num_rows($this->result) > 0)
            {
                array_push($this->data, ["Status" => "ok"]);
                $row = mysqli_fetch_assoc($this->result);
                array_push($this->data, [
                                          "Age"=>$row['age'], "Phone"=>$row['phone'], "Height"=>$row['height'],
                                           "Weight"=>$row['weight'], "Me"=>$row['yourselfdescription'],
                                           "Partner"=>$row['partnerpreference']
                ]);
            }
            else
            {
                array_push($this->data, ["Status" => "error", "Message" => "Error occurred during transaction"]);
            }
        }
        else
        {
            array_push($this->data, ["Status" => "error", "Message" => "Error occurred during connection establishment"]);
        }
        return $this->data;
    }


    /**
     * create profile of newly registered user
     * @return array
     */
    public function createProfile()
    {
        if ($this->validateSessions())
        {
            if ($this->user->createUser())
            {
                //user created now gets its Id
                $this->userId = $this->user->getUserId();
                //now its for time for some action lets create some profile
                if ($this->profileMaker())
                {
                    $this->data = array();
                    array_push($this->data, ["Status" => "ok", "UserId"=> $this->user->forceGetUserId()]);
                    return $this->data;
                }
            }
            else
            {
                $this->data = $this->user->getData();
            }
        }
        else
        {
            array_push($this->data, ["Status" => "error", "Message" => "All values must be recorded"]);
        }
        session_write_close();
        return $this->data;
    }

    /**
     * validate all the sessions
     * @return bool
     */
    private function validateSessions()
    {
        //start session
        if (!session_start()) {
            session_start();
        }
        //check all sessions
        if ((isset($_SESSION['basicInfo']) || !empty($_SESSION['basicInfo'])) &&
            (isset($_SESSION['socialInfo']) || !empty($_SESSION['socialInfo'])) &&
            (isset($_SESSION['physical']) || !empty($_SESSION['physical'])) &&
            (isset($_SESSION['educational']) || !empty($_SESSION['educational'])) &&
            (isset($_SESSION['partner']) || !empty($_SESSION['partner']))
        ) {
            return true;
        }
        return false;
    }

    /**
     * responsible for creating profile by checking all parameters
     * @return bool
     */
    private function profileMaker()
    {
        if ($this->validateCrucialFields() && $this->validateFields())
        {
            //after crucial checks and inner checks the call to db function will be validated here
            if ($this->getStateId($this->country, $this->city) && $this->getReligionSectId($this->religionId, $this->sectId)
                && $this->getFamilyId($this->familyTypeId, $this->familyClassId) &&
                $this->getProfessionId($this->educationId, $this->fieldId, $this->workingId, $this->currenyId, $this->salary)
               )
            {
                //now creates profile
                if ($this->insertProfile($this->userId,$this->genderId,$this->dob,$this->phone,$this->stateId,$this->languageId,$this->religionSectId,
                     $this->me,$this->height,$this->weight,$this->martialId,$this->disabilityId,$this->familyId,$this->professionId,$this->partner))
                {
                    //Profile created now start the encrypted session
                    $_SESSION['id'] = $this->user->encryptId($this->userId);
                    session_write_close();
                    return true;
                }
                else
                {
                    array_push($this->data, ["Status" => "error", "Message" => "error occurred during validating field"]);
                }
            }
            else
            {
                array_push($this->data, ["Status" => "error", "Message" => "error occurred during validating field"]);
            }
        }
        return false;
    }

    /**
     * @return bool
     */
    private function validateFields()
    {
        if (isset($_SESSION['basicInfo'][1]['DOB'])        &&  isset($_SESSION['basicInfo']    [1]  ['Gender'])      &&
            isset($_SESSION['socialInfo'][1]['Country'])   &&  isset($_SESSION['socialInfo']   [1]  ['State'])       &&
            isset($_SESSION['socialInfo'][1]['Religion'])   && isset($_SESSION['socialInfo']   [1]  ['Sect'])        &&
            isset($_SESSION['socialInfo'][1]['Language'])   && isset($_SESSION['physical']     [1]  ['height'])      &&
            isset($_SESSION['physical']  [1]['weight'])     && isset($_SESSION['physical']     [1]  ['martial'])     &&
            isset($_SESSION['physical']  [1]['familyType']) && isset($_SESSION['physical']     [1]  ['familyClass']) &&
            isset($_SESSION['educational'][1]['education']) && isset($_SESSION['educational']  [1]  ['field'])       &&
            isset($_SESSION['educational'][1]['working'])   && isset($_SESSION['educational']  [1]  ['currency'])
        ) {
            $dob         = $_SESSION['basicInfo']    [1] ['DOB'];
            $gender      = $_SESSION['basicInfo']    [1] ['Gender'];
            $country     = $_SESSION['socialInfo']   [1] ['Country'];
            $state       = $_SESSION['socialInfo']   [1] ['State'];
            $religion    = $_SESSION['socialInfo']   [1] ['Religion'];
            $sect        = $_SESSION['socialInfo']   [1] ['Sect'];
            $language    = $_SESSION['socialInfo']   [1] ['Language'];
            $height      = $_SESSION['physical']     [1] ['height'];
            $weight      = $_SESSION['physical']     [1] ['weight'];
            $martial     = $_SESSION['physical']     [1] ['martial'];
            $familyType  = $_SESSION['physical']     [1] ['familyType'];
            $familyClass = $_SESSION['physical']     [1] ['familyClass'];
            $currency    = $_SESSION['educational']  [1] ['currency'];
            $education   = $_SESSION['educational']  [1] ['education'];
            $field       = $_SESSION['educational']  [1] ['field'];
            $working     = $_SESSION['educational']  [1] ['working'];

            if ($dob != "" && $gender > 0 && $country > 0 && $state > 0 && $religion > 0 && $sect > 0 && $language > 0
                && $height > 0 && $weight > 0 && $martial > 0 && $familyClass > 0 && $familyType > 0 && $currency > 0
                && $education > 0 && $field > 0 && $working > 0
            ) {
                $this->dob = $dob;
                $this->genderId = $gender;
                $this->country = $country;
                $this->city = $state;
                $this->religionId = $religion;
                $this->sectId = $sect;
                $this->languageId = $language;
                $this->height = $height;
                $this->weight = $weight;
                $this->martialId = $martial;
                $this->familyTypeId = $familyType;
                $this->familyClassId = $familyClass;
                $this->currenyId = $currency;
                $this->educationId = $education;
                $this->fieldId = $field;
                $this->workingId = $working;
                return true;
            }
            else {
                array_push($this->data, ["Status" => "error", "Message" => "fields validation error"]);
                return false;
            }
        }
        else {
            array_push($this->data, ["Status" => "error", "Message" => "Improper fields selection"]);
        }
        return false;
    }

    /**
     * validate user crucial fields
     * @return bool
     */
    private function validateCrucialFields()
    {
        if (isset($_SESSION['basicInfo'][1]['Cell']) && isset($_SESSION['socialInfo'][1]['Me']) &&
            isset($_SESSION['educational'][1]['salary']) && isset($_SESSION['partner'][1]['partner'])
        )
        {
            $cell = $_SESSION['basicInfo'][1]['Cell'];
            $me = $_SESSION['socialInfo'][1]['Me'];
            $partner = $_SESSION['partner'][1]['partner'];
            $salary = $_SESSION['educational'][1]['salary'];
            $salary = intval($salary);
            if (strlen($cell) >= 9 && strlen($me) <= 110 && $partner <= 100 && $salary > 100)
            {
                $this->phone = $cell;
                $this->me = $me;
                $this->partner = $partner;
                $this->salary = $salary;
                return true;
            }
            array_push($this->data, ["Status" => "error", "Message" => "Required inputs were not in correct format"]);
            return false;
        }
        array_push($this->data, ["Status" => "error", "Message" => "Required inputs were not set"]);
        return false;
    }

    /**
     * get the respective state from the country along with its city
     * @param $countryId
     * @param $cityId
     * @return bool
     */
    private function getStateId($countryId, $cityId)
    {
        $this->query = "SELECT stateid FROM state WHERE countryid = $countryId and cityid = $cityId";
        $this->result = $this->db->Select($this->query);
        if ($this->result && mysqli_num_rows($this->result) > 0) {
            $id = mysqli_fetch_assoc($this->result);
            $this->stateId = $id['stateid'];
            return true;
        }
        array_push($this->data, ["Status" => "error", "Message" => "Error occurred during fetching state"]);
        return false;
    }

    /**
     * get the appropriate religionSect by providing religion and Sect Id
     * @param $religionId
     * @param $sectId
     * @return bool
     */
    private function getReligionSectId($religionId, $sectId)
    {
        $this->query = "SELECT religionsectId FROM religionsect WHERE religionId = $religionId and sectId = $sectId";
        $this->result = $this->db->Select($this->query);
        if ($this->result && mysqli_num_rows($this->result) > 0) {
            $id = mysqli_fetch_assoc($this->result);
            $this->religionSectId = $id['religionsectId'];
            return true;
        }
        array_push($this->data, ["Status" => "error", "Message" => "Error occurred during fetching religion"]);
        return false;
    }

    /**
     * get the family type by providing familyId and classId
     * @param $familyTypeId
     * @param $familyClassId
     * @return bool
     */
    private function getFamilyId($familyTypeId, $familyClassId)
    {
        $this->query = "SELECT familyId FROM family WHERE familytypeid = $familyTypeId and statusid = $familyClassId";
        $this->result = $this->db->Select($this->query);
        if ($this->result && mysqli_num_rows($this->result) > 0) {
            $id = mysqli_fetch_assoc($this->result);
            $this->familyId = $id['familyId'];
            return true;
        }
        array_push($this->data, ["Status" => "error", "Message" => "Error occurred during fetching "]);
        return false;
    }

    /**
     * Insert new record of the user profession and store the key of it in the professionId 'field' of the
     * latest inserted
     * @param $educationalId
     * @param $fieldId
     * @param $workingId
     * @param $currencyId
     * @param $salary
     * @return bool
     */
    private function getProfessionId($educationalId, $fieldId, $workingId, $currencyId, $salary)
    {
        $this->query = "INSERT INTO profession( eduId, fieldId, occupationId, salary, currencyId) VALUES ( $educationalId, $fieldId, $workingId, $salary, $currencyId)";
        $this->result = $this->db->Select($this->query);
        if ($this->result) {
            $this->query = "SELECT MAX(professionId) as professionId FROM profession";
            $this->result = $this->db->Select($this->query);
            if ($this->result && mysqli_num_rows($this->result) > 0) {
                $id = mysqli_fetch_assoc($this->result);
                $this->professionId = $id['professionId'];
                //echo 'ProfessionalId: '.$this->professionId . '<br/>';
                return true;
            } else {
                array_push($this->data, ["Status" => "error", "Message" => "Error occurred during fetching latest profession record"]);
                return false;
            }
        }
        array_push($this->data, ["Status" => "error", "Message" => "Error occurred during insertion of profession "]);
        return false;
    }

    /**inserts the new created user record now into the profile
     * @param $userId
     * @param $genderID
     * @param $dob
     * @param $phone
     * @param $stateId
     * @param $languageId
     * @param $releigonId
     * @param $you
     * @param $height
     * @param $weight
     * @param $martialId
     * @param $disability
     * @param $familyId
     * @param $professionId
     * @param $partner
     * @return bool
     */
    private function insertProfile($userId, $genderID, $dob, $phone, $stateId, $languageId, $releigonId, $you,
                                   $height, $weight, $martialId, $disability, $familyId, $professionId, $partner)
    {
        $from = new DateTime($dob);
        $to   = new DateTime();
        $age  = $from->diff($to)->y;
        echo $from->diff($to)->y;

        if ($disability == "true") {

            $this->query = "INSERT INTO profile( UserID, genderId, dob, age,phone, stateId, languageId, religionId,
                                             yourselfdescription, height, weight, martialId, disabilitiesId,
                                             familyId, professionId, partnerpreference)
                                             VALUES
                                             ( $userId, $genderID,  '$dob', $age ,'$phone',  $stateId,  $languageId,  $releigonId,
                                               '$you',  $height, $weight,  $martialId, $disability,
                                               $familyId, $professionId, '$partner')";
        } else {

            $this->query = "INSERT INTO profile( UserID, genderId, dob, age ,phone, stateId, languageId, religionId,
                                             yourselfdescription, height, weight, martialId, disabilitiesId,
                                             familyId, professionId, partnerpreference)
                                             VALUES
                                             ( $userId, $genderID,  '$dob', $age ,'$phone',  $stateId,  $languageId,  $releigonId,
                                               '$you',  $height, $weight,  $martialId, NULL ,
                                               $familyId, $professionId, '$partner')";
        }
        $this->result = $this->db->Select($this->query);
        if ($this->result) {
            return true;
        }
        array_push($this->data, ["Status" => "error", "Message" => "Error occurred during profile insertion "]);
        return false;
    }

}