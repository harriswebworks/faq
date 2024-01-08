<?php

namespace Harriswebworks\FAQ\Model;

use Magento\Framework\Model\AbstractModel;

class Category extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Harriswebworks\FAQ\Model\ResourceModel\Category::class);
    }
    public function create(array $data = [])
    {
        return [];
    }
}
