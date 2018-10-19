<?php
/**
 * Created by PhpStorm.
 * User: tomekfabian
 * Date: 20.09.18
 * Time: 08:03
 */

namespace Foggyline\Helpdesk\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    protected $resultPageFactory = false;

    public function __construct(Context $context, PageFactory $resultPageFactory)
    {
            parent::__construct($context);
            $this->resultPageFactory = $resultPageFactory;

    }

    public function execute()
    {

        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend((__('Posts')));

        return $resultPage;
    }
}