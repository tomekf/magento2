<?php

namespace Foggyline\Helpdesk\Controller\Ticket;

use Foggyline\Helpdesk\Controller\Ticket;
use \Magento\Framework\App\Action\Context;
use \Magento\Customer\Model\Session;
use \Magento\Framework\Mail\Template\TransportBuilder;
use \Magento\Framework\Translate\Inline\StateInterface;
use \Magento\Framework\App\Config\ScopeConfigInterface;
use \Magento\Store\Model\StoreManagerInterface;
use \Magento\Framework\Data\Form\FormKey\Validator;
use \Magento\Framework\Stdlib\DateTime;
use \Foggyline\Helpdesk\Model\TicketFactory;
use \Foggyline\Helpdesk\Model\Ticket as ModelTicket;

class Save extends Ticket
{
    protected $transportBuilder;
    protected $inlineTranslation;
    protected $scopeConfig;
    protected $storeManager;
    protected $formKeyValidator;
    protected $dateTime;
    protected $ticketFactory;

    public function __construct(
        Context $context,
        Session $customerSession,
        TransportBuilder $transportBuilder,
        StateInterface $inlineTranslation,
        ScopeConfigInterface $scopeConfig,
        StoreManagerInterface $storeManager,
        Validator $formKeyValidator,
        DateTime $dateTime,
        TicketFactory $ticketFactory
    )
    {
        $this->transportBuilder = $transportBuilder;
        $this->inlineTranslation = $inlineTranslation;
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
        $this->formKeyValidator = $formKeyValidator;
        $this->dateTime = $dateTime;
        $this->ticketFactory = $ticketFactory;
        $this->messageManager = $context->getMessageManager();

        parent::__construct($context, $customerSession);
    }

    public function execute()
    {

        $resultRedirect = $this->resultRedirectFactory->create();

        if (!$this->formKeyValidator->validate($this->getRequest())) {

            return $resultRedirect->setRefererUrl();
        }

        $title = $this->getRequest()->getParam('title');
        $severity = $this->getRequest()->getParam('severity');


        try {
            /* Save ticket*/
            $ticket = $this->ticketFactory->create();
            $ticket->setCustomerId($this->customerSession->getCustomerId());
            $ticket->setTitle($title);
            $ticket->setSeverity($severity);
            $ticket->setCreatedAt($this->dateTime->formatDate(true));
            $ticket->setStatus(ModelTicket::STATUS_OPENED);
            $ticket->save();

            $customer = $this->customerSession->getCustomerData();

            /**
             * send email to store owner
             */

//            $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
//            $transport = $this->transportBuilder->setTemplateIdentifier($this->scopeConfig->getValue('foggyline_helpdesk/email_template/store_owner', $storeScope))
//                ->setTemplateOptions([
//                    'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
//                    'store' => $this->storeManager->getStore()->getId(),
//                ])
//                ->setTemplateVars(['ticket' => $ticket])
//                ->setForm([
//                    'name' => $customer->getFirstname() . ' ' . $customer->getLastname(),
//                    'email' => $customer->getEmail()
//                ])
//                ->addTo($this->scopeConfig->getValue(
//                    'trans_email/ident_general/email', $storeScope
//                ))
//                ->getTransport();
//            $transport->sendMessage();
//            $this->inlineTranslation->resume();


            $this->messageManager->addSuccess(__('Ticket succesfully created.'));
        } catch (Exception $e) {
            $this->messageManager->addError(__('Error occured during ticket creation'));
        }

        return $resultRedirect->setRefererUrl();
    }
}