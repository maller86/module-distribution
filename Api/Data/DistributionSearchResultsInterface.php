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

use Magento\Framework\Api\SearchResultsInterface;

interface DistributionSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Returns the filtered items.
     *
     * @return DistributionInterface[]
     */
    public function getItems();

    /**
     * Sets the filtered items.
     *
     * @param DistributionInterface[] $items
     *
     * @return $this
     */
    public function setItems(array $items);
}