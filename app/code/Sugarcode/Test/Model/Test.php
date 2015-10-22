<?php
namespace Sugarcode\Test\Model;
use Magento\Framework\Object\IdentityInterface;

class Test extends \Magento\Framework\Model\AbstractModel
{
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
}

	 