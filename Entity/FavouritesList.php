<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/30/2015
 * Time: 11:18 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Entity/User.php');

class FavouritesList {

    protected $db;
    protected $status;
    protected $data;
    protected $connection;
    protected $query;
    protected $result;
    protected $user;
    protected $userId;


    public function __construct()
    {
        $this->data = array();
        $this->user = new User();
        $this->db = $this->user->getDb();
        $this->status = $this->user->getStatus();
    }

    /**
     * Add the user to the favourites list
     * @param $partnerId
     * @return array
     */
    public function addToFavourite($partnerId)
    {
        if($this->status)
        {
            $partnerId = $this->user->decryptField($partnerId);
            $this->userId = $this->user->forceGetUserId();
            $this->userId = $this->user->decryptField($this->userId);
            $id = $this->userId;
            $date = date('Y-m-d H:m:s');
            $this->query = "INSERT INTO favourites(partner, user, CreatedAt) VALUES ( $partnerId, $id, '$date' )";
            $this->result = $this->db->Select($this->query);
            if($this->result)
            {
                array_push($this->data, ["Status"=>"ok"]);
            }
            else
            {
                array_push($this->data, ["Status"=>"error", "Message"=>"Error occurred during adding into favourites list"]);
            }
        }
        else
        {
            array_push($this->data, ["Status"=>"error", "Message"=>"Connection error"]);
        }
        return $this->data;
    }

    /**
     * remove the user from the favourites list
     * @param $partnerId
     * @return array
     */
    public function removeFromFavourite($partnerId)
    {
        if($this->status)
        {
            $partnerId = $this->user->decryptField($partnerId);
            $this->userId = $this->user->forceGetUserId();
            $this->userId = $this->user->decryptField($this->userId);
            $id = $this->userId;
            $this->query = "DELETE FROM favourites WHERE favourites.partner = $partnerId and favourites.user = $id";
            $this->result = $this->db->Select($this->query);
            if($this->result)
            {
                array_push($this->data, ["Status"=>"ok"]);
            }
            else
            {
                array_push($this->data, ["Status"=>"error", "Message"=>"Error occurred during removing from favourites list"]);
            }
        }
        else
        {
            array_push($this->data, ["Status"=>"error", "Message"=>"Connection error"]);
        }
        return $this->data;
    }
}