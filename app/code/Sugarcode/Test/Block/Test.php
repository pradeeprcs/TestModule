<?php
namespace Sugarcode\Test\Block;

class Test extends \Magento\Framework\View\Element\Template
{
    protected $_coreRegistry = null;
    protected $_testmodel;
	
	public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Sugarcode\Test\Model\Test $testmodel,
        array $data = []
    ) {
        $this->_testmodel = $testmodel;
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

	
	
	public function _prepareLayout()
	{
	    return parent::_prepareLayout();
	}
	public function getAllData()
	{
		
		//$data = $this->_testmodel->load(1);
		$datas = $this->_testmodel->getCollection();
	    return $datas;
	}
	
	
}