<?php

namespace Harriswebworks\FAQ\Model\ResourceModel\FAQ;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Harriswebworks\FAQ\Model\Faq;
use Harriswebworks\FAQ\Model\ResourceModel\Faq as FaqResource;
use Magento\InventoryLowQuantityNotification\Model\ResourceModel\SourceItemConfiguration\GetData;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';

    protected function _construct()
    {
        $this->_init(Faq::class, FaqResource::class);
    }
}
