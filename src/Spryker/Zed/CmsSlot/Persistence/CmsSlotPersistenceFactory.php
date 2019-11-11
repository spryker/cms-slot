<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CmsSlot\Persistence;

use Orm\Zed\CmsSlot\Persistence\SpyCmsSlotQuery;
use Orm\Zed\CmsSlot\Persistence\SpyCmsSlotTemplateQuery;
use Spryker\Zed\CmsSlot\Persistence\Propel\Mapper\CmsSlotMapper;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \Spryker\Zed\CmsSlot\CmsSlotConfig getConfig()
 * @method \Spryker\Zed\CmsSlot\Persistence\CmsSlotRepositoryInterface getRepository()
 * @method \Spryker\Zed\CmsSlot\Persistence\CmsSlotEntityManagerInterface getEntityManager()
 */
class CmsSlotPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CmsSlot\Persistence\SpyCmsSlotQuery
     */
    public function createCmsSlotQuery(): SpyCmsSlotQuery
    {
        return SpyCmsSlotQuery::create();
    }

    /**
     * @return \Orm\Zed\CmsSlot\Persistence\SpyCmsSlotTemplateQuery
     */
    public function createCmsSlotTemplateQuery(): SpyCmsSlotTemplateQuery
    {
        return SpyCmsSlotTemplateQuery::create();
    }

    /**
     * @return \Spryker\Zed\CmsSlot\Persistence\Propel\Mapper\CmsSlotMapper
     */
    public function createCmsSlotMapper(): CmsSlotMapper
    {
        return new CmsSlotMapper();
    }
}
