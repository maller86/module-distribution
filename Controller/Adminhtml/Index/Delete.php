<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is subject to the license that is available in LICENSE file.
 *
 * DISCLAIMER
 *
 * Do not edit this file if you wish to upgrade this extension to newer version in the future.
 */

namespace FjodorMaller\Distribution\Controller\Adminhtml\Index;

use FjodorMaller\Distribution\Api\Data\DistributionInterface;
use Magento\Backend\Model\View\Result\Redirect;

/**
 * Class Delete
 */
class Delete extends Base
{
    /**
     * @inheritdoc
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam(DistributionInterface::DISTRIBUTION_ID);
        /* @var $resultRedirect Redirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            $name = '';
            try {
                $model = $this->_repository->getById($id);
                $name  = $model->getName();
                $model->delete();
                $this->messageManager->addSuccessMessage(__('The distribution has been deleted.'));
                $this->_eventManager->dispatch(
                    'adminhtml_distribution_on_delete',
                    [
                        'title'  => $name,
                        'status' => 'success',
                    ]
                );

                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->_eventManager->dispatch(
                    'adminhtml_distribution_on_delete',
                    [
                        'title'  => $name,
                        'status' => 'fail',
                    ]
                );
                $this->messageManager->addErrorMessage($e->getMessage());

                return $resultRedirect->setPath('*/*/edit', [DistributionInterface::DISTRIBUTION_ID => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find a distribution to delete.'));

        return $resultRedirect->setPath('*/*/');
    }
}
