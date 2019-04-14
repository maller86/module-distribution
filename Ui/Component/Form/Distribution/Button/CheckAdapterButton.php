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

namespace FjodorMaller\Distribution\Ui\Component\Form\Distribution\Button;

use Magento\Ui\Component\Form\Field;

/**
 * Class CheckAdapterButton
 */
class CheckAdapterButton extends Field
{
    /**
     * @inheritdoc
     */
    public function prepare()
    {
        parent::prepare();
        $this->_data[ 'config' ][ 'actions' ] = [
            [
                'actionName' => 'check',
                'targetName' => '${ $.name }',
                'params'     => [
                    json_encode([
                        'checkUrl' => $this->getContext()->getUrl('distribution/index/check', [
                            'isAjax' => true,
                        ]),
                    ]),
                ],
            ],
        ];
    }
}