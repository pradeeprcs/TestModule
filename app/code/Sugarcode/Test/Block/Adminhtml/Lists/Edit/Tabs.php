<?php
namespace Sugarcode\Test\Block\Adminhtml\Lists\Edit;

/**
 * Admin page left menu
 */
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    

    const ADVANCED_TAB_GROUP_CODE = 'advanced';
	/**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('post_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Information'));
    }
 
 protected function _prepareLayout()
    {
      //  $lists = $this->_coreRegistry->registry('lists');

         $this->addTabAfter(
                'gridtabs',
                [
                    'label' => __('Grid Tabs'),
                    'title' => __('Grid Tabs'),
                    'content' => $this->getLayout()->createBlock(
                        'Sugarcode\Test\Block\Adminhtml\Lists\Edit\Tab\Gridtabs',
                        'test.lists.grid.tabs'
                    )->setActive(true)->toHtml()
                ],
				'main_section'
            );

        return parent::_prepareLayout();
    }

			
}
