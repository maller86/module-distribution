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

use Aws\S3\S3ClientFactory;
use League\Flysystem\FilesystemFactory;
use FjodorMaller\Distribution\Ui\Component\Form\Distribution\Adapter\AwsS3\Region\Options as RegionOptions;
use FjodorMaller\Distribution\Ui\Component\Form\Distribution\Adapter\AwsS3\Version\Options as VersionOptions;
use League\Flysystem\AwsS3v3\AwsS3AdapterFactory;

/**
 * Class AwsS3
 */
class AwsS3 extends BaseAdapter
{
    /**
     * @var RegionOptions
     */
    protected $_regionOptions;

    /**
     * @var VersionOptions
     */
    protected $_versionOptions;

    /**
     * @var S3ClientFactory
     */
    protected $_s3ClientFactory;

    /**
     * @var FilesystemFactory
     */
    protected $_filesystemFactory;

    /**
     * @var AwsS3AdapterFactory
     */
    protected $_awsS3AdapterFactory;

    /**
     * @param RegionOptions       $regionOptions
     * @param VersionOptions      $versionOptions
     * @param S3ClientFactory     $s3ClientFactory
     * @param FilesystemFactory   $filesystemFactory
     * @param AwsS3AdapterFactory $awsS3AdapterFactory
     *
     * @inheritdoc
     */
    public function __construct(
        RegionOptions $regionOptions,
        VersionOptions $versionOptions,
        S3ClientFactory $s3ClientFactory,
        FilesystemFactory $filesystemFactory,
        AwsS3AdapterFactory $awsS3AdapterFactory,
        array $data = []
    ) {
        parent::__construct($data);
        $this->_regionOptions       = $regionOptions;
        $this->_versionOptions      = $versionOptions;
        $this->_s3ClientFactory     = $s3ClientFactory;
        $this->_filesystemFactory   = $filesystemFactory;
        $this->_awsS3AdapterFactory = $awsS3AdapterFactory;
    }

    /**
     * @inheritdoc
     */
    public function getFormFields()
    {
        return [
            'field_key'     => [
                'name'   => 'key',
                'config' => [
                    'label'       => __('Key'),
                    'value'       => '',
                    'formElement' => 'input',
                    'validation'  => [
                        'required-entry' => true,
                    ],
                ],
            ],
            'field_secret'  => [
                'name'   => 'secret',
                'config' => [
                    'label'       => __('Secret'),
                    'value'       => '',
                    'formElement' => 'input',
                    'validation'  => [
                        'required-entry' => true,
                    ],
                ],
            ],
            'field_region'  => [
                'name'   => 'region',
                'config' => [
                    'label'       => __('Region'),
                    'value'       => 'eu-central-1',
                    'formElement' => 'select',
                    'options'     => $this->_regionOptions,
                ],
            ],
            'field_version' => [
                'name'   => 'version',
                'config' => [
                    'label'       => __('Version'),
                    'value'       => 'latest',
                    'formElement' => 'select',
                    'options'     => $this->_versionOptions,
                ],
            ],
            'field_bucket'  => [
                'name'   => 'bucket',
                'config' => [
                    'label'       => __('Bucket'),
                    'value'       => '',
                    'formElement' => 'input',
                    'validation'  => [
                        'required-entry' => true,
                    ],
                ],
            ],
            'field_prefix'  => [
                'name'   => 'prefix',
                'config' => [
                    'label'       => __('Path'),
                    'value'       => '',
                    'formElement' => 'input',
                    'validation'  => [
                        'required-entry' => true,
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
        $client     = $this->_s3ClientFactory->create([
            'credentials' => [
                'key'    => $options[ 'key' ],
                'secret' => $options[ 'secret' ],
            ],
            'region'      => $options[ 'region' ],
            'version'     => $options[ 'version' ],
        ]);
        $adapter    = $this->_awsS3AdapterFactory->create([
            'client' => $client,
            'bucket' => $options[ 'bucket' ],
            'prefix' => $options[ 'prefix' ],
        ]);
        $filesystem = $this->_filesystemFactory->create([
            'adapter' => $adapter,
        ]);

        return $filesystem;
    }
}
