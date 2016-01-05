<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 1/5/2016
 * Time: 11:00 AM
 */

require_once($_SERVER['DOCUMENT_ROOT'].'/matrimonialweb/Entity/User.php');


class Image {


    protected $db;
    protected $status;
    protected $data;
    protected $connection;
    protected $query;
    protected $result;
    protected $user;
    protected $userId;

    protected $newImage;

    public function __construct()
    {
        $this->data = array();
        $this->status = true;
        $this->user = new User();
        $this->db = $this->user->getDb();
    }

    /**
     * upload the image and resize to its default size which is (512 * 512)
     * @param $image
     * @return array
     */
    public function uploadImage($image)
    {
        if($this->status)
        {
           if($this->upload($image))
           {
               array_push($this->data, ["Status"=>"ok"]);
           }
           else
           {
               return $this->data;
           }
        }
        else
        {
            array_push($this->data, ["Status"=>"error", "Message"=>"Connection Problem"]);
        }
        return $this->data;
    }

    /**
     * check that the image is resize and inserted to the database
     * @param $image
     * @return bool
     */
    private function upload($image)
    {
        if($this->resizeImage($image))
        {
           $userId = $this->user->forceGetUserId();
           $userId = $this->user->decryptField($userId);
           $date   = date('Y-m-d H:m:s');
           $image  = $this->newImage;
           $this->query = "INSERT INTO image (UserID, image, approved, createdAt) VALUES ($userId, '$image', 0, '$date')";
           $this->result = $this->db->Select($this->query);
           if($this->result)
           {
               return true;
           }
           else
           {
               array_push($this->data, ["Status"=>"error", "Message"=>"error occurred during Image insertion"]);
           }
        }
        else
        {
           array_push($this->data, ["Status"=>"error", "Message"=>"error occurred during resizing image"]);
        }
        return false;
    }

    /**
     * Resize the image to the given co-ordinates
     * + WIDTH  512
     * + HEIGHT 512
     * @param $image
     * @return bool
     */
    private function resizeImage($image)
    {
        if( ($newImage =  imagescale($image,512,512 )) != false)
        {
            $this->newImage = $newImage;
            return true;
        }
        return false;
    }

}