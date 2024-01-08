<?php

namespace Harriswebworks\FAQ\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Category extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('harriswebworks_faq_category', 'category_id');
    }
}
