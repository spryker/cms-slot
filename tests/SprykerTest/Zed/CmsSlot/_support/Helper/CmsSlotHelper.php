<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Zed\CmsSlot\Helper;

use Codeception\Module;
use Generated\Shared\DataBuilder\CmsSlotBuilder;
use Generated\Shared\DataBuilder\CmsSlotTemplateBuilder;
use Generated\Shared\Transfer\CmsSlotTemplateTransfer;
use Generated\Shared\Transfer\CmsSlotTransfer;
use Orm\Zed\CmsSlot\Persistence\SpyCmsSlot;
use Orm\Zed\CmsSlot\Persistence\SpyCmsSlotQuery;
use Orm\Zed\CmsSlot\Persistence\SpyCmsSlotTemplate;
use Orm\Zed\CmsSlot\Persistence\SpyCmsSlotTemplateQuery;
use Orm\Zed\CmsSlot\Persistence\SpyCmsSlotToCmsSlotTemplateQuery;
use SprykerTest\Shared\Testify\Helper\DataCleanupHelperTrait;
use SprykerTest\Shared\Testify\Helper\LocatorHelperTrait;

class CmsSlotHelper extends Module
{
    use DataCleanupHelperTrait;
    use LocatorHelperTrait;

    public function haveCmsSlot(array $override = []): CmsSlotTransfer
    {
        $cmsSlotData = [
            CmsSlotTransfer::KEY => 'test-center',
            CmsSlotTransfer::CONTENT_PROVIDER_TYPE => 'SprykerCmsSlotBlock',
            CmsSlotTransfer::NAME => 'Test Name',
            CmsSlotTransfer::DESCRIPTION => 'Test description.',
            CmsSlotTransfer::IS_ACTIVE => true,
        ];

        $cmsSlotTransfer = (new CmsSlotBuilder(array_merge($cmsSlotData, $override)))->build();

        return $cmsSlotTransfer;
    }

    public function haveCmsSlotTemplate(array $override = []): CmsSlotTemplateTransfer
    {
        $cmsSlotTemplateData = [
            CmsSlotTemplateTransfer::PATH => '@TestModule/views/test/test.twig',
            CmsSlotTemplateTransfer::NAME => 'Test Name',
            CmsSlotTemplateTransfer::DESCRIPTION => 'Test description.',
        ];

        $cmsSlotTemplateTransfer = (new CmsSlotTemplateBuilder(array_merge($cmsSlotTemplateData, $override)))->build();

        return $cmsSlotTemplateTransfer;
    }

    public function haveCmsSlotInDb(array $override = []): CmsSlotTransfer
    {
        $cmsSlotTransfer = $this->haveCmsSlot($override);

        $cmsSlotEntity = new SpyCmsSlot();
        $cmsSlotEntity->fromArray($cmsSlotTransfer->toArray());
        $cmsSlotEntity->save();

        $cmsSlotTransfer->setIdCmsSlot($cmsSlotEntity->getIdCmsSlot());

        $this->getDataCleanupHelper()->_addCleanup(function () use ($cmsSlotTransfer): void {
            $this->cleanupCmsSlot($cmsSlotTransfer);
        });

        return $cmsSlotTransfer;
    }

    protected function cleanupCmsSlot(CmsSlotTransfer $cmsSlotTransfer): void
    {
        $this->debug(sprintf('Deleting CMS Slot: %d', $cmsSlotTransfer->getIdCmsSlot()));
        $this->getCmsSlotQuery()
            ->findByIdCmsSlot($cmsSlotTransfer->getIdCmsSlot())
            ->delete();
    }

    public function haveCmsSlotTemplateInDb(array $override = []): CmsSlotTemplateTransfer
    {
        $cmsSlotTemplateTransfer = $this->haveCmsSlotTemplate($override);

        $cmsSlotTemplateEntity = new SpyCmsSlotTemplate();
        $cmsSlotTemplateEntity->fromArray($cmsSlotTemplateTransfer->toArray());
        $cmsSlotTemplateEntity->setPathHash(md5($cmsSlotTemplateTransfer->getPath()));
        $cmsSlotTemplateEntity->save();

        $cmsSlotTemplateTransfer->setIdCmsSlotTemplate($cmsSlotTemplateEntity->getIdCmsSlotTemplate());

        $this->getDataCleanupHelper()->_addCleanup(function () use ($cmsSlotTemplateTransfer): void {
            $this->cleanupCmsSlotTemplate($cmsSlotTemplateTransfer);
        });

        return $cmsSlotTemplateTransfer;
    }

    protected function cleanupCmsSlotTemplate(CmsSlotTemplateTransfer $cmsSlotTemplateTransfer): void
    {
        $this->debug(sprintf('Deleting CMS Slot Template: %d', $cmsSlotTemplateTransfer->getIdCmsSlotTemplate()));

        $this->getCmsSlotTemplateQuery()
            ->findByIdCmsSlotTemplate($cmsSlotTemplateTransfer->getIdCmsSlotTemplate())
            ->delete();
    }

    public function isActiveCmsSlotById(int $idCmsSlot): bool
    {
        $cmsSlotEntity = SpyCmsSlotQuery::create()->findOneByIdCmsSlot($idCmsSlot);

        if (!$cmsSlotEntity) {
            return false;
        }

        return $cmsSlotEntity->getIsActive();
    }

    protected function getCmsSlotQuery(): SpyCmsSlotQuery
    {
        return SpyCmsSlotQuery::create();
    }

    protected function getCmsSlotTemplateQuery(): SpyCmsSlotTemplateQuery
    {
        return SpyCmsSlotTemplateQuery::create();
    }

    public function ensureCmsSlotTableIsEmpty(): void
    {
        $this->getCmsSlotToCmsSlotTemplateQuery()->deleteAll();
        $this->getCmsSlotQuery()->deleteAll();
    }

    public function ensureCmsSlotTemplateTableIsEmpty(): void
    {
        $this->getCmsSlotToCmsSlotTemplateQuery()->deleteAll();
        $this->getCmsSlotTemplateQuery()->deleteAll();
    }

    protected function getCmsSlotToCmsSlotTemplateQuery(): SpyCmsSlotToCmsSlotTemplateQuery
    {
        return SpyCmsSlotToCmsSlotTemplateQuery::create();
    }
}
