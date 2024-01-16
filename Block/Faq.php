<?php
namespace Harriswebworks\FAQ\Block;

use Harriswebworks\FAQ\Model\ResourceModel\FAQ\Collection as FaqItemCollection;
use Harriswebworks\FAQ\Model\ResourceModel\Category\Collection as FaqCategoryCollection;

class Faq extends \Magento\Framework\View\Element\Template
{
    protected $faqItemCollection;
    protected $faqCategoryCollection;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        FaqItemCollection $faqItemCollection,
        FaqCategoryCollection $faqCategoryCollection,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->faqItemCollection = $faqItemCollection;
        $this->faqCategoryCollection = $faqCategoryCollection;
    }

    public function getFaqItems()
    {
        return $this->faqItemCollection
            ->addFieldToFilter('is_enabled', 1)
            ->getItems();
    }

    public function getFaqCategories()
    {
        return $this->faqCategoryCollection->getItems();
    }
}
