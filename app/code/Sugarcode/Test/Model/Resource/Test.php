<?php

namespace Sugarcode\Test\Model\Resource;

class Test extends \Magento\Framework\Model\Resource\Db\AbstractDb
{
	/**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $_date;

    /**
     * Store manager
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * Construct
     *
     * @param \Magento\Framework\Model\Resource\Db\Context $context
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $date
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param string|null $resourcePrefix
     */
    public function __construct(
        \Magento\Framework\Model\Resource\Db\Context $context,
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        $resourcePrefix = null
    ) {
        parent::__construct($context, $resourcePrefix);
        $this->_storeManager = $storeManager;
        $this->_date = $date;
    }
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('testtable', 'id');
    }
	protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
    {
        
        if (!$object->getId()) {
            $object->setCreatedAt($this->_date->gmtDate());
        }
        $object->setUpdatedAt($this->_date->gmtDate());
        return $this;
    }
	
	 public function load(\Magento\Framework\Model\AbstractModel $object, $value, $field = null)
    {
        

        return parent::load($object, $value, $field);
    }
      /**
     * Retrieve select object for load object data
     *
     * @param string $field
     * @param mixed $value
     * @param \Magento\Cms\Model\Block $object
     * @return \Zend_Db_Select
     */
    protected function _getLoadSelect($field, $value, $object)
    {
        $select = parent::_getLoadSelect($field, $value, $object);
        return $select;
    }
}
