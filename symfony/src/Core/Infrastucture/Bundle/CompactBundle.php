<?php

namespace App\Core\Infrastucture\Bundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * The compact bundle combines a bundle definition with an {@link ExtensionInterface} to provide sound defaults for
 * implementing custom bundles.
 */
abstract class CompactBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function getContainerExtension(): CompactBundleExtension
    {
        return new CompactBundleExtension($this);
    }
}
