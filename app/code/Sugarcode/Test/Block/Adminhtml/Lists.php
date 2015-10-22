<?php
namespace Sugarcode\Test\Block\Adminhtml;

class Lists extends \Magento\Backend\Block\Widget\Container
{
    protected function _construct()
    {
        $this->_blockGroup = 'Sugarcode_Test';
        $this->_controller = 'adminhtml_lists';
        $this->_headerText = __('Test Grid');
        $this->_addButtonLabel = __('Add New Info');
        parent::_construct();
    }
	
}