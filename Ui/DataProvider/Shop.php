<?php
/**
 * Shop
 *
 * @copyright Copyright © 2023 Ushop Unilever. All rights reserved.
 * @author    ahmed.allam@unilever.com
 */

namespace Chalhoub\Shopfinder\Ui\DataProvider;

use Chalhoub\Shopfinder\Model\ResourceModel\Shop\CollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

class Shop extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $collection;
    protected $storeManager;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
        $this->storeManager = $storeManager;
    }
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        $this->loadedData = [];
        foreach ($items as $item) {
            $data = $item->getData();
            if($data['image']){
                $img = [];
                $img[0]['name']  = $data['image'];
                $img[0]['image'] = $data['image'];
                $img[0]['previewType'] = "image";
                $img[0]['url'] = $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . 'shopfinder/images/' . $data['image'];
                $data['image'] = $img;
            }
            $this->loadedData[$item->getShopId()] = $data;
        }
        return $this->loadedData;
    }
}
