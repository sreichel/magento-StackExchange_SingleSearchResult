<?php

/**
 * Class StackExchange_CatalogSearch_Model_Observer
 */
class StackExchange_CatalogSearch_Model_Observer
{
    /**
     * the product list block name in layout
     */
    const RESULT_BLOCK_NAME = 'search_result_list';

    /**
     * @param Varien_Event_Observer $observer
     */
    public function redirectToProduct(Varien_Event_Observer $observer)
    {
        /** @var Mage_Catalog_Block_Product_List $block */
        $block = Mage::app()->getLayout()->getBlock(self::RESULT_BLOCK_NAME);
        if ($block) {
            $collection = $block->getLoadedProductCollection();
            if ($collection && $collection->getSize() == 1) {
                /** @var Mage_Catalog_Model_Product $product */
                $product = $collection->getFirstItem();
                $url = $product->getProductUrl();
                if ($url) {
                    Mage::app()->getResponse()->setRedirect($url)->sendResponse();
                    exit; //stop everything else
                }
            }
        }
    }
}
