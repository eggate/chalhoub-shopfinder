<?php
/**
 * Shop
 *
 * @copyright Copyright © 2023 Ushop Unilever. All rights reserved.
 * @author    ahmed.allam@unilever.com
 */

namespace Chalhoub\Shopfinder\Model;


use Chalhoub\Shopfinder\Api\Data\ShopInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class Shop extends AbstractModel implements ShopInterface, IdentityInterface
{
    /**
     * Cache tag
     *
     * @var string
     */
    const CACHE_TAG = 'chalhoub_shopfinder_shop';

    /**
     * Cache tag
     *
     * @var string
     */
    protected $_cacheTag = 'chalhoub_shopfinder_shop';

    /**
     * Event prefix
     *
     * @var string
     */
    protected $_eventPrefix = 'chalhoub_shopfinder_shop';
    public function _construct()
    {
        $this->_init(\Chalhoub\Shopfinder\Model\ResourceModel\Shop::class);
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->getData(self::NAME);
    }

    /**
     * @inheritDoc
     */
    public function setName(string $name): ShopInterface
    {
        $this->setData(self::NAME, $name);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getIdentifier(): string
    {
        return $this->getData(self::IDENTIFIER);
    }

    /**
     * @inheritDoc
     */
    public function setIdentifier(string $identifier): ShopInterface
    {
        $this->setData(self::IDENTIFIER, $identifier);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getCountryId(): string
    {
        return $this->getData(self::COUNTRY_ID);
    }

    /**
     * @inheritDoc
     */
    public function setCountryId(string $country_id): ShopInterface
    {
        $this->setData(self::COUNTRY_ID, $country_id);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getImage(): string
    {
        return $this->getData(self::IMAGE);
    }

    /**
     * @inheritDoc
     */
    public function setImage(string $image): ShopInterface
    {
        $this->setData(self::IMAGE, $image);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getLongitude(): string
    {
        return $this->getData(self::LONGITUDE);
    }

    /**
     * @inheritDoc
     */
    public function setLongitude(?string $longitude): ShopInterface
    {
        $this->setData(self::LONGITUDE, $longitude);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getLatitude(): string
    {
        return $this->getData(self::LATITUDE);
    }

    /**
     * @inheritDoc
     */
    public function setLatitude(?string $latitude): ShopInterface
    {
        $this->setData(self::LATITUDE, $latitude);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
