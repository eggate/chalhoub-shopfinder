<?php
/**
 * ShopSearchResultsInterface
 *
 * @copyright Copyright © 2023 Ushop Unilever. All rights reserved.
 * @author    ahmed.allam@unilever.com
 */

namespace Chalhoub\Shopfinder\Api\Data;


use Magento\Framework\Api\Search\SearchResultInterface;

interface ShopSearchResultsInterface extends SearchResultInterface
{
    /**
     *
     * @return \Chalhoub\Shopfinder\Api\Data\ShopInterface[]
     */
    public function getItems();

    /**
     *
     * @param \Chalhoub\Shopfinder\Api\Data\ShopInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
