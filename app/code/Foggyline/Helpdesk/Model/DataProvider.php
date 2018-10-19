<?php
/**
 * Created by PhpStorm.
 * User: tomekfabian
 * Date: 26.09.18
 * Time: 08:26
 */

namespace Foggyline\Helpdesk\Model;

use Foggyline\Helpdesk\Model\ResourceModel\Ticket\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $_loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $ticketCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $ticketCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
       if (isset($this->_loadedData)) {
           return $this->_loadedData;
       }
       $items = $this->collection->getItems();
       foreach ($items as $ticket) {
           $this->_loadedData[$ticket->getId()] = $ticket->getData();
       }

       return $this->_loadedData;
    }
}