<?php

declare(strict_types=1);

namespace A3Naumov\ProductAttachments\Model\Attachment;

use A3Naumov\ProductAttachments\Model\Attachment;
use A3Naumov\ProductAttachments\Model\ResourceModel\Attachment\Collection;
use A3Naumov\ProductAttachments\Model\ResourceModel\Attachment\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\ModifierPoolDataProvider;

class DataProvider extends ModifierPoolDataProvider
{
    /**
     * @var Collection
     */
    protected $collection;

    protected array $loadedData = [];

    public function __construct(
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        protected DataPersistorInterface $dataPersistor,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = [],
    ) {
        $this->collection = $collectionFactory->create();
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $meta,
            $data,
        );
    }

    /**
     * @inheirtDoc
     */
    public function getData(): array
    {
        if (!empty($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();

        /** @var Attachment $attachment */
        foreach ($items as $attachment) {
            $this->loadedData[$attachment->getId()] = $attachment->getData();
        }

        $data = $this->dataPersistor->get('a3naumov_attachment');

        if (!empty($data)) {
            $attachment = $this->collection->getNewEmptyItem();
            $attachment->setData($data);

            $this->loadedData[$attachment->getId()] = $attachment->getData();

            $this->dataPersistor->clear('a3naumov_attachment');
        }

        return $this->loadedData;
    }
}
