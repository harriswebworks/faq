<?php

namespace Harriswebworks\FAQ\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Harriswebworks\FAQ\Model\FaqFactory;
use Harriswebworks\FAQ\Model\CategoryFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class AddData implements DataPatchInterface, PatchVersionInterface
{

    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var Faq
     */
    private $faqModel;

    /**
     * @var Category
     */
    private $faqCategoryModel;

    /**
     * @param FaqFactory $faqModel
     * @param CategoryFactory $faqCategoryModel
     */
    public function __construct(
        FaqFactory $faqModel,
        CategoryFactory $faqCategoryModel,
        ModuleDataSetupInterface $moduleDataSetup
    ) {
        $this->faqModel = $faqModel;
        $this->faqCategoryModel = $faqCategoryModel;
        $this->moduleDataSetup = $moduleDataSetup;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $this->moduleDataSetup->startSetup();

        // Add sample data for faq_category table
        $categoryData = [
            'category_name' => 'Sample Category 1'
        ];

        $this->faqCategoryModel->create()->addData($categoryData)->save();

        // Add sample data for faq table
        $faqData = [
            'question' => 'Sample Question',
            'answer' => 'Sample Answer',
            'category_id' => $this->faqCategoryModel->getId(),
            'sort_order' => 1,
            'is_enabled' => 1,
        ];

        $this->faqModel->create()->addData($faqData)->save();

        $this->moduleDataSetup->endSetup();
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public static function getVersion()
    {
        return '0.0.2'; // Update with your desired version
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
