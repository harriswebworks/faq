<?php

namespace Harriswebworks\FAQ\Controller\Adminhtml\Form;

use Harriswebworks\FAQ\Model\Faq as Faq;
use Magento\Backend\App\Action;

class Delete extends \Magento\Backend\App\Action
{
    private $faqCollection;

    public function __construct(
        Faq $faqCollection,
        \Magento\Backend\App\Action\Context $context,
    ) {
        $this->faqCollection = $faqCollection;
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        if (!$id) {
            $this->messageManager->addError(__('Unable to proceed. Please, try again.'));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index', ['_current' => true]);
        }

        $faqModel = $this->faqCollection->load($id);

        try {
            $faqModel->delete();
            $this->messageManager->addSuccess(__('Your id has been deleted!'));
        } catch (Exception $e) {
            $this->messageManager->addError(__('Error while trying to delete id: ' . $e->getMessage()));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('faq/index/index');
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('faq/index/index');
    }
}
