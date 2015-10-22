<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Sugarcode\Test\Model\Plugin;

class Product
{        
	public function beforeSetName(\Magento\Catalog\Model\Product $subject, $name)
    {
        return array('(' . $name . ')');
    }
    
	 public function afterGetName(\Magento\Catalog\Model\Product $subject, $result)
    {
        return '|' . $result . '|';
    }
    
}
