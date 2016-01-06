<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Entity/User.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Entity/Age.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Entity/Country.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Entity/Religion.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Entity/Education.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Entity/Family.php');

/**
 * Gets The list of nearly matching partners
 * first it will get the user information and then it will determine the user gender
 * and then it apply search on opposite gender
 * the criteria and processing of it will be as follows
 * for men searching women the age would be +-5 or equals
 * for women searching men would be +10 or equals
 * the religion and sect, family background  should be same..
 * the country, city, education,can vary
 * Created by PhpStorm.
 *
 * User: Haziq
 * Date: 12/24/2015
 * Time: 12:04 PM
 */

class MatchingAlgorithm {

    protected $db;
    protected $status;
    protected $data;
    protected $connection;
    protected $query;
    protected $result;
    protected $user;
    protected $userId;
    protected $userInformation;

    public function __construct()
    {
        $this->userInformation = array();
        $this->data = array();
        $this->user = new User();
        $this->db = $this->user->getDb();
        $this->status = $this->user->getStatus();
    }

    /**Get the partner matching list based on these priorities
     * + religion
     * + age
     * + education
     * + family background
     * + sect
     * + city
     * + country
     * + Gender
     * @return array
     */
    public function getMatchesList()
    {
        if($this->status)
        {
            if($this->getUserInformation())
            {
               $this->userInformation = $this->data;
               unset($this->data);
               $this->data = array();
               if($this->getPartnerIds())
               {
                  $Object = new PartnerPersonalInformation($this->db, $this->data);
                  if($Object->getPartnerInformation())
                  {
                      return $Object->getInformation();
                  }
                  else
                  {
                     return $Object->getInformation();
                  }
               }
            }

        }
        return $this->getInformation();
    }

    /**
     * fetch the user information
     * @return bool
     */
    private function getUserInformation()
    {
         if($this->status)
         {
             //Gets the current login UserId
              $this->userId = $this->user->forceGetUserId();
              $this->userId = $this->user->decryptField($this->userId);
              $Object = new UserInformation($this->db,$this->user,$this->connection,$this->status,$this->userId);
              if($Object->isFieldsAvailable())
              {
                  $this->data = $Object->getData();
                  return true;
              }
             array_push($this->data, ["Status"=>"error", "Message"=>"Unable to fetch user Information"]);
         }
         else
         {
            array_push($this->data, ["Status"=>"error", "Message"=>"Unable to create Connection"]);
         }
        return false;
    }

    /**
     * Gets the partners Ids by the help of user information
     * @return bool
     */
    private function getPartnerIds()
    {
        $Object = new PartnerInformation($this->db,$this->status,$this->userInformation);
        if($Object->getPreferencePartners())
        {
            $this->data = $Object->getInformation();
            return true;
        }
        array_push($this->data, ["Status"=>"error", "Message"=>"Unable to fetch Partner Id's"]);
        return false;
    }

    /**
     * get the data | error message status
     * @return array
     */
    private function getInformation()
    {
        return $this->data;
    }
}

/**
 * Class UserInformation
 * This class is responsible for getting the current login user information
 * so that these fields will be used later for some processing...
 * The information fetched will be
 *    + Gender
 *    + User Age
 *    + religion
 *    + sect
 *    + education
 *    + familyBackground
 *    + country
 *    + city
 *
 */
class UserInformation
{

    private $db;
    private $user;
    private $connection;
    private $userId;
    private $query;
    private $status;
    private $result;
    private $data;

    private $gender, $age, $religion, $sect, $religionSectId, $education, $familyBackground, $city, $country;

    public function __construct($db, $user, $connection, $status, $userId)
    {
        $this->data = array();
        $this->query = null;
        $this->db = $db;
        $this->user = $user;
        $this->connection = $connection;
        $this->result = $this->connection;
        $this->userId = $userId;
        $this->status = $status;
    }

