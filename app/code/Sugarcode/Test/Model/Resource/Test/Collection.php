<?php
namespace Sugarcode\Test\Model\Resource\Test;

class Collection extends \Magento\Framework\Model\Resource\Db\Collection\AbstractCollection
{
   
	protected function _construct()
    {
        $this->_init('Sugarcode\Test\Model\Test', 'Sugarcode\Test\Model\Resource\Test');
    }
	
    /**
     * @return \Magento\Cms\Model\Resource\Block\Collection
     */
    protected function _afterLoad()
    {
        $this->walk('afterLoad');
        parent::_afterLoad();
    }

    /**
     * @param string|array $field
     * @param string|int|array|null $condition
     * @return \Magento\Cms\Model\Resource\Block\Collection
     */
    public function addFieldToFilter($field, $condition = null)
    {
        
        return parent::addFieldToFilter($field, $condition);
    }

    

    /**
     * Returns pairs block_id - title
     *
     * @return array
     */
    public function toOptionArray()
    {
        return $this->_toOptionArray('id', 'title');
    }

    /**
 

    /**
     * Get SQL for get record count.
     * Extra GROUP BY strip added.
     *
     * @return \Magento\Framework\DB\Select
     */
    public function getSelectCountSql()
    {
        $countSelect = parent::getSelectCountSql();

        $countSelect->reset(\Zend_Db_Select::GROUP);

        return $countSelect;
    }
	
    protected function _renderFiltersBefore()
    {
        parent::_renderFiltersBefore();
    }
	
}

	 