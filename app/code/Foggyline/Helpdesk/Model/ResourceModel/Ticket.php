<?php

namespace Foggyline\Helpdesk\Model\ResourceModel;

class Ticket extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('foggyline_helpdesk_ticket', 'ticket_id');
    }
}