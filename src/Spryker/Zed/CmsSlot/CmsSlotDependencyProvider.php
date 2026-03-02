<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CmsSlot;

use Spryker\Zed\CmsSlot\Dependency\External\CmsSlotToSymfonyValidatorAdapter;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @method \Spryker\Zed\CmsSlot\CmsSlotConfig getConfig()
 */
class CmsSlotDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const CMS_SLOT_VALIDATOR = 'CMS_SLOT_VALIDATOR';

    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = $this->addValidatorAdapter($container);

        return $container;
    }

    protected function addValidatorAdapter(Container $container): Container
    {
        $container->set(static::CMS_SLOT_VALIDATOR, function () {
            return new CmsSlotToSymfonyValidatorAdapter();
        });

        return $container;
    }
}
