<?php

namespace Chalhoub\Shopfinder\Api\Data;
use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * @api
 */
interface ShopInterface
{
    const NAME = "name";
    const IDENTIFIER = "identifier";
    const COUNTRY_ID = "country_id";
    const IMAGE = "image";
    const LONGITUDE = "longitude";
    const LATITUDE = "latitude";

    /**
     * @return string
     */
    public function getName() :string;

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name) :ShopInterface;

    /**
     * @return string
     */
    public function getIdentifier() :string;

    /**
     * @param string $identifier
     * @return $this
     */
    public function setIdentifier(string $identifier) :ShopInterface;

    /**
     * @return string
     */
    public function getCountryId() :string;

    /**
     * @param string $country_id
     * @return $this
     */
    public function setCountryId(string $country_id) :ShopInterface;

    /**
     * @return string
     */
    public function getImage() :string;

    /**
     * @param string $image
     * @return $this
     */
    public function setImage(string $image) :ShopInterface;

    /**
     * @return string
     */
    public function getLongitude() :string;

    /**
     * @param ?string $longitude
     * @return $this
     */
    public function setLongitude(?string $longitude) :ShopInterface;

    /**
     * @return string
     */
    public function getLatitude() :string;

    /**
     * @param ?string $latitude
     * @return $this
     */
    public function setLatitude(?string $latitude) :ShopInterface;

}
