<?php
namespace Sugarcode\Test\Controller\Adminhtml\Lists;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\ResultFactory;
use Sugarcode\Test\Model\Resource\Test\Collection;
use Sugarcode\Test\Model\Status;

/**
 * Class MassDelete
 */
class massEnable extends \Magento\Backend\App\Action
{
	const ID_FIELD = 'id';
    const REDIRECT_URL = 'test/lists/index';
    protected $collection = 'Sugarcode\Test\Model\Resource\Test\Collection';
	
	protected $resultPageFactory;
    protected $_teststatus;
	
	
	 public function __construct(
        Context $context,
        \Sugarcode\Test\Model\Status $teststatus,
        PageFactory $resultPageFactory
    ) {
        $this->_teststatus = $teststatus;
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }
	
	

	
	
    /**
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
	 
	  public function execute()
    {
        $selected = $this->getRequest()->getParam('selected');
        $excluded = $this->getRequest()->getParam('excluded');
		//print_r($this->getRequest()->getPost()); exit; 
        $collection = $this->_objectManager->create($this->collection);
        try {
            if (!empty($excluded)) {
                $collection->addFieldToFilter(static::ID_FIELD, ['nin' => $excluded]);
                $this->massAction($collection);
            } elseif (!empty($selected)) {
                $collection->addFieldToFilter(static::ID_FIELD, ['in' => $selected]);
                $this->massAction($collection);
            } else {
                $this->messageManager->addError(__('Please select product(s).'));
            }
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
        }

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath(static::REDIRECT_URL);
    }

    /**
     * Cancel selected orders
     *
     * @param Collection $collection
     * @return void
     */
    protected function massAction($collection)
    {
        $count = 0;
        foreach ($collection->getItems() as $list) {
            $list->setStatus($this->_teststatus->enabled)->save();
            ++$count;
        }
        $this->messageManager->addSuccess(__('A total of %1 record(s) have been deleted.', $count));
    }
	
    
}
