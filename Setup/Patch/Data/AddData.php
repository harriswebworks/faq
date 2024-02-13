<?php

namespace Harriswebworks\FAQ\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Harriswebworks\FAQ\Model\FaqFactory;
use Harriswebworks\FAQ\Model\CategoryFactory;

class AddData implements DataPatchInterface, PatchVersionInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     */

     /**
     * @var Faq
     */
    private $faqModel;

    /**
     * @var Category
     */
    private $faqCategoryModel;


    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        FaqFactory $faqModel,
        CategoryFactory $faqCategoryModel
    ) {
        /**
         * If before, we pass $setup as argument in install/upgrade function, from now we start
         * inject it with DI. If you want to use setup, you can inject it, with the same way as here
         */
        $this->moduleDataSetup = $moduleDataSetup;
        $this->faqModel = $faqModel;
        $this->faqCategoryModel = $faqCategoryModel;
    }

    /**
     * @inheritdoc
     */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        // Add sample data for faq_category table
        $categoryData = [
            ['category_name' => 'Sales'],
            ['category_name' => 'Store'],
            ['category_name' => 'Documentation']
        ];

        foreach ($categoryData as $category){
            $faqCat = $this->faqCategoryModel->create();
            $faqCat->addData($category);
            $faqCat->save();
        }

        // Add sample data for faq table
        $faqData = [
            [
                'question' => 'How can I ensure the security of my Magento store?',
                'answer' => 'Magento regularly releases security patches and updates. It\'s crucial to keep your Magento installation, themes, and extensions up to date. Additionally, implementing secure hosting practices, using strong passwords, and monitoring for suspicious activities are essential for maintaining security.',
                'category_id' => 2,
                'sort_order' => 10,
                'is_enabled' => 1
            ],
            [
                'question' => 'Can Magento handle multiple languages and currencies for international sales?',
                'answer' => 'Yes, Magento supports multi-language and multi-currency functionality. You can configure your store to cater to a global audience by setting up different languages, currencies, and tax rules based on the location of your customers.',
                'category_id' => 1,
                'sort_order' => 20,
                'is_enabled' => 1,
            ],
            [
                'question' => 'Can I customize the look and feel of my Magento store?',
                'answer' => 'Yes, Magento allows extensive customization of the store\'s appearance. You can choose from various themes, or create your own custom theme. Additionally, you can modify templates, layouts, and styles to tailor the design to your brand.',
                'category_id' => 2,
                'sort_order' => 30,
                'is_enabled' => 1,
            ],
            [
                'question' => 'Where can I find support and documentation for Magento?',
                'answer' => 'The official Magento website provides extensive documentation, user guides, and forums for community support. You can also explore online forums, blogs, and third-party resources for additional insights and assistance.',
                'category_id' => 3,
                'sort_order' => 40,
                'is_enabled' => 1,
            ]

        ];

        foreach ($faqData as $faq){
            $this->faqModel->create()->addData($faq)->save();
        }

        //The code that you want apply in the patch
        //Please note, that one patch is responsible only for one setup version
        //So one UpgradeData can consist of few data patches
        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * @inheritdoc
     */
    public static function getDependencies()
    {
        return [];
    }

    public function revert()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        //Here should go code that will revert all operations from `apply` method
        //Please note, that some operations, like removing data from column, that is in role of foreign key reference
        //is dangerous, because it can trigger ON DELETE statement
        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * @inheritdoc
     */
    public function getAliases()
    {
        /**
         * This internal method, that means that some patches with time can change their names,
         * but changing name should not affect installation process, that's why if we will change name of the patch
         * we will add alias here
         */
        return [];
    }

    public static function getVersion()
    {
        return '0.0.3'; // Update with your desired version
    }
}
