<?php
namespace Harriswebworks\FAQ\Controller\Index;
use Harriswebworks\FAQ\Block\Faq;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    protected $response;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
       \Magento\Framework\App\Action\Context $context,
       \Magento\Framework\View\Result\PageFactory $pageFactory,
       Faq $response
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->response = $response;
        return parent::__construct($context);
    }
    /**
     * View page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        if($this->response->isModuleEnabled()){
            return $this->_pageFactory->create();
        }
    }
}
