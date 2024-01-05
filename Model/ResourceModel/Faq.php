<?php

namespace Harriswebworks\FAQ\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Faq extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('harriswebworks_faq', 'id');
    }
}
