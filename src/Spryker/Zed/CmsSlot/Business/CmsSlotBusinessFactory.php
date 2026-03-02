<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CmsSlot\Business;

use Spryker\Zed\CmsSlot\Business\Activator\CmsSlotActivator;
use Spryker\Zed\CmsSlot\Business\Activator\CmsSlotActivatorInterface;
use Spryker\Zed\CmsSlot\Business\CmsSlot\CmsSlotReader;
use Spryker\Zed\CmsSlot\Business\CmsSlot\CmsSlotReaderInterface;
use Spryker\Zed\CmsSlot\Business\CmsSlotTemplate\CmsSlotTemplateReader;
use Spryker\Zed\CmsSlot\Business\CmsSlotTemplate\CmsSlotTemplateReaderInterface;
use Spryker\Zed\CmsSlot\Business\ConstraintsProvider\CmsSlotConstraintsProvider;
use Spryker\Zed\CmsSlot\Business\ConstraintsProvider\CmsSlotTemplateConstraintsProvider;
use Spryker\Zed\CmsSlot\Business\ConstraintsProvider\ConstraintsProviderInterface;
use Spryker\Zed\CmsSlot\Business\Validator\CmsSlotTemplateValidator;
use Spryker\Zed\CmsSlot\Business\Validator\CmsSlotTemplateValidatorInterface;
use Spryker\Zed\CmsSlot\Business\Validator\CmsSlotValidator;
use Spryker\Zed\CmsSlot\Business\Validator\CmsSlotValidatorInterface;
use Spryker\Zed\CmsSlot\CmsSlotDependencyProvider;
use Spryker\Zed\CmsSlot\Dependency\External\CmsSlotToSymfonyValidatorAdapterInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \Spryker\Zed\CmsSlot\CmsSlotConfig getConfig()
 * @method \Spryker\Zed\CmsSlot\Persistence\CmsSlotRepositoryInterface getRepository()
 * @method \Spryker\Zed\CmsSlot\Persistence\CmsSlotEntityManagerInterface getEntityManager()
 */
class CmsSlotBusinessFactory extends AbstractBusinessFactory
{
    public function createCmsSlotValidator(): CmsSlotValidatorInterface
    {
        return new CmsSlotValidator(
            $this->getValidatorAdapter(),
            $this->createCmsSlotConstraintsProvider(),
        );
    }

    public function createCmsSlotTemplateValidator(): CmsSlotTemplateValidatorInterface
    {
        return new CmsSlotTemplateValidator(
            $this->getValidatorAdapter(),
            $this->createCmsSlotTemplateConstraintsProvider(),
        );
    }

    public function createCmsSlotConstraintsProvider(): ConstraintsProviderInterface
    {
        return new CmsSlotConstraintsProvider();
    }

    public function createCmsSlotActivator(): CmsSlotActivatorInterface
    {
        return new CmsSlotActivator(
            $this->getRepository(),
            $this->getEntityManager(),
        );
    }

    public function createCmsSlotReader(): CmsSlotReaderInterface
    {
        return new CmsSlotReader($this->getRepository());
    }

    public function createCmsSlotTemplateReader(): CmsSlotTemplateReaderInterface
    {
        return new CmsSlotTemplateReader($this->getRepository());
    }

    public function createCmsSlotTemplateConstraintsProvider(): ConstraintsProviderInterface
    {
        return new CmsSlotTemplateConstraintsProvider();
    }

    public function getValidatorAdapter(): CmsSlotToSymfonyValidatorAdapterInterface
    {
        return $this->getProvidedDependency(CmsSlotDependencyProvider::CMS_SLOT_VALIDATOR);
    }
}
