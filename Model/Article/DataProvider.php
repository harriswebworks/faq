<?php
namespace Harriswebworks\FAQ\Model\Article;

use Harriswebworks\FAQ\Model\ResourceModel\Article\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $collection;

    protected $loadedData;

    protected $dataPersistor;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $faqCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $faqCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();

        foreach ($items as $faq) {
            $this->loadedData[$faq->getId()] = $faq->getData();
        }

        $data = $this->dataPersistor->get('harriswebworks_faq');
        if (!empty($data)) {
            $faq = $this->collection->getNewEmptyItem();
            $faq->setData($data);
            $this->loadedData[$faq->getId()] = $faq->getData();
            $this->dataPersistor->clear('harriswebworks_faq');
        }

        return $this->loadedData ?? [];
    }
}
