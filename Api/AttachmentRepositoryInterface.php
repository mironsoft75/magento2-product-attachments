<?php

declare(strict_types=1);

namespace A3Naumov\ProductAttachments\Api;

use A3Naumov\ProductAttachments\Api\Data\AttachmentInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

interface AttachmentRepositoryInterface
{
    /**
     * @param int $id
     * @return AttachmentInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id): AttachmentInterface;

    /**
     * @param AttachmentInterface $attachment
     * @return AttachmentInterface
     * @throws CouldNotSaveException
     */
    public function save(AttachmentInterface $attachment): AttachmentInterface;

    /**
     * @param AttachmentInterface $attachment
     * @return void
     * @throws CouldNotDeleteException
     */
    public function delete(AttachmentInterface $attachment): void;
}
