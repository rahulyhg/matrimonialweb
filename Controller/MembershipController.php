<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/13/2015
 * Time: 2:14 AM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Entity/Membership.php');

class MembershipController {

    /**
     * Gets the information about the premium members
     * @return array
     */
    public function getPremiumMembers()
    {
        $Object = new Membership();
        $result = $Object->premiumMembersList();
        return $result;
    }

    /**
     * Detect the user Membership Type
     * @return array
     */
    public function getUserMembership()
    {
        $Object = new Membership();
        $result = $Object->getUserMemberShip();
        return $result;
    }
}