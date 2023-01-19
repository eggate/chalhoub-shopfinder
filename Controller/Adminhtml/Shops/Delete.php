<?php
namespace Chalhoub\Shopfinder\Controller\Adminhtml\Shops;

use Chalhoub\Shopfinder\Api\ShopRepositoryInterface;
use Magento\Framework\Exception\NotFoundException;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * @var ShopRepositoryInterface
     */
    protected $shopRepository;

    public function __construct(
		\Magento\Backend\App\Action\Context $context,
        ShopRepositoryInterface $shopRepository
	)
	{
		parent::__construct($context);
        $this->shopRepository = $shopRepository;
	}
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        try{
            $shop = $this->shopRepository->getById($this->getRequest()->getParam('id'));
            $this->shopRepository->delete($shop);
        }catch (NotFoundException $exception){
            $this->messageManager->addErrorMessage(__('Unable to find the requested shop.'));
        }catch (\Exception $exception){
            $this->messageManager->addErrorMessage(__('Error while trying to this Subject'));
        }
        $resultRedirect->setPath('*/*/index', array('_current' => true));
        return $resultRedirect;
    }
}