    /**
     * Checks if the necessary fields are available
     * gender, age, religion are necessary while
     * state,education, family background comes on second
     * @return bool
     */
    public function isFieldsAvailable()
    {
        if( $this->getGender() && $this->getAge() && $this->getReligion() ||
            ($this->getState() || $this->getEducation() || $this->getFamilyBackground()) )
        {
            array_push($this->data, [
                                       "Gender"           => $this->gender,
                                       "Age"              => $this->age,
                                       "Religion"         => $this->religion,
                                       "Sect"             => $this->sect,
                                       "ReligionSectId"   => $this->religionSectId,
                                       "Country"          => $this->country,
                                       "City"             => $this->city,
                                       "Education"        => $this->education,
                                       "FamilyBackground" => $this->familyBackground
                                    ]);
            return true;
        }
        return false;
    }

    /**
     * Gets the array loaded with the user information
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    private function  getAge()
    {
        $object = new Age();
        if($object->getUserAge())
        {
            $this->age = $object->getAge();
            return true;
        }
        return false;
    }

    private function getState()
    {
        $Object = new Country();
        $result = $Object->getUserCountry($this->userId);
        if($result[0]['Status'] == "ok")
        {
            $this->country = $result[1]['CountryId'];
            $this->city    = $result[1]['CityId'];
            return true;
        }
        return false;
    }

    private function getReligion()
    {
        $Object = new Religion();
        $result = $Object->getUserReligion($this->userId);
        if($result[0]['Status'] == "ok")
        {
            $this->religion       = $result[1]['ReligionId'];
            $this->sect           = $result[1]['SectId'];
            $this->religionSectId = $result[1]['religionsectId'];
            return true;
        }
        return false;
    }

    private function getGender()
    {
        if($this->status)
        {
            $this->query = "SELECT genderId FROM profile WHERE UserID = ".$this->userId;
            $this->result = $this->db->Select($this->query);
            if($this->result && mysqli_num_rows($this->result) > 0)
            {
                $row = mysqli_fetch_assoc($this->result);
                $genderId = $row['genderId'];
                $this->query = "SELECT type FROM gender WHERE genderId = ".$genderId;
                if($this->result && mysqli_num_rows($this->result) > 0)
                {
                    $row = mysqli_fetch_assoc($this->result);
                    $this->gender = $row['type'];
                    return true;
                }
            }
        }
        return false;
    }

    private function getEducation()
    {
        $Object = new Education();
        $result = $Object->getUserProfession($this->userId);
        if($result[0]['Status'] == "ok")
        {
            $this->education = $result[1]['EduId'];
            return true;
        }
        return false;
    }

    private function getFamilyBackground()
    {
        $Object = new Family();
        $result = $Object->getUserFamilyBackground($this->userId);
        if($result[0]['Status'] == "ok")
        {
            $this->familyBackground = $result[1]['StatusId'];
            return true;
        }
        return false;
    }
}

/**
 * Class PartnerInformation
 * + determine the gender of the partner based on the user gender
 * + determine the age group of the partner
 * + determine the religion and sects of the partner
 * + get all cities and countries to perform both local and global search
 */
class PartnerInformation{

    private $db;
    private $userInformation;
    private $query;
    private $result;
    private $data;

    private $partnerGenderId,$partnerGender, $partnerAge, $partnerReligion, $partnerSect, $is_muslim,
            $partnerReligionSectId, $partnerCountry, $partnerStates, $partnerAllSects;

    public function __construct($db, $status, $userInformation)
    {
        $this->data = array();
        $this->db = $db;
        $this->userInformation = $userInformation;
        $this->query = null;
        $this->result = null;
        $this->partnerAge      = array();
        $this->partnerStates   = array();
        $this->partnerAllSects = array();
    }

    /**
     * Gets the partnerId's or the error message
     * @return array
     */
    public function getInformation()
    {
        return $this->data;
    }
    /**
     * Gets the list of partners Id
     * @return bool
     */
    public function getPreferencePartners()
    {
        if($this->extractDetails())
        {
           if($this->getPartners())
           {
               return true;
           }
        }
       return false;
    }

