<?php

declare(strict_types=1);

namespace A3Naumov\ProductAttachments\Model;

use A3Naumov\ProductAttachments\Api\Data\AttachmentInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractExtensibleModel;

class Attachment extends AbstractExtensibleModel implements IdentityInterface, AttachmentInterface
{
    public const CACHE_TAG = 'a3naumov_product_attachments_attachment';

    /**
     * @inheritDoc
     */
    protected function _construct(): void
    {
        $this->_init(ResourceModel\Attachment::class);
    }

    /**
     * @inheritDoc
     */
    public function getIdentities(): array
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
