<?php
/**
 * Collection
 *
 * @copyright Copyright © 2023 Ushop Unilever. All rights reserved.
 * @author    ahmed.allam@unilever.com
 */

namespace Chalhoub\Shopfinder\Model\ResourceModel\Shop;


use Chalhoub\Shopfinder\Model\Shop;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * ID Field Name
     *
     * @var string
     */
    protected $_idFieldName = 'shop_id';

    /**
     * Event prefix
     *
     * @var string
     */
    protected $_eventPrefix = 'chalhoub_shopfinder_shop_collection';

    /**
     * Event object
     *
     * @var string
     */
    protected $_eventObject = 'chalhoub_shopfinder_shop_collection';

    public function _construct()
    {
        return $this->_init(Shop::class, \Chalhoub\Shopfinder\Model\ResourceModel\Shop::class);
    }
}
