<?php
namespace Harriswebworks\FAQ\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Config
{
    const XML_PATH_ENABLED = 'faq/general/enabled';
    const XML_PATH_FAQ_TITLE = 'faq/general/faq_title';
    const XML_PATH_ENABLE_SEARCH = 'faq/general/enable_search';
    const XML_PATH_ENABLE_SIDEBAR = 'faq/general/enable_sidebar';
    const XML_PATH_ENABLE_QUESTION = 'faq/general/enable_ask_question';

    protected $scopeConfig;

    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    public function isEnabled()
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_ENABLED);
    }

    public function getFaqTitle()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_FAQ_TITLE);
    }

    public function isSearchEnabled()
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_ENABLE_SEARCH);
    }

    public function isSidebarEnabled()
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_ENABLE_SIDEBAR);
    }

    public function isAskQuestionEnabled(){
        return $this->scopeConfig->isSetFlag(self::XML_PATH_ENABLE_QUESTION);
    }
}
