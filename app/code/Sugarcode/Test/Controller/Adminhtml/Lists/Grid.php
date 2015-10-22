<?php
/**
 *
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Sugarcode\Test\Controller\Adminhtml\Lists;

class Grid extends  \Magento\Backend\App\Action
{
    /**
     * Queue list Ajax action
     *
     * @return void
     */
    public function execute()
    {
       $this->_view->loadLayout(false);
        $this->_view->getLayout()->getMessagesBlock()->setMessages($this->messageManager->getMessages(true));
        $this->_view->renderLayout();
    }
}
