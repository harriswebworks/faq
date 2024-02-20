<?php

namespace Harriswebworks\FAQ\Controller\Adminhtml\Form;

use Harriswebworks\FAQ\Model\Faq as FaqFactory;
use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

class Save extends Action
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
        $postData = $this->getRequest()->getParam('faq_form');
        $id = $this->getRequest()->getParam('id');
        if ($id === null && isset($postData['id'])) {
            $id = $postData['id'];
        }

        if ($postData) {
            if ($this->isSortOrderUnique($postData['sort_order'], $id)) {
                try {
                    $faqModel = $this->faqFactory;

                    if ($id) {
                        $faqModel->load($id);
                    }

                    $faqModel->setData($postData);
                    $faqModel->save();

                    $this->messageManager->addSuccessMessage(__('FAQ was successfully saved.'));

                    if ($this->getRequest()->getParam('back')) {
                        return $this->resultRedirectFactory->create()->setPath(
                            'faq/form/edit',
                            ['id' => $faqModel->getId(), '_current' => true]
                        );
                    }

                    return $this->resultRedirectFactory->create()->setPath('faq/index/index');
                } catch (\Exception $e) {
                    $this->messageManager->addErrorMessage($e->getMessage());
                }
            } else {
                $this->messageManager->addErrorMessage(__('Please change the Sort Order. Sort Order must be unique.'));
            }
        }
        return $this->resultRedirectFactory->create()->setPath('faq/form/edit/', ['id' => $id]);
    }

    /**
     * @param string $sortOrder
     * @param int|null $currentId
     * @return bool
     */
    private function isSortOrderUnique($sortOrder, $currentId = null)
    {
        $faqCollection = $this->faqFactory->getCollection();
        $faqCollection->addFieldToFilter('sort_order', $sortOrder);

        if ($currentId !== null) {
            $faqCollection->addFieldToFilter('id', ['neq' => $currentId]);
        }

        return $faqCollection->getSize() == 0;
    }
}
