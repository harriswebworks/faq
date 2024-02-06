<?php

namespace Harriswebworks\FAQ\Model;

use Magento\Framework\Model\AbstractModel;

class Faq extends AbstractModel
{
    protected $_idFieldName = 'id';

    protected $_cacheTag = 'harriswebworks_faq';

    protected $_eventPrefix = 'harriswebworks_faq';

    protected $_visible = [
        'id',
        'question',
        'answer',
        'sort_order',
        'category_id',
        'is_enabled', // Add this line
    ];
    protected function _construct()
    {
        $this->_init(\Harriswebworks\FAQ\Model\ResourceModel\Faq::class);
    }

    public function getIsEnabled()
    {
        return $this->_getData('is_enabled');
    }

    public function setIsEnabled($isEnabled)
    {
        return $this->setData('is_enabled', $isEnabled);
    }

    // public function create(array $data = [])
    // {
    //     $this->setData($data);
    //     $this->save();
    //     return $this;
    // }
}
