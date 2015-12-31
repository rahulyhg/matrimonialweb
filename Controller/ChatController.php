<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/10/2015
 * Time: 3:45 AM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Entity/Chat.php');

class ChatController {

    /**
     * save the message to the database
     * @param $to      : PartnerId
     * @param $message : message content
     * @return array   : Containing status
     */
    public function sendMessage($to, $message)
    {
        $Object = new Chat();
        $result = $Object->addMessage($to, $message);
        return $result;
    }

    /**
     * get the chat messages with the partner
     * @param $partner  : PartnerId
     * @return array    : status containing messages content or error
     */
    public function getChatMessages($partner)
    {
        $Object = new Chat();
        $result = $Object->getChatMessages($partner);
        return $result;
    }

}