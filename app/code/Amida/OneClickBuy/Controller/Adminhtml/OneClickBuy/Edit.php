<?php

namespace Amida\OneClickBuy\Controller\Adminhtml\OneClickBuy;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

/**
 * Edit OneClickBuy entity backend controller.
 */
class Edit extends Action implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session.
     *
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'Amida_OneClickBuy::management';

    /**
     * Edit OneClickBuy action.
     *
     * @return Page|ResultInterface
     */
    public function execute()
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Amida_OneClickBuy::management');
        $resultPage->getConfig()->getTitle()->prepend(__('Edit OneClickBuy'));

        return $resultPage;
    }
}
