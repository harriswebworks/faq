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
            ['category_name' => 'Sample Category 1'],
            ['category_name' => 'Sample Category 2'],
            ['category_name' => 'Sample Category 3']
        ];

        foreach ($categoryData as $category){
            $faqCat = $this->faqCategoryModel->create();
            $faqCat->addData($category);
            $faqCat->save();
        }



        // Add sample data for faq table
        $faqData = [
            [
                'question' => 'Sample Question',
                'answer' => 'Sample Answer',
                'category_id' => $faqCat->getId(),
                'sort_order' => 1,
                'is_enabled' => 1
            ],
            [
                'question' => 'Sample Question',
                'answer' => 'Sample Answer',
                'category_id' => $faqCat->getId(),
                'sort_order' => 1,
                'is_enabled' => 1,
            ],
            [
                'question' => 'Sample Question',
                'answer' => 'Sample Answer',
                'category_id' => $faqCat->getId(),
                'sort_order' => 1,
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
