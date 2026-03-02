<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CmsSlot\Business\Validator;

use Generated\Shared\Transfer\CmsSlotTransfer;
use Generated\Shared\Transfer\ValidationResponseTransfer;
use Spryker\Zed\CmsSlot\Business\ConstraintsProvider\ConstraintsProviderInterface;
use Spryker\Zed\CmsSlot\Dependency\External\CmsSlotToSymfonyValidatorAdapterInterface;

class CmsSlotValidator extends AbstractTransferValidator implements CmsSlotValidatorInterface
{
    /**
     * @var \Spryker\Zed\CmsSlot\Dependency\External\CmsSlotToSymfonyValidatorAdapterInterface
     */
    protected $validatorAdapter;

    /**
     * @var \Spryker\Zed\CmsSlot\Business\ConstraintsProvider\ConstraintsProviderInterface
     */
    protected $constraintsProvider;

    public function __construct(
        CmsSlotToSymfonyValidatorAdapterInterface $validatorAdapter,
        ConstraintsProviderInterface $constraintsProvider
    ) {
        $this->validatorAdapter = $validatorAdapter;
        $this->constraintsProvider = $constraintsProvider;
    }

    public function validateCmsSlot(CmsSlotTransfer $cmsSlotTransfer): ValidationResponseTransfer
    {
        return $this->validate($cmsSlotTransfer, $this->validatorAdapter, $this->constraintsProvider);
    }
}
