<?php

declare(strict_types=1);

namespace A3Naumov\ProductAttachments\Model;

use A3Naumov\ProductAttachments\Api\AttachmentRepositoryInterface;
use A3Naumov\ProductAttachments\Api\Data\AttachmentInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\CouldNotSaveException;
use Psr\Log\LoggerInterface;

class AttachmentRepository implements AttachmentRepositoryInterface
{
    public function __construct(
        protected ResourceModel\Attachment $resourceModel,
        protected LoggerInterface $logger,
    ) {
    }

    /**
     * @inheirtDoc
     */
    public function save(AttachmentInterface $attachment): AttachmentInterface
    {
        try {
            $this->resourceModel->save($attachment);
        } catch (AlreadyExistsException $e) {
            $this->logger->critical($e);
            throw new CouldNotSaveException(__('Could not save attachment'), $e);
        }

        return $attachment;
    }
}