    /**
     * Extracts the userInformation and on basis of the user Information gets the partner preference
     * + determine the gender of the partner based on the user gender
     * + determine the age group of the partner
     * + determine the religion and sects of the partner
     * + get all cities and countries to perform both local and global search
     * @return bool
     */
    private function extractDetails()
    {
         if(count($this->userInformation )> 0)
         {
             $userGender                  = $this->userInformation[0]['Gender'];
             $userAge                     = $this->userInformation[0]['Age'];
             $userReligion                = $this->userInformation[0]['Religion'];
             $userSect                    = $this->userInformation[0]['Sect'];
             $this->partnerReligionSectId = $this->userInformation[0]['ReligionSectId'];
             $this->partnerCountry        = $this->userInformation[0]['Country'];
            // $userCity      = $this->userInformation[0]['City'];
            // $userEducation = $this->userInformation[0]['Education'];
            // $userFamily    = $this->userInformation[0]['FamilyBackground'];
             if($this->determineGender($userGender) && $this->getStates())
             {
                   $this->determineAge($userAge);
                   $helper = $this->determineReligion_Sect($userReligion);
                   if($helper == "muslim" || $helper == "non-muslim")
                   {
                       $this->partnerReligion = $userReligion;
                       $this->partnerSect = $userSect;
                       if($helper == "non-muslim")
                       {
                           return $this->getAllReligionSects();
                       }
                       return true;
                   }
                 array_push($this->data, ["Status"=>"error", "Message"=>"Error occurred during fetching religion "]);
                 return false;
             }
             array_push($this->data, ["Status"=>"error", "Message"=>"Error occurred during fetching Genders|States "]);
             return false;
         }
        array_push($this->data, ["Status"=>"error", "Message"=>"Empty user Information detected"]);
        return false;
    }

    /**
     * Determine the user gender so to perform search on opposite gender
     * @param $userGenderId
     * @return boolean
     */
    private function determineGender($userGenderId)
    {
      $this->query  = "SELECT type FROM gender WHERE genderId=".$userGenderId;
      $this->result = $this->db->Select($this->query);
      if($this->result && mysqli_num_rows($this->result) > 0)
      {
          $row = mysqli_fetch_assoc($this->result);
          $row = $row['type'];
          if($row == "Male")
          {
              $this->partnerGender = "Female";
          }
          else
          {
              $this->partnerGender = "Male";
          }

          switch($userGenderId)
          {
              case 1:
                  $this->partnerGenderId = 2;
                  break;
              case 2:
                  $this->partnerGenderId = 1;
                  break;
          }
          return true;
      }

      return false;
    }

    /**
     * Perform Age limit criteria by checking user Gender
     * if the user is Female then it means it will look for a male partner then the criteria is that men should be between
     * + +,- 10 of users age.
     *  if the user is Male then it means it will look for a Female partner then the criteria is that Female should be between
     * + +,- 5 of users age.
     * @param $userAge
     */
    private function determineAge($userAge)
    {
        $highRange = null;
        $lowRange = null;

        if($this->partnerGender == "Female")
        {
            //User is male
            //+-5 in the range
            $highRange  =   intval($userAge) + 5;
            $lowRange   =   intval($userAge) - 5;
            $array_High =   range($userAge,$highRange);
            $array_Low  =   range($lowRange,$userAge);
            $this->partnerAge = $array_High;
            $this->partnerAge =  array_merge($this->partnerAge, $array_Low);
        }
        else
        {
            //user is Female
            //partner will be male so +-10 in the range
            $highRange  =   intval($userAge) + 10;
            $lowRange   =   intval($userAge) - 10;
            $array_High =   range($userAge,$highRange);
            $array_Low  =   range($lowRange,$userAge);
            $this->partnerAge = $array_High;
            $this->partnerAge =  array_merge($this->partnerAge, $array_Low);
        }
        sort($this->partnerAge);
    }

    /**
     * Checks the religion of the user if the user is muslim
     * then the same sect will be awarded in searching
     * otherwise if the user is nonMuslim then the religion will be given the preference
     * @param $religionId
     * @return String   muslim | non-muslim | error message
     */
    private function  determineReligion_Sect($religionId)
    {
       $helper = null;
       $temp = $this->isMuslim($religionId);
       //check for error
        if($temp[0]['Status'] == "ok")
       {
           //check user is Muslim
           if($temp[1]['Type'] == "Muslim")
           {
               //user detected Muslim.. ALHUMDULLILAH :)
               $helper = "muslim";
               $this->is_muslim = true;
           }
           else
           {
               //user is Non-muslim
               $helper = "non-muslim";
               $this->is_muslim = false;
           }
       }
       else
       {
           //catch an error
           $helper = $temp[0]['Message'];
       }
        return $helper;
    }

