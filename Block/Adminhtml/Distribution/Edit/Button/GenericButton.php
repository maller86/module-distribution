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

namespace FjodorMaller\Distribution\Block\Adminhtml\Distribution\Edit\Button;

use FjodorMaller\Base\Block\Adminhtml\Form\Button\BaseGenericButton;
use FjodorMaller\Distribution\Api\Data\DistributionInterface;
use FjodorMaller\Distribution\Api\DistributionRepositoryInterface;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class GenericButton
 */
abstract class GenericButton extends BaseGenericButton
{
    /**
     * @var DistributionRepositoryInterface
     */
    protected $_distributionRepository;

    /**
     * @param Context                         $context
     * @param DistributionRepositoryInterface $distributionRepository
     */
    public function __construct(
        Context $context,
        DistributionRepositoryInterface $distributionRepository
    ) {
        $this->_distributionRepository = $distributionRepository;
        parent::__construct($context);
    }

    /**
     * Returns the id of requested distribution.
     *
     * @return int|null
     */
    public function getDistributionId()
    {
        try {
            $id = $this->context->getRequest()->getParam(DistributionInterface::DISTRIBUTION_ID);

            return $this->_distributionRepository->getById($id)->getId();
        } catch (LocalizedException $e) {
            // Not found :(
        }

        return null;
    }
}
