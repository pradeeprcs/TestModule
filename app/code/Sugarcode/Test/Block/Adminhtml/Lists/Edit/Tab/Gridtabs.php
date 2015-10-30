<?php

namespace Sugarcode\Test\Block\Adminhtml\Lists\Edit\Tab;


use Magento\Backend\Block\Widget\Grid\Column;


class Gridtabs  extends \Magento\Backend\Block\Widget\Grid\Extended
{/**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;
  
    protected $_testFactory; 
	
	protected $_objectManager;

    protected $_status;

    /**
     * @var \Magento\Framework\Json\EncoderInterface
     */
    protected $_jsonEncoder;

    //protected $_template = 'lists/tabs_grid_js.phtml';
   
    public function __construct(
		\Magento\Framework\ObjectManagerInterface $objectManager,
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Sugarcode\Test\Model\TestFactory $testFactory,
        \Sugarcode\Test\Model\Status $status,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        \Magento\Framework\Module\Manager $moduleManager,
        array $data = []
    ) {
        $this->_testFactory = $testFactory;
        $this->_status = $status;
        $this->moduleManager = $moduleManager;
		$this->_objectManager = $objectManager;
        $this->_jsonEncoder = $jsonEncoder;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('listsGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
        $this->setVarNameFilter('lists_filter');
    }

    /**
     * @return $this
     */
    protected function _prepareCollection()
    {
        $collection = $this->_testFactory->create()->getCollection();
        $this->setCollection($collection);

        parent::_prepareCollection();
        return $this;
    }
	
    protected function _addColumnFilterToCollection($column)
    {
       
	if ($column->getId() == 'in_lists_gridtabs') {
            $inlistsIds = $this->getAlists();
			
            if (empty($inlistsIds)) {
                $inlistsIds = 0;
            }
            if ($column->getFilter()->getValue()) {
                $this->getCollection()->addFieldToFilter('id', ['in' => $inlistsIds]);
            } else {
                if ($inlistsIds) {
                    $this->getCollection()->addFieldToFilter('id', ['nin' => $inlistsIds]);
                }
            }
        } else {
            parent::_addColumnFilterToCollection($column);
        }
        return $this;
    }
	public function getAlists($json = false)
    {
        
         //       return [1];
		$id=$this->getRequest()->getParam('id');
		$collection = $this->_testFactory->create()->setId($id);
		$listso = $this->_objectManager->create('Sugarcode\Test\Model\Test')->load($id);
		$collection=unserialize($listso->getInListsGrid());
		
        if (sizeof($collection) > 0) {
            if ($json) {
                $jsonLists = [];
                foreach ($collection as $usrid) {
                    $jsonLists[$usrid] = 0;
                }
                return $this->_jsonEncoder->encode((object)$jsonLists);
            } else {
                return array_values($collection);
            }
        } else {
            if ($json) {
                return '{}';
            } else {
                return [];
            }
        }
		
    }  
	
	
	public function isReadonly()
    {
        return false;
    }

    /**
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareColumns()
    {
         $this->addColumn(
            'in_lists_gridtabs',
            [
                'header_css_class' => 'a-center',
                'type' => 'checkbox',
                'name' => 'in_lists_gridtabs',
                'values' => $this->getAlists(),
                'align' => 'center',
                'index' => 'id'
            ]
        );
		 $this->addColumn(
            'lists_id',
            [
                'header' => __('ID'),
                'type' => 'number',
                'index' => 'id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
                'name'=>'lists_id'
            ]
        );  
        $this->addColumn(
            'lists_title',
            [
                'header' => __('Title'),
                'index' => 'title',
                'class' => 'xxx',
                'name'=>'lists_title'
            ]
        );

        $this->addColumn(
            'lists_created_at',
            [
                'header' => __('Created Date'),
                'index' => 'created_at',
                'name'=>'lists_created_at'
            ]
        );


        $this->addColumn(
            'lists_status',
            [
                'header' => __('Status'),
                'index' => 'status',
                'type' => 'options',
                'name'=>'lists_status',
                'options' => $this->_status->getOptionArray()
            ]
        );


        return parent::_prepareColumns();
    }


    /**
     * @return string
     */
    public function getGridUrl()
    {
		$id = $this->getRequest()->getParam('id');
        return $this->getUrl('*/*/gridtabs', ['id' => $id]);
    }

    
    /**
     * Prepare label for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('Test Grid');
    }

    /**
     * Prepare title for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('Test Grid');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}