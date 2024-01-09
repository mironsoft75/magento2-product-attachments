<?php

declare(strict_types=1);

namespace A3Naumov\ProductAttachments\Model\ResourceModel\Attachment;

use A3Naumov\ProductAttachments\Model\Attachment as Model;
use A3Naumov\ProductAttachments\Model\ResourceModel\Attachment as ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @inheritDoc
     */
    protected function _construct(): void
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
