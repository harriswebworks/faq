<?php
namespace Harriswebworks\FAQ\Ui\Form;

use Harriswebworks\FAQ\Model\ResourceModel\FAQ\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    
    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $faqCollectionFactory
     * @param array $meta
     * @param array $data
     */

    protected $loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $faqCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $faqCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $faqs = $this->collection;
        $this->loadedData = array();

        foreach ($faqs as $faq) {
            $this->loadedData[$faq->getId()]['faq_form'] = $faq->getData();
        }

        return $this->loadedData;
    }
}
