<?php

namespace Harriswebworks\FAQ\Model\ResourceModel\Category;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Harriswebworks\FAQ\Model\Category;
use Harriswebworks\FAQ\Model\ResourceModel\Category as CategoryResource;
use Magento\InventoryLowQuantityNotification\Model\ResourceModel\SourceItemConfiguration\GetData;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'category_id';

    protected function _construct()
    {
        $this->_init(Category::class, CategoryResource::class);
    }
}
