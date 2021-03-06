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

namespace FjodorMaller\Distribution\Model\Distribution\Adapter;

use League\Flysystem\FilesystemFactory;
use League\Flysystem\Sftp\SftpAdapterFactory as AdapterFactory;

/**
 * Class Sftp
 */
class Sftp extends BaseAdapter
{
    /**
     * @var AdapterFactory
     */
    protected $_adapterFactory;

    /**
     * @var FilesystemFactory
     */
    protected $_filesystemFactory;

    /**
     * @param AdapterFactory    $adapterFactory
     * @param FilesystemFactory $filesystemFactory
     *
     * @inheritdoc
     */
    public function __construct(
        AdapterFactory $adapterFactory,
        FilesystemFactory $filesystemFactory,
        array $data = []
    ) {
        parent::__construct($data);
        $this->_adapterFactory    = $adapterFactory;
        $this->_filesystemFactory = $filesystemFactory;
    }

    /**
     * @inheritdoc
     */
    public function getFormFields()
    {
        return [
            'field_host'     => [
                'name'   => 'host',
                'config' => [
                    'label'       => __('Host'),
                    'value'       => '',
                    'formElement' => 'input',
                    'validation'  => [
                        'required-entry' => true,
                    ],
                ],
            ],
            'field_username' => [
                'name'   => 'username',
                'config' => [
                    'label'       => __('Username'),
                    'value'       => '',
                    'formElement' => 'input',
                    'validation'  => [
                        'required-entry' => true,
                    ],
                ],
            ],
            'field_password' => [
                'name'   => 'password',
                'config' => [
                    'label'       => __('Password'),
                    'value'       => '',
                    'formElement' => 'input',
                ],
            ],
            'field_port'     => [
                'name'   => 'port',
                'config' => [
                    'label'       => __('Port'),
                    'value'       => '22',
                    'formElement' => 'input',
                    'validation'  => [
                        'required-entry' => true,
                    ],
                ],
            ],
            'field_path'     => [
                'name'   => 'root',
                'config' => [
                    'label'       => __('Path'),
                    'value'       => '/',
                    'formElement' => 'input',
                    'notice'      => __('The remote path to enter after connection successfully established.'),
                    'validation'  => [
                        'required-entry' => true,
                    ],
                ],
            ],
            'field_passive'  => [
                'name'   => 'passive',
                'config' => [
                    'label'       => __('Passive'),
                    'value'       => '1',
                    'formElement' => 'checkbox',
                    'prefer'      => 'toggle',
                    'valueMap'    => [
                        'false' => '0',
                        'true'  => '1',
                    ],
                ],
            ],
            'field_timeout'  => [
                'name'   => 'timeout',
                'config' => [
                    'label'       => __('Timeout'),
                    'value'       => '30',
                    'formElement' => 'input',
                    'notice'      => __('The timeout for the connection.'),
                    'validation'  => [
                        'required-entry'  => true,
                        'required-number' => true,
                    ],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function createFilesystem(array $options = [])
    {
        $this->ensureRequiredOptions($options);
        $adapter    = $this->_adapterFactory->create([
            'host'     => $options[ 'host' ],
            'username' => $options[ 'username' ],
            'password' => $options[ 'password' ],
            'port'     => $options[ 'port' ],
            'root'     => $options[ 'root' ],
            'passive'  => $options[ 'passive' ],
            'timeout'  => $options[ 'timeout' ],
        ]);
        $filesystem = $this->_filesystemFactory->create([
            'adapter' => $adapter,
        ]);

        return $filesystem;
    }
}
