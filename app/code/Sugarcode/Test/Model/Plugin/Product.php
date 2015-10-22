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
    public function aroundGetProduct(\Magento\Catalog\Block\Product\View $subject, \Closure $proceed)
    {
    
		//echo 'Do Some Logic Before <br>';
        $returnValue = $proceed(); // it get you old function return value
		$name='#'.$returnValue->getName().'#';
		$returnValue->setName($name);
		//echo 'Do Some Logic  After <br>';
        return $returnValue;// if its object make sure it return same object which you addition data
    }
    public function aroundExecute(\Magento\Catalog\Controller\Product\View $subject, \Closure $proceed)
    {
        echo 'I Am in Local Controller Before <br>';
        $returnValue = $proceed(); // it get you old function return value
		//$name='#'.$returnValue->getName().'#';
		//$returnValue->setName($name);
		echo 'I Am in Local Controller  After <br>';
        return $returnValue;// if its object make sure it return same object which you addition data
    }
	public function afterGetGridUrl()
    {
		exit;
		
	}
    public function beforeGetColumns()
    {
		exit;
	}
}