    /**
     * Determine that user is muslim or not
     * @param $religionId
     * @return array
     */
    private function isMuslim($religionId)
    {
        $array = array();
        $this->query = "SELECT type FROM religion WHERE religionId = ".$religionId;
        $this->result = $this->db->Select($this->query);
        if($this->result && mysqli_num_rows($this->result) > 0)
        {
            array_push($array, ["Status" => "ok"]);
            $row = mysqli_fetch_assoc($this->result);
            $row = $row['type'];
            if($row == "Islam")
            {
               //User is muslim
               array_push($array, ["Type"=>"Muslim"]);
            }
            else
            {
                //non-muslim
                array_push($array, ["Type"=>"Non-muslim"]);
            }
            return $array;
        }
        array_push($array, ["Status"=>"error", "Message"=>"Error occurred while fetching religion"]);
        return $array;
    }

    /**
     * Gets the list of all the cities in the specified country
     * @return bool
     */
    private  function getStates()
    {
        $this->query = "SELECT stateid FROM state WHERE countryid = ".$this->partnerCountry;
        $this->result= $this->db->Select($this->query);
        if($this->result && mysqli_num_rows($this->result) > 0)
        {
            while(($row = mysqli_fetch_assoc($this->result)) != false)
            {
                $this->partnerStates[] = $row['stateId'];
            }
            return true;
        }
        return false;
    }

    /**
     * If the user is a non-muslim then by the help of his religion
     * grab all sects related to it
     * @return bool
     */
    private function getAllReligionSects()
    {
        $this->query = "SELECT religionsectId FROM religionsect WHERE religionId = ".$this->partnerReligion;
        $this->result= $this->db->Select($this->query);
        if($this->result && mysqli_num_rows($this->result) > 0)
        {
            while(($row = mysqli_fetch_assoc($this->result)) != false)
            {
                $this->partnerAllSects[] = $row['religionsectId'];
            }
            return true;
        }
        return false;
    }

    /**
     * Generate the queries. is capable of generating two queries with each consist of two subtypes
     * + generate priorities based query which means that the searching will be in the same country domain
     *   automatically visualize if the user is muslim then the same religion,Sect will be included
     *   if the user is non-muslim then only the main religion will be included with all sects
     *
     * + global based searching query means it will search for partners all over the globe.. criteria includes if the
     *   user is muslim then the same religion,sect will be used..
     *   otherwise the religion with all the sects will be the part of search
     * @param $pass
     * @return null|string
     */
    private function queryGenerator($pass)
    {
        $query = "";
        $ages =  $this->getArrayToString($this->partnerAge);
        $state = $this->getArrayToString($this->partnerStates);
       switch($pass)
       {   //same country search
           case 1:
               if($this->is_muslim)
               {
                  $query = "SELECT UserID FROM profile WHERE genderId = ".$this->partnerGenderId ." and age IN (".$ages.") and religionId = ". $this->partnerReligionSectId. "and stateId in (".$state.")";
               }
               else
               {
                   $allSects = $this->getArrayToString($this->partnerAllSects);
                   $query = "SELECT UserID FROM profile WHERE genderId = ".$this->partnerGenderId ." and age IN (".$ages.") and religionId IN( ". $allSects. ") and stateId in (".$state.")";

               }
           break;
           //globally search
           case 2:
               if($this->is_muslim)
               {
                   $query = "SELECT UserID FROM profile WHERE genderId = ".$this->partnerGenderId ." and age IN (".$ages.") and religionId = ". $this->partnerReligionSectId. "and stateId NOT IN (".$state.")";
               }
               else
               {
                   $allSects = $this->getArrayToString($this->partnerAllSects);
                   $query = "SELECT UserID FROM profile WHERE genderId = ".$this->partnerGenderId ." and age IN (".$ages.") and religionId IN( ". $allSects. ") and stateId NOT IN (".$state.")";
               }
           break;
       }
       return $query;
    }

