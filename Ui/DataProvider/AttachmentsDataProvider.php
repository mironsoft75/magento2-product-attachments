<?php

declare(strict_types=1);

namespace A3Naumov\ProductAttachments\Ui\DataProvider;

use A3Naumov\ProductAttachments\Model\ResourceModel\Attachment\Collection;
use A3Naumov\ProductAttachments\Model\ResourceModel\Attachment\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;

class AttachmentsDataProvider extends AbstractDataProvider
{
    /**
     * @var Collection
     */
    protected $collection;

    public function __construct(
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
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
     * @inheritDoc
     */
    public function getData(): array
    {
        if (!$this->getCollection()->isLoaded()) {
            $this->getCollection()->load();
        }

        $items = $this->getCollection()->toArray();

        return [
            'totalRecords' => $this->getCollection()->getSize(),
            'items' => array_values($items['items']),
        ];
    }
}
