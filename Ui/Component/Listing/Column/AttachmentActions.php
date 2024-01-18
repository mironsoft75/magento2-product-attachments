<?php

declare(strict_types=1);

namespace A3Naumov\ProductAttachments\Ui\Component\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class AttachmentActions extends Column
{
    protected const URL_PATH_EDIT = 'a3naumov/attachments_management/edit';
    protected const URL_PATH_DELETE = 'a3naumov/attachments_management/delete';

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        protected UrlInterface $urlBuilder,
        array $components = [],
        array $data = [],
    ) {
        parent::__construct(
            $context,
            $uiComponentFactory,
            $components,
            $data,
        );
    }

    /**
     * @inheirtDoc
     */
    public function prepareDataSource(array $dataSource): array
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                if (isset($item['attachment_id'])) {
                    $file = $item['file'];

                    $item[$this->getData('name')] = [
                        'edit' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_EDIT,
                                [
                                    'attachment_id' => $item['attachment_id'],
                                ],
                            ),
                            'label' => __('Edit'),
                        ],
                        'delete' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_DELETE,
                                [
                                    'attachment_id' => $item['attachment_id'],
                                ],
                            ),
                            'label' => __('Delete'),
                            'confirm' => [
                                'title' => __('Delete %1', $file),
                                'message' => __('Are you sure you want to delete a %1 record?', $file),
                            ],
                            'post' => true,
                        ],
                    ];
                }
            }
        }

        return $dataSource;
    }
}
