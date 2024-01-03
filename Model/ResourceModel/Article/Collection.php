<?php
namespace Harriswebworks\FAQ\Model\ResourceModel\Article;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Harriswebworks\FAQ\Model\Article as ArticleModel;
use Harriswebworks\FAQ\Model\ResourceModel\Article as ArticleResourceModel;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'faq_id';

    protected function _construct()
    {
        $this->_init(ArticleModel::class, ArticleResourceModel::class);
    }
}
