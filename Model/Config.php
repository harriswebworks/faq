<?php
namespace Harriswebworks\FAQ\Module\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Config
{
    const XML_PATH_ENABLED = 'faq/general/enabled';
    const XML_PATH_FAQ_TITLE = 'faq/general/faq_title';
    const XML_PATH_ENABLE_SIDEBAR = 'faq/general/enable_sidebar';

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

    public function isSidebarEnabled()
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_ENABLE_SIDEBAR);
    }
}
