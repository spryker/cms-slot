<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CmsSlot\Persistence;

use Generated\Shared\Transfer\CmsSlotTransfer;

interface CmsSlotEntityManagerInterface
{
    public function updateCmsSlot(CmsSlotTransfer $cmsSlotTransfer): CmsSlotTransfer;
}
