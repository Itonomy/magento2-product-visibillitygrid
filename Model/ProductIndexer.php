<?php
/**
 * Created by PhpStorm.
 * User: benvansteenbergen
 * Date: 07/08/2018
 * Time: 11:37
 */

namespace Itonomy\ProductVisibilityGrid\Model;


class ProductIndexer
{
    protected $indexerFactory;

    public function __construct(
        \Magento\Indexer\Model\IndexerFactory $indexerFactory
    )
    {
        $this->indexerFactory = $indexerFactory;
    }

    public function reindexList(array $productIds) {

        $indexerIds = array(
            'catalog_product_flat',
            'catalog_category_product',
            'catalog_product_category',
            'catalog_product_price',
            //'catalog_product_attribute',
            'cataloginventory_stock',
            //'catalogrule_product',
            'catalogsearch_fulltext',
        );
        foreach ($indexerIds as $indexerId) {
            $indexer = $this->indexerFactory->create();
            $indexer->load($indexerId);
            $indexer->reindexList(array_unique($productIds));
        }

        return true;
    }

}