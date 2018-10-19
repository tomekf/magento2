<?php
namespace Foggyline\Helpdesk\Model;
class Post extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'foggyline_helpdesk_post';

	protected $_cacheTag = 'foggyline_helpdesk_post';

	protected $_eventPrefix = 'foggyline_helpdesk_post';

	protected function _construct()
	{
		$this->_init('Foggyline\Helpdesk\Model\ResourceModel\Post');
	}

	public function getIdentities()
	{
		return [self::CACHE_TAG . '_' . $this->getId()];
	}

	public function getDefaultValues()
	{
		$values = [];

		return $values;
	}
}