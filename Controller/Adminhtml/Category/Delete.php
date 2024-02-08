<?php

namespace Harriswebworks\FAQ\Controller\Adminhtml\Category;

use Harriswebworks\FAQ\Model\Category as Category;
use Harriswebworks\FAQ\Model\Faq as Faq;
use Magento\Backend\App\Action;

class Delete extends \Magento\Backend\App\Action
{

    private $categoryCollection;
    private $faqCollection;

    public function __construct(
        Category $categoryCollection,
        Faq $faqCollection,
        \Magento\Backend\App\Action\Context $context,
    ) {
        $this->categoryCollection = $categoryCollection;
        $this->faqCollection = $faqCollection;
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('category_id');

        if (!$id) {
            $this->messageManager->addError(__('Unable to proceed. Please, try again.'));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index', ['_current' => true]);
        }

        $categoryModel = $this->categoryCollection->load($id);

        $relatedRecords = $this->faqCollection->getCollection()->addFieldToFilter('category_id', $id);

        if ($relatedRecords->getSize() > 0) {
            $this->messageManager->addError(__('Cannot delete this record as this category is used in faq.'));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index', ['category_id' => $id, '_current' => true]);
        }

        try {
            $categoryModel->delete();
            $this->messageManager->addSuccess(__('Your id has been deleted!'));
        } catch (Exception $e) {
            $this->messageManager->addError(__('Error while trying to delete id: ' . $e->getMessage()));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('faq/category/index/');
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('faq/category/index/');
    }
}
