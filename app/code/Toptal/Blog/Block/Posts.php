<?php
/**
 * Created by PhpStorm.
 * User: tomekfabian
 * Date: 19.09.18
 * Time: 08:29
 */

namespace Toptal\Blog\Block;

use Magento\Framework\Data\CollectionFactory;
use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;
use Toptal\Blog\Model\Post;
use \Toptal\Blog\Model\ResourceModel\Post\Collection as PostCollection;
use \Toptal\Blog\Model\ResourceModel\Post\CollectionFactory as PostCollectionFactory;

class Posts extends Template
{
    /**
     * @var CollectionFactory
     */
    protected $_postCollectionFactory = null;

    public function __construct(
        Context $context,
        PostCollectionFactory $postCollectionFactory,
        array $data = []
    ) {
        $this->_postCollectionFactory = $postCollectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return Post[]
     */
    public function getPosts()
    {
        /**
         * @var PostCollection $postCollection
         */
        $postCollection = $this->_postCollectionFactory->create();
        $postCollection->addFieldToSelect('*')->load();

        return $postCollection->getItems();
    }

    /**
     * @param Post $post
     * @return string
     */
    public function getPostUrl(Post $post)
    {
        return '/blog/post/view/id/' . $post->getId();
    }
}