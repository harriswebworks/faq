<?php
// app/code/Vendor/FAQ/Controller/Index/SubmitQuestion.php

namespace Harriswebworks\FAQ\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Harriswebworks\FAQ\Model\FaqFactory;

class SubmitQuestion extends Action
{
    protected $faqItemFactory;

    public function __construct(
        Context $context,
        FaqFactory $faqItemFactory
    ) {
        parent::__construct($context);
        $this->faqItemFactory = $faqItemFactory;
    }

    public function execute()
    {
        $postData = $this->getRequest()->getPostValue();
        
        if ($postData) {
            $categoryId = $postData['category'];

            // Create a new FAQ item with the submitted question and selected category
            $faqItem = $this->faqItemFactory->create();
            $faqItem->setData([
                'question' => $postData['question'],
                'answer' => '', // You can set an empty answer or handle it as needed
                'category_id' => $categoryId,
            ]);
            
            // Save the FAQ item
            $faqItem->save();

            $this->messageManager->addSuccessMessage(__('Your question has been submitted successfully.'));
        }

        // Redirect back to the FAQ page
        $this->_redirect('faq/');
    }
}
