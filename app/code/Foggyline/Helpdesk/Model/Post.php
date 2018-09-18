<?php

namespace Foggyline\Helpdesk\Model;

use Magento\Rule\Model\AbstractModel;

class Ticket extends \Magento\Framework\Model\AbstractModel
{


    protected function _construct()
    {
        $this->_init('Foggyline\Helpdesk\Model\ResourceModel\Post');
    }

}