<?php
namespace Foggyline\Helpdesk\Model\ResourceModel\Post;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'post_id';
	protected $_eventPrefix = 'foggyline_helpdesk_post_collection';
	protected $_eventObject = 'post_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Foggyline\Helpdesk\Model\Post', 'Foggyline\Helpdesk\Model\ResourceModel\Post');
	}

}