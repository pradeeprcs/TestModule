<?php
/**pradeep.kumarrcs67@gmail.com*/
namespace Sugarcode\Test\Block;

class Joinex extends \Magento\Framework\View\Element\Template
{
    protected $_coreRegistry = null;
    protected $_orderCollectionFactory = null;
    protected $connection;
	protected $_resource;
	
	public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\App\Resource $resource,
        \Magento\Sales\Model\Resource\Order\CollectionFactory $orderCollectionFactory,
        array $data = []
    ) {
        $this->_orderCollectionFactory = $orderCollectionFactory;
        $this->_coreRegistry = $registry;
        $this->_resource = $resource;
        parent::__construct($context, $data);
    }

	
	
	public function _prepareLayout()
	{
	    return parent::_prepareLayout();
	}
    protected function getConnection()
    {
        if (!$this->connection) {
            $this->connection = $this->_resource->getConnection('core_write');
        }
        return $this->connection;
    }
	public function getDirectQuery()
	{
		$table=$this->_resource->getTableName('catalog_product_entity'); 
		$sku = $this->getConnection()->fetchRow('SELECT sku,entity_id FROM ' . $table);
		return $sku;
	}
	public function getJoinLeft()
	{
		
		  $orders = $this->_orderCollectionFactory->create();
		  $orders->getSelect()->joinLeft(
            ['oce' => 'customer_entity'],
            "main_table.customer_id = oce.entity_id",
            [   
				'CONCAT(oce.firstname," ", oce.lastname) as customer_name',
				'oce.firstname',
                'oce.lastname',
                'oce.email'
            ]
        );
		
	//$orders->getSelect()->__toString(); $orders->printlogquery(true);	exit;
        return $orders;
		
		
	}
	
	
}