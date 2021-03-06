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

namespace FjodorMaller\Distribution\Api\Data\Distribution;

interface AdapterPoolInterface
{
    /**
     * Returns present adapters.
     *
     * @return OptionAdapterInterface[]
     */
    public function getAdapters();

    /**
     * Returns corresponding adapter for given name.
     *
     * @param string $name
     *
     * @return OptionAdapterInterface|false
     */
    public function getAdapter($name);

    /**
     * Returns true if adapters are present.
     *
     * @return bool
     */
    public function hasAdapters();

    /**
     * Returns true if corresponding adapter for given name is present.
     *
     * @param string $name
     *
     * @return bool
     */
    public function hasAdapter($name);

    /**
     * Adds adapter for given name.
     *
     * @param string                 $name
     * @param OptionAdapterInterface $adapter
     *
     * @return $this
     */
    public function addAdapter($name, OptionAdapterInterface $adapter);

    /**
     * Adds adapters from given data.
     *
     * @param OptionAdapterInterface[] $adapters
     *
     * @return $this
     */
    public function addAdapters(array $adapters);
}
