<?php

declare(strict_types=1);

namespace A3Naumov\ProductAttachments\Model;

use A3Naumov\ProductAttachments\Api\AttachmentRepositoryInterface;
use A3Naumov\ProductAttachments\Api\Data\AttachmentInterface;
use A3Naumov\ProductAttachments\Api\Data\AttachmentInterfaceFactory;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Psr\Log\LoggerInterface;

class AttachmentRepository implements AttachmentRepositoryInterface
{
    public function __construct(
        protected ResourceModel\Attachment $resourceModel,
        protected AttachmentInterfaceFactory $attachmentFactory,
        protected LoggerInterface $logger,
    ) {
    }

    /**
     * @inheirtDoc
     */
    public function getById(int $id): AttachmentInterface
    {
        $attachment = $this->attachmentFactory->create();
        $this->resourceModel->load($attachment, $id, AttachmentInterface::ID);

        if ($attachment->getId() === null) {
            throw new NoSuchEntityException(
                __('Attachment with id "%id" does not exist.', ['id' => $id]),
            );
        }

        return $attachment;
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

    /**
     * @inheirtDoc
     */
    public function delete(AttachmentInterface $attachment): void
    {
        try {
            $this->resourceModel->delete($attachment);
        } catch (\Exception $e) {
            $this->logger->critical($e);

            throw new CouldNotDeleteException(__('Could not delete attachment'), $e);
        }
    }
}
