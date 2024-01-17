<?php

declare(strict_types=1);

namespace A3Naumov\ProductAttachments\Controller\Adminhtml\Attachments\Management;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

class NewAction implements HttpGetActionInterface
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
        $resultForward = $this->resultFactory->create(ResultFactory::TYPE_FORWARD);

        return $resultForward->forward('edit');
    }
}
