<?php

namespace Harriswebworks\FAQ\Controller\Adminhtml\Article;

class Article extends \Magento\Backend\App\Action
{
	protected $resultPageFactory = false;

	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory
	) {
		parent::__construct($context);
		$this->resultPageFactory = $resultPageFactory;
	}

	public function execute()
	{
		$resultPage = $this->resultPageFactory->create();
		$resultPage->getConfig()->getTitle()->prepend((__('Articles')));

		return $resultPage;
	}

	protected function _isAllowed()
	{
		return $this->_authorization->isAllowed('Harriswebworks_FAQ::faq_articles');
	}
}
