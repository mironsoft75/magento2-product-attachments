<?php

declare(strict_types=1);

namespace A3Naumov\ProductAttachments\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Attachment extends AbstractDb
{
    /**
     * @inheritDoc
     */
    protected function _construct(): void
    {
        $this->_init('a3naumov_attachment', 'attachment_id');
    }
}
