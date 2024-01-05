<?php
namespace Harriswebworks\FAQ\Model;

class Options implements \Magento\Framework\Data\OptionSourceInterface
{
    protected $_options;
    protected $storeManager;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->storeManager = $storeManager;
    }

    public function toOptionArray()
    {
        $options = [];

        $ids = ($this->storeManager->getStores());

        foreach ($ids as $value) {
            $options[] = ['label' => __($value->getName()), 'value' => $value->getId()];
        }
        return $options;
    }
}
