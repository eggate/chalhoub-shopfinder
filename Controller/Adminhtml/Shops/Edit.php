<?php

namespace Chalhoub\Shopfinder\Controller\Adminhtml\Shops;

use Chalhoub\Shopfinder\Api\ShopRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Chalhoub\Shopfinder\Api\Data\ShopInterfaceFactory;

class Edit extends Action
{
    /**
     * @var PageFactory
     */
    protected $_resultPageFactory;
    /**
     * @var Registry
     */
    protected $_coreRegistry;
    /**
     * @var ShopInterfaceFactory
     */
    protected $shopInterfaceFactory;
    /**
     * @var ShopRepositoryInterface
     */
    protected $shopRepository;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context               $context,
        PageFactory           $resultPageFactory,
        Registry              $coreRegistry,
        ShopInterfaceFactory $shopInterfaceFactory,
        ShopRepositoryInterface $shopRepository
    )
    {
        parent::__construct($context);
        $this->_resultPageFactory = $resultPageFactory;
        $this->shopInterfaceFactory = $shopInterfaceFactory;
        $this->shopRepository = $shopRepository;
        $this->_coreRegistry = $coreRegistry;
    }

    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $model = $this->shopInterfaceFactory->create();
        $id = $this->getRequest()->getParam('id');
        if (!empty($id)) {
            $model->load($id);
        }
        $data = $this->_session->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        $this->_coreRegistry->register('shopfinder_model', $model);
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();

        if ($id) {
            $resultPage->getConfig()->getTitle()->prepend(__('Edit Shop: %1', $model->getName()));
        } else {
            $resultPage->getConfig()->getTitle()->prepend(__('New Shop'));
        }
        return $resultPage;
    }
}
