<?php

namespace Harriswebworks\FAQ\Controller\Adminhtml\Form;

use Harriswebworks\FAQ\Model\Faq as FaqFactory;

class Save extends \Magento\Backend\App\Action
{
    private $faqFactory;
    protected $storeManager;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        FaqFactory $faqFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->faqFactory = $faqFactory;
        $this->storeManager = $storeManager;
        parent::__construct($context);
    }

    public function execute()
    {
        $post = $this->faqFactory
            ->setData($this->getRequest()->getParam('faq_form'));

        $post->save();
        return $this->resultRedirectFactory->create()->setPath('faq/index/index');
    }
}
