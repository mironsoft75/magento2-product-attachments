<?php

declare(strict_types=1);

namespace A3Naumov\ProductAttachments\Controller\Adminhtml\Attachments\Management;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

class Edit implements HttpGetActionInterface
{
    public function __construct(
        protected ResultFactory $resultFactory,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function execute(): ResultInterface
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $resultPage->setActiveMenu('A3Naumov_ProductAttachments::attachments_management');
        $resultPage->addBreadcrumb(
            __('New Attachment'),
            __('New Attachment'),
        );

        $resultPage->getConfig()->getTitle()
            ->prepend(__('New Attachment'));

        return $resultPage;
    }
}
