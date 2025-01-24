<?php

namespace Amida\OneClickBuy\Controller\Adminhtml\OneClickBuy;

use Amida\OneClickBuy\Api\Data\OneClickBuyInterface;
use Amida\OneClickBuy\Api\Data\OneClickBuyInterfaceFactory;
use Amida\OneClickBuy\Command\OneClickBuy\SaveCommand;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\CouldNotSaveException;

/**
 * Save OneClickBuy controller action.
 */
class Save extends Action implements HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'Amida_OneClickBuy::management';

    /**
     * @var DataPersistorInterface
     */
    private DataPersistorInterface $dataPersistor;

    /**
     * @var SaveCommand
     */
    private SaveCommand $saveCommand;

    /**
     * @var OneClickBuyInterfaceFactory
     */
    private OneClickBuyInterfaceFactory $entityDataFactory;

    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param SaveCommand $saveCommand
     * @param OneClickBuyInterfaceFactory $entityDataFactory
     */
    public function __construct(
        Context                     $context,
        DataPersistorInterface      $dataPersistor,
        SaveCommand                 $saveCommand,
        OneClickBuyInterfaceFactory $entityDataFactory
    )
    {
        parent::__construct($context);
        $this->dataPersistor = $dataPersistor;
        $this->saveCommand = $saveCommand;
        $this->entityDataFactory = $entityDataFactory;
    }

    /**
     * Save OneClickBuy Action.
     *
     * @return ResponseInterface|ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $params = $this->getRequest()->getParams();

        try {
            /** @var OneClickBuyInterface|DataObject $entityModel */
            $entityModel = $this->entityDataFactory->create();
            $entityModel->addData($params['general']);
            $this->saveCommand->execute($entityModel);
            $this->messageManager->addSuccessMessage(
                __('The OneClickBuy data was saved successfully')
            );
            $this->dataPersistor->clear('entity');
        } catch (CouldNotSaveException $exception) {
            $this->messageManager->addErrorMessage($exception->getMessage());
            $this->dataPersistor->set('entity', $params);

            return $resultRedirect->setPath('*/*/edit', [
                OneClickBuyInterface::ENTITY_ID => $this->getRequest()->getParam(OneClickBuyInterface::ENTITY_ID)
            ]);
        }

        return $resultRedirect->setPath('*/*/');
    }
}