    /**
     * Convert the array to string
     * preparing for In statements arguments
     * @param $string
     * @return string
     */
    private function getArrayToString($string)
    {
        $final = "";
        for($i=0; $i< count($string); $i++ )
        {
            $final .= $string[$i];
        }
        $final = rtrim($final, ',');
        return $final;
    }

    /**
     * Gets the list of partners using both search criteria (locally & globally)
     * @return bool
     */
    private function getPartners()
    {
       $this->query = $this->queryGenerator(1);
       if($this->fetchResults($this->query, "UserID", $this->data))
       {
           $temp = $this->data;
           $this->query = $this->queryGenerator(2);
           unset($this->data);
           $this->data = array();
           if($this->fetchResults($this->query, "UserID", $this->data))
           {
               $this->data = array_push($temp,$this->data);
               return true;
           }
           array_push($this->data, ["Status"=>"error", "Message"=> "Error occurred during some partners transaction Pass two"]);
           return false;
       }
       array_push($this->data, ["Status"=>"error", "Message"=> "Error occurred during some partners transaction"]);
       return false;
    }

    /**
     * run a query and check the result
     * @param $query
     * @param $columnName
     * @param $array
     * @return bool
     */
    private function fetchResults($query , $columnName, $array)
    {
        $this->result = $this->db->Select($query);
        if($this->result && mysqli_num_rows($this->result) > 0)
        {
            while(($row = mysqli_fetch_assoc($this->result)) != false)
            {
                $array[] = $row[$columnName];
            }
            return true;
        }
        return false;
    }
}

/**
 * Class PartnerPersonalInformation
 * gets the partner personal information such as
 * + PartnerId
 * + Username
 * + Age
 * + City
 * + Country
 * + Approved Image
 */

class PartnerPersonalInformation
{
    private $db;
    private $query;
    private $result;
    private $data;
    private $partnerInformation;
    private $partnerIds;
    private $ImageUsername;
    private $AgeState;
    private $ReligionSect;
    private $CounryCity;

    public function __construct($db, $partnerIds)
    {
        $this->db = $db;
        $this->partnerIds = $partnerIds;
        $this->partnerInformation = array();
        $this->data = array();
        $this->ImageUsername = array();
        $this->AgeState = array();
        $this->ReligionSect = array();
        $this->CounryCity = array();
        $this->query = null;
        $this->result = null;
    }

    public function getPartnerInformation()
    {
        if($this->getImage_Username() && $this->getAgeStateId() && $this->getCountryCity() &&
            $this->getReligionSect())
        {
            $this->arrangeInformation();
            return true;
        }
        return false;
    }

    public function getInformation()
    {
        return $this->data;
    }

    private function getImage_Username()
    {
        for($i=0; $i<count($this->partnerIds); $i++)
        {
            $this->query="SELECT s.UserName, m.image FROM user s,image m WHERE s.UserID =".$this->partnerIds[$i]."  and m.UserID =".$this->partnerIds[$i]."  and approved = 1";
            $this->result = $this->db->Select($this->query);
            if($this->result && mysqli_num_rows($this->result) > 0)
            {
                $row = mysqli_fetch_assoc($this->result);
                $userName = $row['UserName'];
                $image    = base64_encode($row['image']);
                array_push($this->ImageUsername, [  "UserId" => $this->partnerIds[$i], "UserName"=>$userName, "Image"=>$image]);
            }
            else { array_push($this->data, ["Status"=>"error", "Message"=>"Unable to fetch Image/Username"]); return false;}
        }
        return true;
    }

