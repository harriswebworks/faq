<?php
namespace Harriswebworks\FAQ\Model;

class Options implements \Magento\Framework\Data\OptionSourceInterface
{
    protected $_options;
    protected $categoryCollection;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Harriswebworks\FAQ\Model\ResourceModel\Category\CollectionFactory $categoryCollection
    ) {
        $this->categoryCollection = $categoryCollection;
    }

    public function toOptionArray()
    {
        $options = [];

        $ids = ($this->categoryCollection->create());

        foreach ($ids as $value) {
            $options[] = ['label' => __($value->getCategoryName()), 'value' => $value->getCategoryId()];
        }
        return $options;
    }
}
