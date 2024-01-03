<?php
namespace Harriswebworks\FAQ\Model\ResourceModel\Category;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Harriswebworks\FAQ\Model\Category as CategoryModel;
use Harriswebworks\FAQ\Model\ResourceModel\Category as CategoryResourceModel;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'category_id';

    protected function _construct()
    {
        $this->_init(CategoryModel::class, CategoryResourceModel::class);
    }
}
