<?php

namespace Amida\OneClickBuy\Block\Form\OneClickBuy;

use Amida\OneClickBuy\Api\Data\OneClickBuyInterface;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Delete entity button.
 */
class Delete extends GenericButton implements ButtonProviderInterface
{
    /**
     * Retrieve Delete button settings.
     *
     * @return array
     */
    public function getButtonData(): array
    {
        if (!$this->getEntityId()) {
            return [];
        }

        return $this->wrapButtonSettings(
            __('Delete')->getText(),
            'delete',
            sprintf("deleteConfirm('%s', '%s')",
                __('Are you sure you want to delete this oneclickbuy?'),
                $this->getUrl(
                    '*/*/delete',
                    [OneClickBuyInterface::ENTITY_ID => $this->getEntityId()]
                )
            ),
            [],
            20
        );
    }
}
