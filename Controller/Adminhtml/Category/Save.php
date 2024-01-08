<?php

namespace Harriswebworks\FAQ\Controller\Adminhtml\Category;

use Harriswebworks\FAQ\Model\Category as CategoryFactory;

class Save extends \Magento\Backend\App\Action
{
    private $categoryFactory;
    protected $storeManager;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        CategoryFactory $categoryFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->categoryFactory = $categoryFactory;
        $this->storeManager = $storeManager;
        parent::__construct($context);
    }

    public function execute()
    {
        $post = $this->categoryFactory
            ->setData($this->getRequest()->getParam('category_form'));

        $post->save();
        return $this->resultRedirectFactory->create()->setPath('faq/category/index');
    }
}
