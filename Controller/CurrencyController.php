<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/7/2015
 * Time: 12:00 AM
 */


require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Entity/Currency.php');

class CurrencyController
{

    public function getCurrencyList()
    {
        $Object = new Currency();
        $result = $Object->getCurrenciesList();
        return $result;
    }

}