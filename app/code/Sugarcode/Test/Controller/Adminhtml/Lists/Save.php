<?php
namespace Sugarcode\Test\Controller\Adminhtml\Lists;

use Magento\Backend\App\Action;

class Save extends \Magento\Backend\App\Action
{


    /**
     * @var \Magento\Framework\Stdlib\DateTime
     */
    protected $_dateTime;

    /**
     * @var \Magento\Framework\Stdlib\DateTime\TimezoneInterface
     */
    protected $_localeDate;
    /**
     * @param Action\Context $context
     */
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;
	
	
    public function __construct(		
        \Magento\Framework\Stdlib\DateTime $dateTime,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $localeDate,
		Action\Context $context
	)
    {
        $this->_dateTime = $dateTime;
        $this->_localeDate = $localeDate;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $model = $this->_objectManager->create('Sugarcode\Test\Model\Test');

            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $model->load($id);
            }
			/* if(!$data['created_at']){
				$manager = $this->_objectManager->get('Magento\Store\Model\StoreManagerInterface');
				$store=$manager->getStore()->getId();
				$timestamp = $this->_localeDate->scopeTimeStamp($store);
				$currDate = $this->_dateTime->formatDate($timestamp, false);
				$data['created_at']=$currDate;
			} */
            $model->setData($data);

            try {
                $model->save();
                $this->messageManager->addSuccess(__('The Info has been saved.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the Info.'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
