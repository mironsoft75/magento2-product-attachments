<?php

declare(strict_types=1);

namespace A3Naumov\ProductAttachments\Controller\Adminhtml\Attachments\Management;

use A3Naumov\ProductAttachments\Api\AttachmentRepositoryInterface;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Message\ManagerInterface;

class Edit implements HttpGetActionInterface
{
    public function __construct(
        protected RequestInterface $request,
        protected ResultFactory $resultFactory,
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
        $id = $this->request->getParam('attachment_id');

        if ($id) {
            try {
                $attachment = $this->attachmentRepository->getById((int)$id);
            } catch (NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage(__('This attachment no longer exists.'));
                $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

                return $resultRedirect->setPath('*/*/');
            }

            $this->dataPersistor->set('a3naumov_attachment', $attachment->getData());
        }

        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $resultPage->setActiveMenu('A3Naumov_ProductAttachments::attachments_management');
        $resultPage->addBreadcrumb(
            $id ? __('Edit Attachment' ) : __('New Attachment'),
            $id ? __('Edit Attachment' ) : __('New Attachment'),
        );

        $resultPage->getConfig()->getTitle()
            ->prepend($id
                ? __('Attachment %1', $id)
                : __('New Attachment'),
            );

        return $resultPage;
    }
}
