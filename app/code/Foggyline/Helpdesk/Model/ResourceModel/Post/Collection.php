<?php

namespace Foggyline\Helpdesk\Model\ResourceModel\Post;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
       $this->_init('Foggyline\Helpdesk\Model\Post', 'Foggyline\Helpdesk\Model\ResourceModel\Post');
    }
}