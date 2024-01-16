<?php
namespace Harriswebworks\FAQ\Block;

use Harriswebworks\FAQ\Model\ResourceModel\FAQ\Collection as FaqItemCollection;
use Harriswebworks\FAQ\Model\ResourceModel\Category\Collection as FaqCategoryCollection;
use Harriswebworks\FAQ\Model\Config;

class Faq extends \Magento\Framework\View\Element\Template
{
    protected $faqItemCollection;
    protected $faqCategoryCollection;
    protected $config;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        FaqItemCollection $faqItemCollection,
        FaqCategoryCollection $faqCategoryCollection,
        Config $config,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->faqItemCollection = $faqItemCollection;
        $this->faqCategoryCollection = $faqCategoryCollection;
        $this->config = $config;
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

    public function isModuleEnabled()
    {
        return $this->config->isEnabled();
    }

    public function getFaqTitle()
    {
        return $this->config->getFaqTitle();
    }

    public function isSearchEnabled()
    {
        return $this->config->isSearchEnabled();
    }


    public function isSidebarEnabled()
    {
        return $this->config->isSidebarEnabled();
    }

    public function isAskQuestionEnabled()
    {
        return $this->config->isAskQuestionEnabled();
    }
}
