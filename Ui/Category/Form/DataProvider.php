<?php
namespace Harriswebworks\FAQ\Ui\Category\Form;

use Harriswebworks\FAQ\Model\ResourceModel\Category\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $loadedData;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $employeeCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $employeeCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $employeeCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    // public function getData()
    // {
    //     return [];
    // }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $categories = $this->collection;
        $this->loadedData = array();

        foreach ($categories as $category) {
            $this->loadedData[$category->getCategoryId()]['category_form'] = $category->getData();
        }

        return $this->loadedData;
    }
}
