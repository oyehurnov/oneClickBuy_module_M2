<?php

namespace Amida\OneClickBuy\Controller\Adminhtml\OneClickBuy;

use Amida\OneClickBuy\Api\Data\OneClickBuyInterface;
use Amida\OneClickBuy\Command\OneClickBuy\DeleteByIdCommand;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Delete OneClickBuy controller.
 */
class Delete extends Action implements HttpPostActionInterface, HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session.
     *
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'Amida_OneClickBuy::management';

    /**
     * @var DeleteByIdCommand
     */
    private DeleteByIdCommand $deleteByIdCommand;

    /**
     * @param Context $context
     * @param DeleteByIdCommand $deleteByIdCommand
     */
    public function __construct(
        Context           $context,
        DeleteByIdCommand $deleteByIdCommand
    )
    {
        parent::__construct($context);
        $this->deleteByIdCommand = $deleteByIdCommand;
    }

    /**
     * Delete OneClickBuy action.
     *
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var ResultInterface $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath('*/*/');
        $entityId = (int)$this->getRequest()->getParam(OneClickBuyInterface::ENTITY_ID);

        try {
            $this->deleteByIdCommand->execute($entityId);
            $this->messageManager->addSuccessMessage(__('You have successfully deleted OneClickBuy entity'));
        } catch (CouldNotDeleteException|NoSuchEntityException $exception) {
            $this->messageManager->addErrorMessage($exception->getMessage());
        }

        return $resultRedirect;
    }
}
