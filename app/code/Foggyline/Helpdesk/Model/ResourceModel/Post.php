<?php

namespace Foggyline\Helpdesk\Model\ResourceModel;

class Post extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('mageplaza_helloworld_post', 'post_id');
    }
}