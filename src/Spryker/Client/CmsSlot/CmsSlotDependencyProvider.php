<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\CmsSlot;

use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;

class CmsSlotDependencyProvider extends AbstractDependencyProvider
{
    /**
     * @var string
     */
    public const EXTERNAL_DATA_PROVIDER_STRATEGY_PLUGINS = 'EXTERNAL_DATA_PROVIDER_STRATEGY_PLUGINS';

    public function provideServiceLayerDependencies(Container $container): Container
    {
        $container = $this->addExternalDataProviderStrategyPlugins($container);

        return $container;
    }

    protected function addExternalDataProviderStrategyPlugins(Container $container): Container
    {
        $container->set(static::EXTERNAL_DATA_PROVIDER_STRATEGY_PLUGINS, function () {
            return $this->getExternalDataProviderStrategyPlugins();
        });

        return $container;
    }

    /**
     * @return array<\Spryker\Client\CmsSlotExtension\Dependency\Plugin\ExternalDataProviderStrategyPluginInterface>
     */
    public function getExternalDataProviderStrategyPlugins(): array
    {
        return [];
    }
}
