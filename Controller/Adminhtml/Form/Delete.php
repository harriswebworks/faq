<?php
namespace Harriswebworks\FAQ\Controller\Adminhtml\Form;
use Harriswebworks\FAQ\Model\Faq as Faq;
use Magento\Backend\App\Action;

class Delete extends \Magento\Backend\App\Action
{
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        if (!($id = $this->_objectManager->create(Faq::class)->load($id))) {
            $this->messageManager->addError(__('Unable to proceed. Please, try again.'));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index', array('_current' => true));
        }
        try{
            $id->delete();
            $this->messageManager->addSuccess(__('Your id has been deleted !'));
        } catch (Exception $e) {
            $this->messageManager->addError(__('Error while trying to delete id: '));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('faq/index/index/');
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('faq/index/index/');
    }
}
