<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/30/2015
 * Time: 11:52 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Entity/FavouritesList.php');

class FavouritesListController {

    public function addToFavourite($partnerId)
    {
        $Object = new FavouritesList();
        $result = $Object->addToFavourite($partnerId);
        return $result;
    }

    public function removeFromFavouriteList($partnerId)
    {
        $Object = new FavouritesList();
        $result = $Object->removeFromFavourite($partnerId);
        return $result;
    }
}