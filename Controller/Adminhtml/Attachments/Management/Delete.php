<?php

declare(strict_types=1);

namespace A3Naumov\ProductAttachments\Controller\Adminhtml\Attachments\Management;

use A3Naumov\ProductAttachments\Api\AttachmentRepositoryInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Message\ManagerInterface;

class Delete implements HttpPostActionInterface
{
    public function __construct(
        protected RequestInterface $request,
        protected ResultFactory $resultFactory,
        protected AttachmentRepositoryInterface $attachmentRepository,
        protected ManagerInterface $messageManager,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function execute(): ResultInterface
    {
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $id = $this->request->getParam('attachment_id');

        if ($id) {
            try {
                $attachment = $this->attachmentRepository->getById((int) $id);
                $this->attachmentRepository->delete($attachment);
                $this->messageManager->addSuccessMessage(__('You deleted the attachment.'));

                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['attachment_id' => $id]);
            }
        }

        $this->messageManager->addErrorMessage(__('We can\'t find a attachment to delete.'));

        return $resultRedirect->setPath('*/*/');
    }
}
