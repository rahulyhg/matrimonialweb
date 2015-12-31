<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/5/2015
 * Time: 10:02 PM
 */


require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Entity/Country.php');

class CountryController
{


    /**
     * This method is used for fetching all the countries with codes
     *  USAGE OF SWITCH
     *  TRUE- will return countries names only
     *  FALSE- will return countries codes only
     * @param $switch - boolean
     * @return mixed
     */
    public function getCountries($switch)
    {
       $Object = new Country();
       $result = $Object->getCountries($switch);
       return $result;
    }

    /**
     * get the states of the country
     * @param $country
     * @return array
     */
    public function getStates($country)
    {
        $Object = new Country();
        $result = $Object->getStates($country);
        return $result;
    }

    /**
     * Gets the country name, city name based on the user identification Id
     * or get the error that was occurred during transaction
     * @param $userId
     * @return array
     * @see user
     *
     */
    public function getUserCountry($userId)
    {
        $Object = new Country();
        $result = $Object->getUserCountry($userId);
        return $result;
    }

}