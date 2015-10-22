<?php

namespace Sugarcode\Test\Model;
use Magento\Framework\Data\OptionSourceInterface;

class Status implements OptionSourceInterface
{
    /**#@+
     * Blog Status values
     */
    const STATUS_ENABLED = 1;

    const STATUS_DISABLED = 2;

	public $enabled;
	public $disabled;
	
	public function __construct(){
		$this->enabled=self::STATUS_ENABLED;
		$this->disabled=self::STATUS_DISABLED;
	}
    /**
     * Retrieve option array
     *
     * @return string[]
     */
    public static function getOptionArray()
    {
       $options = [];
            $options[self::STATUS_ENABLED] = (string)__('Enabled');
            $options[self::STATUS_DISABLED] = (string)__('Disabled');
      
        return $options;
    }

    /**
     * Retrieve option array with empty value
     *
     * @return string[]
     */
    public function getAllOptions()
    {
        $result = [];

        foreach (self::getOptionArray() as $index => $value) {
            $result[] = ['value' => $index, 'label' => $value];
        }

        return $result;
    }

    /**
     * Retrieve option text by option value
     *
     * @param string $optionId
     * @return string
     */
    public function getOptionText($optionId)
    {
        $options = self::getOptionArray();

        return isset($options[$optionId]) ? $options[$optionId] : null;
    }
    public function getStatus()
    {
        return $this->getOptions();
    }
    /**
     * Get product type labels array for option element
     *
     * @return array
     */
    public function getOptions()
    {
        $res = [];
        foreach ($this->getOptionArray() as $index => $value) {
            $res[] = ['value' => $index, 'label' => $value];
        }
        return $res;
    }
    public function toOptionArray()
    {
        return $this->getOptions();
    }
}