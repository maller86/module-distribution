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

namespace FjodorMaller\Distribution\Api\Data;

interface DistributionInterface
{
    const PARAM_NAME      = 'distribution';

    const DISTRIBUTION_ID = 'distribution_id';

    const STATUS          = 'status';

    const NAME            = 'name';

    const ADAPTER         = 'adapter';

    const OPTIONS         = 'options';

    const IS_ACTIVE       = 'is_active';

    const HEALTH          = 'health';

    const LAST_CHECK      = 'last_check';

    const LAST_ALIVE      = 'last_alive';

    /**
     * Returns the id.
     *
     * @return int|null
     */
    public function getId();

    /**
     * Sets the status by given value.
     *
     * @param int $status
     *
     * @return $this
     */
    public function setStatus($status);

    /**
     * Returns the status.
     *
     * @return int
     */
    public function getStatus();

    /**
     * Sets the name by given value.
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName($name);

    /**
     * Returns the name.
     *
     * @return string
     */
    public function getName();

    /**
     * Sets the adapter with given value.
     *
     * @param string $adapter
     *
     * @return $this
     */
    public function setAdapter($adapter);

    /**
     * Returns the adapter.
     *
     * @return string
     */
    public function getAdapter();

    /**
     * Sets the options with given data.
     *
     * @param mixed $options
     *
     * @return $this
     */
    public function setOptions(array $options);

    /**
     * Returns the options.
     *
     * @return mixed
     */
    public function getOptions();

    /**
     * Sets flag for active with given value.
     *
     * @param int $bool
     *
     * @return $this
     */
    public function setIsActive($bool);

    /**
     * Returns flag for active.
     *
     * @return bool
     */
    public function getIsActive();

    /**
     * Sets the health with given value.
     *
     * @param int $health
     *
     * @return $this
     */
    public function setHealth($health);

    /**
     * Returns the health.
     *
     * @return int
     */
    public function getHealth();

    /**
     * Sets the date for last check with given value.
     *
     * @param string $datetime
     *
     * @return $this
     */
    public function setLastCheck($datetime);

    /**
     * Returns the date of last check.
     *
     * @return string|false
     */
    public function getLastCheck();

    /**
     * Sets the date for last alive with given value.
     *
     * @param string $datetime
     *
     * @return $this
     */
    public function setLastAlive($datetime);

    /**
     * Returns the date of last alive.
     *
     * @return string|false
     */
    public function getLastAlive();
}
