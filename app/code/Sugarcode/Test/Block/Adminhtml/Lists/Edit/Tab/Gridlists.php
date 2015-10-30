<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Sugarcode\Test\Block\Adminhtml\Lists\Edit\Tab;

/**
 *
 * @SuppressWarnings(PHPMD.LongVariable)
 */
class Gridlists extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * User model factory
     *
     * @var \Magento\User\Model\Resource\User\CollectionFactory
     */
    
  
    protected $_testFactory; 
	
	protected $_objectManager;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Json\EncoderInterface $jsonEncoder
     * @param \Magento\Backend\Model\Auth\Session $authSession
     * @param \Magento\User\Model\Resource\User\CollectionFactory $userCollectionFactory
     * @param array $data
     */
    public function __construct(
		\Magento\Framework\ObjectManagerInterface $objectManager,
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        \Sugarcode\Test\Model\TestFactory $testFactory,
        \Magento\Backend\Model\Auth\Session $authSession,
        \Sugarcode\Test\Model\Resource\Test\CollectionFactory $userCollectionFactory,
        array $data = []
    ) {
        // _userCollectionFactory is used in parent::__construct
        $this->_testFactory = $testFactory;
		$this->_objectManager = $objectManager;
        $this->_jsonEncoder = $jsonEncoder;
        parent::__construct($context, $jsonEncoder, $authSession, $data);
    }

    /**
     * Class constructor
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
		$id = $this->getRequest()->getParam('id', false);
       // $this->setTemplate('lists/lists.phtml')->assign('alists', [1]);
	  //$this->assign('alists', $this->getAlists())->assign('id', $id);

    }

    /**
     * @return $this
     */
    protected function _prepareLayout()
    {
        $this->setChild(
            'listsGrid',
            $this->getLayout()->createBlock('Sugarcode\Test\Block\Adminhtml\Lists\Edit\Tab\Gridtabs', 'listsTabsGrid')
        );
        return parent::_prepareLayout();
    }

    /**
     * @return string
     */
    public function getGridHtml()
    {
        return $this->getChildHtml('listsGrid');
    }
	
}
