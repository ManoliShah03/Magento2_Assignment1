<?php

namespace Preference\Assignment\magento\Model;

use Magento\Catalog\Model\Product;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Stdlib\DateTime;

class Wishlist extends \Magento\wishlist\Model\Wishlist
{
    protected function _addCatalogProduct(Product $product, $qty = 1, $forciblySetQty = false)
    {
        $productIds = array_map(function ($item) {
            return $item->getProductId();
        }, $this->getItemCollection()->getItems());

        if (in_array($product->getId(), $productIds)) {
            throw new LocalizedException(__('The product is already in Wishlist'));
        }

        $storeId = $product->hasWishlistStoreId() ? $product->getWishlistStoreId() : $this->getStore()->getId();
        $item = $this->_wishlistItemFactory->create();
        $item->setProductId($product->getId());
        $item->setWishlistId($this->getId());
        $item->setAddedAt((new \DateTime())->format(DateTime::DATETIME_PHP_FORMAT));
        $item->setStoreId($storeId);
        $item->setOptions($product->getCustomOptions());
        $item->setProduct($product);
        $item->setQty($qty);
        $item->save();
        if ($item->getId()) {
            $this->getItemCollection()->addItem($item);
        }

        return $item;
    }

}
