<?php

declare(strict_types=1);

namespace A3Naumov\ProductAttachments\Api;

use A3Naumov\ProductAttachments\Api\Data\AttachmentInterface;
use Magento\Framework\Exception\CouldNotSaveException;

interface AttachmentRepositoryInterface
{
    /**
     * @param AttachmentInterface $attachment
     * @return AttachmentInterface
     * @throws CouldNotSaveException
     */
    public function save(AttachmentInterface $attachment): AttachmentInterface;
}
