<?php

namespace Chalhoub\Shopfinder\Api;

/**
 * @api
 */
interface ShopRepositoryInterface
{
    /**
     * Save shop data
     *
     * @param \Chalhoub\Shopfinder\Api\Data\ShopInterface $shop
     * @return \Chalhoub\Shopfinder\Api\Data\ShopInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\Chalhoub\Shopfinder\Api\Data\ShopInterface $shop): Data\ShopInterface;

    /**
     * Retrieve shop data.
     *
     * @param int $shopId
     * @return \Chalhoub\Shopfinder\Api\Data\ShopInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById(int $shopId): Data\ShopInterface;

    /**
     * Retrieve customers addresses matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Magento\Framework\Api\SearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria): \Magento\Framework\Api\SearchResultsInterface;

    /**
     * Delete shop.
     *
     * @param \Chalhoub\Shopfinder\Api\Data\ShopInterface $shop
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\Chalhoub\Shopfinder\Api\Data\ShopInterface $shop): bool;

    /**
     * Delete shop by ID.
     *
     * @param int $shopId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById(int $shopId): bool;
}
