<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 1/4/2016
 * Time: 6:00 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Entity/GreetingMessage.php');


class GreetingMessageController {

    /**
     * Send the greeting message to the desired partner
     * @param $partner
     * @param $message
     * @return mixed
     */
    public function sendGreetingMessage($partner, $message)
    {
        $Object = new GreetingMessage();
        $result = $Object->sendExpressMessage($partner, $message);
        return $result;
    }
}