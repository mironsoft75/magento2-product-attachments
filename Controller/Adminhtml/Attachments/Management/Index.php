<?php

declare(strict_types=1);

namespace A3Naumov\ProductAttachments\Controller\Adminhtml\Attachments\Management;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;

class Index implements HttpGetActionInterface
{
    public function __construct(
        protected PageFactory $pageFactory,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function execute(): ResultInterface
    {
        $resultPage = $this->pageFactory->create();
        $resultPage->setActiveMenu('A3Naumov_ProductAttachments::attachments_management');
        $resultPage->getConfig()->getTitle()->prepend(__('Attachments Management'));

        return $resultPage;
    }
}
