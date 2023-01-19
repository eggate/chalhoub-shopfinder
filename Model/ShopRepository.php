<?php
/**
 * ShopRepository
 *
 * @copyright Copyright © 2023 Ushop Unilever. All rights reserved.
 * @author    ahmed.allam@unilever.com
 */

namespace Chalhoub\Shopfinder\Model;


use Chalhoub\Shopfinder\Api\Data;
use Chalhoub\Shopfinder\Api\ShopRepositoryInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\NoSuchEntityException;

class ShopRepository implements ShopRepositoryInterface
{

    protected $shops = [];
    protected $resourceModel;
    protected $shopInterfaceFactory;
    protected $searchResultsFactory;
    protected $collectionProcessor;

    public function __construct(
        \Chalhoub\Shopfinder\Model\ResourceModel\Shop $resourceModel,
        Data\ShopInterfaceFactory $shopInterfaceFactory,
        Data\ShopSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    )
    {
        $this->resourceModel = $resourceModel;
        $this->shopInterfaceFactory = $shopInterfaceFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }
    /**
     * @inheritDoc
     */
    public function save(Data\ShopInterface $shop): Data\ShopInterface
    {
        try {
            $this->validate($shop);
            $this->resourceModel->save($shop);
        } catch (InputException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw new CouldNotSaveException(
                __('Could not save data: %1', $e->getMessage()),
                $e
            );
        }
        return $shop;
    }

    /**
     * @inheritDoc
     */
    public function getById(int $shopId): Data\ShopInterface
    {
        if(empty($this->shops[$shopId])){
            try {
                $shopModel = $this->shopInterfaceFactory->create();
                $this->resourceModel->load($shopModel, $shopId);
                $this->shops[$shopId] = $shopModel;
            } catch (\Exception $e) {
                throw new NoSuchEntityException(
                    __(
                        'Could not find shop: %1',
                        $e->getMessage()
                    ),
                    $e
                );
            }
        }
        return $this->shops[$shopId];
    }

    /**
     * @inheritDoc
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria): \Magento\Framework\Api\SearchResultsInterface
    {
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);

        $collection = $this->shopInterfaceFactory->create()->getCollection();
        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setItems($collection->getItems());
        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(Data\ShopInterface $shop): bool
    {
        try {
            $this->resourceModel->delete($shop);
            unset($this->shops[$shop->getId()]);
            return true;
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(
                __(
                    'Could not delete shop: %1',
                    $e->getMessage()
                ),
                $e
            );
        }
    }

    /**
     * @inheritDoc
     */
    public function deleteById(int $shopId): bool
    {
        try {
            $shop = $this->getById($shopId);
            $this->resourceModel->delete($shop);
            return true;
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(
                __(
                    'Could not delete shop: %1',
                    $e->getMessage()
                ),
                $e
            );
        }
    }
    /**
     *
     * @param Data\ShopInterface $shop
     * @throws InputException
     * @return void
     */
    private function validate(Data\ShopInterface $shop)
    {
        $exception = new InputException();
        if (empty($shop->getIdentifier())) {
            $exception->addError(
                __(
                    'Invalid value of "%value" provided for the %fieldName field.',
                    ['fieldName' => 'identifier', 'value' => $shop->getIdentifier()]
                )
            );
        }
        if ($exception->wasErrorAdded()) {
            throw $exception;
        }
    }
}
