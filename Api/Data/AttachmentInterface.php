<?php

declare(strict_types=1);

namespace A3Naumov\ProductAttachments\Api\Data;

use Magento\Framework\Api\CustomAttributesDataInterface;

interface AttachmentInterface extends CustomAttributesDataInterface
{
    public const ID = 'attachment_id';
}
