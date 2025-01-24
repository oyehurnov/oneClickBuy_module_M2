<?php

namespace Amida\OneClickBuy\Command\OneClickBuy;

use Amida\OneClickBuy\Api\Data\OneClickBuyInterface;
use Amida\OneClickBuy\Model\OneClickBuyModel;
use Amida\OneClickBuy\Model\OneClickBuyModelFactory;
use Amida\OneClickBuy\Model\ResourceModel\OneClickBuyResource;
use Exception;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Psr\Log\LoggerInterface;

/**
 * Delete OneClickBuy by id Command.
 */
class DeleteByIdCommand
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
     * Delete OneClickBuy.
     *
     * @param int $entityId
     *
     * @return void
     * @throws CouldNotDeleteException
     */
    public function execute(int $entityId): void
    {
        try {
            /** @var OneClickBuyModel $model */
            $model = $this->modelFactory->create();
            $this->resource->load($model, $entityId, OneClickBuyInterface::ENTITY_ID);

            if (!$model->getData(OneClickBuyInterface::ENTITY_ID)) {
                throw new NoSuchEntityException(
                    __('Could not find OneClickBuy with id: `%id`',
                        [
                            'id' => $entityId
                        ]
                    )
                );
            }

            $this->resource->delete($model);
        } catch (Exception $exception) {
            $this->logger->error(
                __('Could not delete OneClickBuy. Original message: {message}'),
                [
                    'message' => $exception->getMessage(),
                    'exception' => $exception
                ]
            );
            throw new CouldNotDeleteException(__('Could not delete OneClickBuy.'));
        }
    }
}
