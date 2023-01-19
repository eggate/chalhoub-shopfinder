
# Shopfinder module

An assignment for Chalhoub M2 open vaccancy.

## Installation

Install extension with composer

```bash
  composer require eggate/chalhoub-shopfinder
```
Run magento installion commands

```bash
  bin/magento setup:install
  bin/magento setup:di:compile
  bin/magento setup:static-content:deploy --area adminhtml
  bin/magento cache:flush
``` 

## Features

- We want you to prepare a module for us which can be installable with composer.
- We should be able to see "Shopfinder" menu on the Content section, When we click on Shopfinder link it should list all added shops. And it should also have filtering options
- We should be able to add/edit new shops
- we have lots of fields. For this scenario, you just need to cover these fields
  - Shop name - the name of the shop, string
  - Identifier - a unique identifier of a shop, string
  - country - which should be populated by a list of countries in Magento
  - image - user should be able to upload an image
  - (Optional) longitude/latitude, string



## REST API Reference

#### Get all shops

```http
  GET /V1/shopfinder
```

#### Get shop by shop id

```http
  GET /V1/shopfinder/${shopId}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `shopId`      | `string` | **Required**. Id of item to fetch |

#### Create new shop or update existing shop if shop_id exists

```http
  POST /V1/shopfinder
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `shop`      | `\Chalhoub\Shopfinder\Api\Data\ShopInterface::class` | **Required**. shop object |

```http
  DELETE /V1/shopfinder/${shopId}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `shopId`      | `int` | **Required**. shop id to delete |
