<?php

namespace Foggyline\Helpdesk\Controller\Adminhtml\Ticket;


use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Edit extends Action
{
    protected $resultPageFactory =false;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    )
    {

        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {

        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Edit form'));

        return $resultPage;

    }
}