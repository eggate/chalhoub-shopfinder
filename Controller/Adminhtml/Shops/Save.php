<?php
namespace Chalhoub\Shopfinder\Controller\Adminhtml\Shops;

class Save extends \Magento\Backend\App\Action
{
    protected $shopFactory;
    protected $formKeyValidator;
    protected $shopRepository;
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Chalhoub\Shopfinder\Api\Data\ShopInterfaceFactory $shopFactory,
        \Chalhoub\Shopfinder\Api\ShopRepositoryInterface $shopRepository,
        \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator
    ) {
        parent::__construct($context);
        $this->shopFactory = $shopFactory;
        $this->shopRepository = $shopRepository;
        $this->formKeyValidator = $formKeyValidator;
    }

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
	public function execute()
    {
        if ($this->formKeyValidator->validate($this->getRequest())) {
            $data = $this->getRequest()->getPostValue();
            if ($data) {
                $model = $this->shopFactory->create();
                $id = $this->getRequest()->getParam('id');
                if (!empty($id)) {
                    $model->load($id);
                }
                if(!empty($data['image'])){
                    $img_name = $data['image'][0]['name'];
                    $data['image'] = $img_name;
                }
                $model->setData($data);
                try {
                    $this->shopRepository->save($model);
                    $this->messageManager->addSuccessMessage(__('Shop details has been saved.'));
                    $this->_getSession()->setFormData(false);
                    if ($this->getRequest()->getParam('back')) {
                        $this->_redirect('*/*/edit', array('id' => $model->getId(), '_current' => true));
                        return;
                    }
                    $this->_redirect('*/*/');
                    return;
                } catch (\Exception $e) {
                    $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving these data.') . $e->getMessage());
                }
                $this->_getSession()->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }else{
            $this->messageManager->addErrorMessage(__("Couldn't validate this request. Please try again!."));
            $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            return;
        }
        $this->_redirect('*/*/');
    }
}
