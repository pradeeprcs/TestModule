<?php
namespace Sugarcode\Test\Controller\Adminhtml\Lists;

use Magento\Backend\App\Action;

class MassStatus extends \Magento\Backend\App\Action
{
    /**
     * Update blog post(s) status action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    public function execute()
    {
        $listsIds = $this->getRequest()->getParam('lists_ids');
        if (!is_array($listsIds) || empty($listsIds)) {
            $this->messageManager->addError(__('Please select list(s).'));
        } else {
            try {
                $status = (int) $this->getRequest()->getParam('status');
                foreach ($listsIds as $postId) {
                    $post = $this->_objectManager->get('Sugarcode\Test\Model\Test')->load($postId);
                    $post->setStatus($status)->save();
                }
                $this->messageManager->addSuccess(
                    __('A total of %1 record(s) have been updated.', count($listsIds))
                );
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }
        return $this->resultRedirectFactory->create()->setPath('test/*/index');
    }

}
