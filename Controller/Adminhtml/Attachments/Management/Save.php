<?php

declare(strict_types=1);

namespace A3Naumov\ProductAttachments\Controller\Adminhtml\Attachments\Management;

use A3Naumov\ProductAttachments\Api\AttachmentRepositoryInterface;
use A3Naumov\ProductAttachments\Api\Data\AttachmentInterfaceFactory;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Message\ManagerInterface;

class Save implements HttpPostActionInterface
{
    public function __construct(
        protected RequestInterface $request,
        protected ResultFactory $resultFactory,
        protected AttachmentInterfaceFactory $attachmentFactory,
        protected AttachmentRepositoryInterface $attachmentRepository,
        protected ManagerInterface $messageManager,
        protected DataPersistorInterface $dataPersistor,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function execute(): ResultInterface
    {
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $data = $this->request->getPostValue();

        if ($data) {
            $attachment = $this->attachmentFactory->create();
            $attachment->setData($data);

            try {
                $this->attachmentRepository->save($attachment);
                $this->messageManager->addSuccessMessage(__('You saved the attachment.'));
                $this->dataPersistor->clear('a3naumov_attachment');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                $this->dataPersistor->set('a3naumov_attachment', $data);

                return $resultRedirect->setPath('*/*/edit', ['id' => $attachment->getId()]);
            }
        }

        return $resultRedirect->setPath('*/*/');
    }
}
