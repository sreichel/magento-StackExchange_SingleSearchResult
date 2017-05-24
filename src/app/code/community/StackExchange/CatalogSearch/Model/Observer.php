<?php
class StackExchange_CatalogSearch_Model_Observer
{
    //the product list block name in layout
    const RESULT_BLOCK_NAME = 'search_result_list';

    public function redirectToProduct($observer)
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
                    Mage::app()->getResponse()->setRedirect($url);
                    Mage::app()->getResponse()->sendResponse();
                    exit; //stop everything else
                }
            }
        }
    }
}
