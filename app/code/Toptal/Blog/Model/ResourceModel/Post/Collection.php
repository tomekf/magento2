<?php
/**
 * Created by PhpStorm.
 * User: tomekfabian
 * Date: 19.09.18
 * Time: 07:44
 */
namespace Toptal\Blog\Model\ResourceModel\Post;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Toptal\Blog\Model\Post', 'Toptal\Blog\Model\ResourceModel\Post');
    }
}