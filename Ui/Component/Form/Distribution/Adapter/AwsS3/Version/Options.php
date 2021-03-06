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

namespace FjodorMaller\Distribution\Ui\Component\Form\Distribution\Adapter\AwsS3\Version;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Options
 */
class Options implements OptionSourceInterface
{
    /**
     * @var array
     */
    protected $_options;

    /**
     * Returns the options as array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'latest' => 'Latest',
            'v4'     => 'Version 4',
        ];
    }

    /**
     * @inheritdoc
     */
    public function toOptionArray()
    {
        if (!$this->_options) {
            $this->_options = [];
            foreach ($this->toArray() as $value => $label) {
                $this->_options[] = [
                    'value' => $value,
                    'label' => $label,
                ];
            }
        }

        return $this->_options;
    }
}
