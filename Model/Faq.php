<?php

namespace Harriswebworks\FAQ\Model;

use Magento\Framework\Model\AbstractModel;

class Faq extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Harriswebworks\FAQ\Model\ResourceModel\Faq::class);
    }
    public function create(array $data = [])
    {
        return [];
    }
}
