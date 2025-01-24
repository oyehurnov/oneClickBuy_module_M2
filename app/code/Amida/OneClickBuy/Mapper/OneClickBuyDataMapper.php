<?php

namespace Amida\OneClickBuy\Mapper;

use Amida\OneClickBuy\Api\Data\OneClickBuyInterface;
use Amida\OneClickBuy\Api\Data\OneClickBuyInterfaceFactory;
use Amida\OneClickBuy\Model\OneClickBuyModel;
use Magento\Framework\DataObject;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Converts a collection of OneClickBuy entities to an array of data transfer objects.
 */
class OneClickBuyDataMapper
{
    /**
     * @var OneClickBuyInterfaceFactory
     */
    private OneClickBuyInterfaceFactory $entityDtoFactory;

    /**
     * @param OneClickBuyInterfaceFactory $entityDtoFactory
     */
    public function __construct(
        OneClickBuyInterfaceFactory $entityDtoFactory
    )
    {
        $this->entityDtoFactory = $entityDtoFactory;
    }

    /**
     * Map magento models to DTO array.
     *
     * @param AbstractCollection $collection
     *
     * @return array|OneClickBuyInterface[]
     */
    public function map(AbstractCollection $collection): array
    {
        $results = [];
        /** @var OneClickBuyModel $item */
        foreach ($collection->getItems() as $item) {
            /** @var OneClickBuyInterface|DataObject $entityDto */
            $entityDto = $this->entityDtoFactory->create();
            $entityDto->addData($item->getData());

            $results[] = $entityDto;
        }

        return $results;
    }
}
