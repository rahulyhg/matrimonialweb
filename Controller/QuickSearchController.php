<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 1/6/2016
 * Time: 6:42 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Entity/QuickSearch.php');


class QuickSearchController {

    /**
     *
     * get the list of matching partners through searching criteria
     * the attributes involved in the searching criteria would be as follows
     * + gender information
     * + age information      (both high range and low range)
     * + religion Information (both religion and sect)
     * + state information    (both country and city)
     *
     * Once all the attributes are satisfied the system will perform the search operation to find the matching
     * partners list.
     * The list of matching partner will contain partner
     * + gender
     * + age
     * + religion (religion & sect)
     * + state    (country & state)
     * + username
     * + approved image -- if the user does not have any image or in case the uploaded image is not approved
     *   then the default image will be shown instead
     *
     * The System will search through series of age constraints which is observed normally during partner
     * searching in real world..
     *
     * @param $gender
     * @param int $ageLow
     * @param int $ageHigh
     * @param $religion
     * @param $sect
     * @param $country
     * @param $city
     * @return array
     */
    public function performQuickSearch($gender, $ageHigh, $ageLow, $religion, $sect, $country, $city)
    {
        $Object = new QuickSearch();
        $result = $Object->getMatchingPartnersList($gender,$ageLow, $ageHigh, $religion, $sect, $country, $city);
        return $result;
    }

}