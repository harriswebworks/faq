<?php

namespace Harriswebworks\FAQ\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;

class Actions extends Column
{
    const URL_PATH_EDIT = 'faq/form/edit';
    const URL_PATH_DELETE = 'faq/form/delete';

    /**
     * @var string
     */
    private $editUrl;

    /**
     * @var string
     */
    private $deleteUrl;

    /**
     * @param \Magento\Framework\View\Element\UiComponent\ContextInterface $context
     * @param \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     * @param string $editUrl
     * @param string $deleteUrl
     */
    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        \Magento\Framework\UrlInterface $urlBuilder,
        array $components = [],
        array $data = [],
        $editUrl = self::URL_PATH_EDIT,
        $deleteUrl = self::URL_PATH_DELETE
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->editUrl = $editUrl;
        $this->deleteUrl = $deleteUrl;

        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                if (isset($item['id'])) {
                    $item[$this->getData('name')]['edit'] = [
                        'href' => $this->urlBuilder->getUrl($this->editUrl, ['id' => $item['id']]),
                        'label' => __('Edit'),
                    ];
                    $item[$this->getData('name')]['delete'] = [
                        'href' => $this->urlBuilder->getUrl($this->deleteUrl, ['id' => $item['id']]),
                        'label' => __('Delete'),
                        'confirm' => [
                            'title' => __('Delete'),
                            'message' => __('Are you sure you want to delete this record?'),
                        ],
                    ];
                }
            }
        }

        return $dataSource;
    }
}
