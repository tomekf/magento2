<?php

namespace Foggyline\Helpdesk\Model\ResourceModel\Ticket;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
       $this->_init('Foggyline\Helpdesk\Model\Ticket', 'Foggyline\Helpdesk\Model\ResourceModel\Ticket');
    }
}