    private function getAgeStateId()
    {
        for($i=0; $i<count($this->partnerIds); $i++)
        {
            $id = $this->partnerIds[$i];
            $this->query="SELECT stateId, age religionId, FROM profile WHERE UserID = $id";
            $this->result = $this->db->Select($this->query);
            if($this->result && mysqli_num_rows($this->result) > 0)
            {
                $row = mysqli_fetch_assoc($this->result);
                $state = $row['stateId'];
                $age    = $row['age'];
                $religion = $row['religionId'];
                array_push($this->AgeState, ["StateId"=>$state, "Age"=>$age, "ReligionId"=>$religion]);
            }
            else { array_push($this->data, ["Status"=>"error", "Message"=>"Unable to fetch Age/State"]); return false;}
        }
        return true;
    }

    private function getCountryCity()
    {
        if(count($this->AgeState) >0)
        {
            for($i=0; $i<count($this->AgeState); $i++)
            {
                $id = $this->AgeState[$i]['StateId'];
                $this->query="SELECT countryid, cityid FROM state WHERE stateid = $id";
                $this->result = $this->db->Select($this->query);
                if($this->result && mysqli_num_rows($this->result) > 0)
                {
                   $row = mysqli_fetch_assoc($this->result);
                   $countryId = $row['countryid'];
                   $cityId    = $row['cityid'];
                   $this->query = "SELECT country.name AS coun, city.name AS city FROM country,city WHERE country.countryid = $countryId and city.cityid = $cityId";
                   $this->result = $this->db->Select($this->query);
                    if($this->result && mysqli_num_rows($this->result) > 0)
                    {
                        $row = mysqli_fetch_assoc($this->result);
                        $country = $row['coun'];
                        $city    = $row['city'];
                        array_push($this->CounryCity, ["Country"=>$country, "City"=>$city]);
                    }
                    else
                    {
                      array_push($this->data, ["Status"=>"error", "Message"=>"Unable to fetch Country/City names"]);
                      return false;
                    }

                }
                else { array_push($this->data, ["Status"=>"error", "Message"=>"Unable to fetch Country/city"]); return false;}
            }
            return true;
        }
        return false;

    }

    private function getReligionSect()
    {
        if(count($this->AgeState) >0)
        {
            for($i=0; $i<count($this->AgeState); $i++)
            {
                $id = $this->AgeState[$i]['ReligionId'];
                $this->query="SELECT religionId, sectId FROM religionsect WHERE religionsectId = $id";
                $this->result = $this->db->Select($this->query);
                if($this->result && mysqli_num_rows($this->result) > 0)
                {
                    $row = mysqli_fetch_assoc($this->result);
                    $religionId = $row['religionId'];
                    $sectId     = $row['sectId'];
                    $this->query = "SELECT religion.type AS r, sect.type AS s FROM religion,sect WHERE religion.religionId= $religionId and sect.sectId = $sectId";
                    $this->result = $this->db->Select($this->query);
                    if($this->result && mysqli_num_rows($this->result) > 0)
                    {
                        $row = mysqli_fetch_assoc($this->result);
                        $religion = $row['r'];
                        $sect    = $row['s'];
                        array_push($this->ReligionSect, ["Religion"=>$religion, "Sect"=>$sect]);
                    }
                    else
                    {
                        array_push($this->data, ["Status"=>"error", "Message"=>"Unable to fetch Religion/Sect types"]);
                        return false;
                    }

                }
                else { array_push($this->data, ["Status"=>"error", "Message"=>"Unable to fetch Religion/Sect"]); return false;}
            }
            return true;
        }
        return false;

    }

    private function arrangeInformation()
    {
      for($i=0; $i< count($this->ImageUsername); $i++ )
      {
          $PartnerID = $this->ImageUsername[$i]['UserId'];
          $userName  = $this->ImageUsername[$i]['UserName'];
          $Image     = $this->ImageUsername[$i]['Image'];
          $age       = $this->AgeState[$i]['Age'];
          $country   = $this->CounryCity[$i]['Country'];
          $city      = $this->CounryCity[$i]['City'];
          $religion  = $this->ReligionSect[$i]['Religion'];
          $sect      = $this->ReligionSect[$i]['Sect'];
          array_push($this->data, [
                                   "Id"       => $PartnerID, "UserName" => $userName, "Image" => $Image,
                                   "Age"      => $age,       "Country"  => $country,  "City"  => $city,
                                   "Religion" => $religion,  "Sect"     => $sect
          ]);
      }
    }
}