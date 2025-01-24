<?php

namespace Amida\OneClickBuy\Query\OneClickBuy;

use Amida\OneClickBuy\Mapper\OneClickBuyDataMapper;
use Amida\OneClickBuy\Model\ResourceModel\OneClickBuyModel\OneClickBuyCollection;
use Amida\OneClickBuy\Model\ResourceModel\OneClickBuyModel\OneClickBuyCollectionFactory;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;

/**
 * Get OneClickBuy list by search criteria query.
 */
class GetListQuery
{
    /**
     * @var CollectionProcessorInterface
     */
    private CollectionProcessorInterface $collectionProcessor;

    /**
     * @var OneClickBuyCollectionFactory
     */
    private OneClickBuyCollectionFactory $entityCollectionFactory;

    /**
     * @var OneClickBuyDataMapper
     */
    private OneClickBuyDataMapper $entityDataMapper;

    /**
     * @var SearchCriteriaBuilder
     */
    private SearchCriteriaBuilder $searchCriteriaBuilder;

    /**
     * @var SearchResultsInterfaceFactory
     */
    private SearchResultsInterfaceFactory $searchResultFactory;

    /**
     * @param CollectionProcessorInterface $collectionProcessor
     * @param OneClickBuyCollectionFactory $entityCollectionFactory
     * @param OneClickBuyDataMapper $entityDataMapper
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param SearchResultsInterfaceFactory $searchResultFactory
     */
    public function __construct(
        CollectionProcessorInterface  $collectionProcessor,
        OneClickBuyCollectionFactory  $entityCollectionFactory,
        OneClickBuyDataMapper         $entityDataMapper,
        SearchCriteriaBuilder         $searchCriteriaBuilder,
        SearchResultsInterfaceFactory $searchResultFactory
    )
    {
        $this->collectionProcessor = $collectionProcessor;
        $this->entityCollectionFactory = $entityCollectionFactory;
        $this->entityDataMapper = $entityDataMapper;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->searchResultFactory = $searchResultFactory;
    }

    /**
     * Get OneClickBuy list by search criteria.
     *
     * @param SearchCriteriaInterface|null $searchCriteria
     *
     * @return SearchResultsInterface
     */
    public function execute(?SearchCriteriaInterface $searchCriteria = null): SearchResultsInterface
    {
        /** @var OneClickBuyCollection $collection */
        $collection = $this->entityCollectionFactory->create();

        if ($searchCriteria === null) {
            $searchCriteria = $this->searchCriteriaBuilder->create();
        } else {
            $this->collectionProcessor->process($searchCriteria, $collection);
        }

        $entityDataObjects = $this->entityDataMapper->map($collection);

        /** @var SearchResultsInterface $searchResult */
        $searchResult = $this->searchResultFactory->create();
        $searchResult->setItems($entityDataObjects);
        $searchResult->setTotalCount($collection->getSize());
        $searchResult->setSearchCriteria($searchCriteria);

        return $searchResult;
    }
}
