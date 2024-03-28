<?php

namespace Harriswebworks\FAQ\Controller\Adminhtml\Category;

use Magento\Framework\Controller\ResultFactory;
use Harriswebworks\FAQ\Model\Faq as Faq;

class Edit extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'Harriswebworks_FAQ::category_menu';
    protected $resultPageFactory;
    private $faqCollection;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        Faq $faqCollection
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->faqCollection = $faqCollection;
        parent::__construct($context);
    }
    /**
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('category_id');

        $relatedRecords = $this->faqCollection->getCollection()->addFieldToFilter('category_id', $id);

        if ($relatedRecords->getSize() > 0) {
            $this->messageManager->addError(__('Cannot edit this record as this category is used in faq.'));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index', ['category_id' => $id, '_current' => true]);
        } else {
            $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
            return $resultPage;
        }
    }
}
