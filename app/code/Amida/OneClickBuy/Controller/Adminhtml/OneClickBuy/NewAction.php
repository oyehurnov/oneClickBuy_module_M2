<?php

namespace Amida\OneClickBuy\Controller\Adminhtml\OneClickBuy;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

/**
 * New action OneClickBuy controller.
 */
class NewAction extends Action implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session.
     *
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'Amida_OneClickBuy::management';

    /**
     * Create new OneClickBuy action.
     *
     * @return Page|ResultInterface
     */
    public function execute()
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Amida_OneClickBuy::management');
        $resultPage->getConfig()->getTitle()->prepend(__('New OneClickBuy'));

        return $resultPage;
    }
}
