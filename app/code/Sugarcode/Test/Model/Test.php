<?php
namespace Sugarcode\Test\Model;
use Magento\Framework\Object\IdentityInterface;

class Test extends \Magento\Framework\Model\AbstractModel
{
    
    const ID      = 'id';
    const TITLE         = 'title';
    const SHORT_SUMMARY      = 'short_summary';
    const CREATED_AT = 'created_at';
    const UPDATE_TIME   = 'update_time';
    const STATUS     = 'status';
	/**
     * Initialize resource model
     *
     * @return void
     */
	 public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\Resource\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
	) {
		parent::__construct($context, $registry, $resource, $resourceCollection, $data);
	}

    protected function _construct()
    {
        $this->_init('Sugarcode\Test\Model\Resource\Test');
    }
	
    public function getId()
    {
        return $this->getData(self::ID);
    }
    public function getShortSummary()
    {
        return (string)$this->getData(self::SHORT_SUMMARY);
    }
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }
	
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }
	
	
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }
    public function setShortSummary($ShortSummary)
    {
        return $this->setData(self::SHORT_SUMMARY, $ShortSummary);
    }
    public function setTitle($TITLE)
    {
        return $this->setData(self::TITLE, $TITLE);
    }
    public function setStatus($STATUS)
    {
        return $this->setData(self::STATUS, $STATUS);
    }
    public function setCreatedAt($CREATED_AT)
    {
        return $this->setData(self::CREATED_AT, $CREATED_AT);
    }
}

	 