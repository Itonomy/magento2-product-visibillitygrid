<?php

namespace Itonomy\ProductVisibilityGrid\Model;

use Magento\Framework\Indexer\IndexerInterface;
use \Magento\Indexer\Model\IndexerFactory;

/**
 * Product indexer
 *
 * @category  Class
 * @author    Ben van Steenbergen <ben.vansteenbergen@itonomy.nl>
 * @author    Daniel R. Azulay <daniel.azulay@itonomy.nl>
 */
class ProductIndexer
{
    /** @var IndexerFactory $indexerFactory */
    protected $indexerFactory = null;
    
    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct(IndexerFactory $indexerFactory)
    {
        $this->indexerFactory = $indexerFactory;
    }
    
    /**
     * Gets indexer codes.
     *
     * @return void
     */
    public function getIndexerCodes()
    {
        return [
            'catalog_product_flat',
            'catalog_category_product',
            'catalog_product_category',
            'catalog_product_price',
            //'catalog_product_attribute',
            'cataloginventory_stock',
            //'catalogrule_product',
            'catalogsearch_fulltext',
        ];
    }
    
    /**
     * Reindexes product IDs.
     *
     * @param int[]|string[] $productIds Product IDs
     *
     * @return bool
     */
    public function reindexList(array $productIds)
    {
        $indexerCodes = $this->getIndexerCodes();
        foreach ($indexerCodes as $indexerCode) {
            $indexer = $this->getIndexerByCode($indexerCode);
            if ($indexer instanceof IndexerInterface) {
                $indexer->reindexList(
                    \array_unique($productIds)
                );
            }
        }
        return true;
    }
             
    /**
     * Gets indexer instance by indexer code.
     *
     * @param string $indexerCode Indexer code
     * @return IndexerInterface | false
     *
     */
    protected function getIndexerByCode($indexerCode)
    {
        try {
            return $this->indexerFactory->create()->load($indexerCode);
        } catch (\Exception $e) {
            return false;
        }
    }
}
