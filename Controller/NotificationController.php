<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 1/2/2016
 * Time: 12:54 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Entity/Notification.php');

class NotificationController {


    /**
     * Gets the list of all the notification of the current logged in user
     *
     * @return array
     */
    public function  getNotification()
    {
        $Object = new Notification();
        $result = $Object->getNotifications();
        return $result;
    }

    /**
     * Update the proerty of notification which is seen by the user
     * @param $notificationId
     * @return array
     */
    public function seenNotification($notificationId)
    {
        $Object = new Notification();
        $result = $Object->seenNotification($notificationId);
        return $result;
    }
}