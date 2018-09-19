<?php
/**
 * Created by PhpStorm.
 * User: tomekfabian
 * Date: 19.09.18
 * Time: 08:06
 */

namespace Toptal\Blog\Controller\Index;

use \Magento\Framework\App\Action\Action;
use \Magento\Framework\View\Result\PageFactory;
use \Magento\Framework\View\Result\Page;
use \Magento\Framework\App\Action\Context;
use \Magento\Framework\Exception\LocalizedException;

class Index extends Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * Index constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * @return Page
     * @throws LocalizedException
     */
    public function execute()
    {

        $resultPage =$this->resultPageFactory->create();

        return $resultPage;
    }
}