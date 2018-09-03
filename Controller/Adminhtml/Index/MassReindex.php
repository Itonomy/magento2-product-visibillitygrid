<?php

/**
 * Created by PhpStorm.
 * User: benvansteenbergen
 * Date: 09/07/2018
 * Time: 09:23
 */

namespace Itonomy\ProductVisibilityGrid\Controller\Adminhtml\Index;

use Itonomy\ProductVisibilityGrid\Model\ProductIndexer;

class MassReindex extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\Controller\Result\ForwardFactory
     */
    protected $resultRedirectFactory;

    protected $productIndexer;

    protected $messageManager;

    /**
     * Constructor
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\ForwardFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        ProductIndexer $productIndexer
    ) {

        $this->productIndexer = $productIndexer;
        $this->messageManager = $messageManager;
        parent::__construct($context);
    }

    /**
     *
     * @return \Magento\Framework\Controller\Result\ForwardFactory
     */
    public function execute()
    {

        $productIdsForIndexing = $this->getRequest()->getParam('product');

        if (count($productIdsForIndexing) > 100) {
            $this->messageManager->addErrorMessage('Hey! Take it ease administrator, we can only handle so much as a 100 products!');
        }

        $indexResult = $this->productIndexer->reindexList($productIdsForIndexing);

        if ($indexResult == 1) {
            $this->messageManager->addSuccessMessage('Product id '.join($productIdsForIndexing).' is succesfully scheduled for index');
        } else {
            $this->messageManager->addErrorMessage('Product id '.join($productIdsForIndexing).' is not able to be scheduled indexed');
        }

        $this->_redirect('productvisibility/index/grid', ['store'=>$this->getRequest()->getParam('store')]);
        return;
    }
}
