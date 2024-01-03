<?php
namespace Harriswebworks\FAQ\Model;

use Magento\Framework\Model\AbstractModel;

class Article extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Harriswebworks\FAQ\Model\ResourceModel\Article');
    }
}
