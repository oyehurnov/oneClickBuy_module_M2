<?php

namespace Amida\OneClickBuy\Command\OneClickBuy;

use Amida\OneClickBuy\Api\Data\OneClickBuyInterface;
use Amida\OneClickBuy\Model\OneClickBuyModel;
use Amida\OneClickBuy\Model\OneClickBuyModelFactory;
use Amida\OneClickBuy\Model\ResourceModel\OneClickBuyResource;
use Exception;
use Magento\Framework\Exception\CouldNotSaveException;
use Psr\Log\LoggerInterface;

/**
 * Save OneClickBuy Command.
 */
class SaveCommand
{
    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @var OneClickBuyModelFactory
     */
    private OneClickBuyModelFactory $modelFactory;

    /**
     * @var OneClickBuyResource
     */
    private OneClickBuyResource $resource;

    /**
     * @param LoggerInterface $logger
     * @param OneClickBuyModelFactory $modelFactory
     * @param OneClickBuyResource $resource
     */
    public function __construct(
        LoggerInterface         $logger,
        OneClickBuyModelFactory $modelFactory,
        OneClickBuyResource     $resource
    )
    {
        $this->logger = $logger;
        $this->modelFactory = $modelFactory;
        $this->resource = $resource;
    }

    /**
     * Save OneClickBuy.
     *
     * @param OneClickBuyInterface $oneClickBuy
     *
     * @return int
     * @throws CouldNotSaveException
     */
    public function execute(OneClickBuyInterface $oneClickBuy): int
    {
        try {
            /** @var OneClickBuyModel $model */
            $model = $this->modelFactory->create();
            $model->addData($oneClickBuy->getData());
            $model->setHasDataChanges(true);

            if (!$model->getData(OneClickBuyInterface::ENTITY_ID)) {
                $model->isObjectNew(true);
            }
            $this->resource->save($model);
        } catch (Exception $exception) {
            $this->logger->error(
                __('Could not save OneClickBuy. Original message: {message}'),
                [
                    'message' => $exception->getMessage(),
                    'exception' => $exception
                ]
            );
            throw new CouldNotSaveException(__('Could not save OneClickBuy.'));
        }

        return (int)$model->getData(OneClickBuyInterface::ENTITY_ID);
    }
}
