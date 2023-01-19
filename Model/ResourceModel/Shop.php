<?php
/**
 * Shop
 *
 * @copyright Copyright © 2023 Ushop Unilever. All rights reserved.
 * @author    ahmed.allam@unilever.com
 */

namespace Chalhoub\Shopfinder\Model\ResourceModel;


use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Shop extends AbstractDb
{
    const TABLE_NAME = "chalhoub_shop";
    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(self::TABLE_NAME, "shop_id");
        $this->_useIsObjectNew = true;
    }
}
