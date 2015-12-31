<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/31/2015
 * Time: 1:35 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Entity/BlockList.php');

class BlockListController {

    /**
     * Block the user which is annoying
     * @param $partnerId
     * @param $reason
     * @return array
     */
    public function BlockUser($partnerId, $reason)
    {
        $Object = new BlockList();
        $result = $Object->addToBlockList($partnerId,$reason);
        return $result;
    }

    /**
     * remove the block constraint from partner
     * @param $partnerId
     * @return array
     */
    public function removeBlock( $partnerId)
    {
        $Object = new BlockList();
        $result = $Object->removeBlock($partnerId);
        return $result;
    }

    /**
     * get the user Ban list
     * @return array
     */
    public function getBanList()
    {
        $Object = new BlockList();
        $result = $Object->getBlockList();
        return $result;
    }
}