<?php

namespace Amida\OneClickBuy\Controller\Adminhtml\OneClickBuy;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

/**
 * OneClickBuy backend index (list) controller.
 */
class Index extends Action implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session.
     */
    public const ADMIN_RESOURCE = 'Amida_OneClickBuy::management';

    /**
     * Execute action based on request and return result.
     *
     * @return ResultInterface|ResponseInterface
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $resultPage->setActiveMenu('Amida_OneClickBuy::management');
        $resultPage->addBreadcrumb(__('OneClickBuy'), __('OneClickBuy'));
        $resultPage->addBreadcrumb(__('Manage OneClickBuys'), __('Manage OneClickBuys'));
        $resultPage->getConfig()->getTitle()->prepend(__('OneClickBuy List'));

        return $resultPage;
    }
}
