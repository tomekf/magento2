<?php

namespace Foggyline\Helpdesk\Controller\Adminhtml;

use Magento\Backend\App\Action;

class Ticket extends \Magento\Backend\App\Action
{
    public function __construct(Action\Context $context)
    {

        parent::__construct($context);
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Foggyline_Helpdesk::ticket_manage');
    }

    protected function _initAction()
    {
        $this->_view->loadLayout();
        $this->_setActiveMenu('Foggyline_Helpdesk::ticket_manage')
            ->_addBreadcrumb(__('Helpdesk'), __('Tickets'));

        return $this;
    }

    public function execute()
    {
        // TODO: Implement execute() method.
    }
}