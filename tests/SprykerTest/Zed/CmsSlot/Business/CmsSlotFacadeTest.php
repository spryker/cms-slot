<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Zed\CmsSlot\Business;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CmsSlotCriteriaTransfer;
use Generated\Shared\Transfer\CmsSlotTemplateTransfer;
use Generated\Shared\Transfer\CmsSlotTransfer;
use Generated\Shared\Transfer\FilterTransfer;
use Orm\Zed\CmsSlot\Persistence\Map\SpyCmsSlotTableMap;
use Spryker\Zed\CmsSlot\Business\Exception\MissingCmsSlotException;
use Spryker\Zed\CmsSlot\Business\Exception\MissingCmsSlotTemplateException;

/**
 * Auto-generated group annotations
 *
 * @group SprykerTest
 * @group Zed
 * @group CmsSlot
 * @group Business
 * @group Facade
 * @group CmsSlotFacadeTest
 * Add your own group annotations below this line
 */
class CmsSlotFacadeTest extends Unit
{
    protected const EXCEPTION_ERROR_MESSAGE_MISSING_CMS_SLOT_TEMPLATE = 'CMS Slot Template with id "%d" not found.';
    protected const EXCEPTION_ERROR_MESSAGE_MISSING_CMS_SLOT = 'CMS Slot with id "%d" not found.';

    /**
     * @var \SprykerTest\Zed\CmsSlot\CmsSlotBusinessTester
     */
    protected $tester;

    /**
     * @return void
     */
    public function testValidateCmsSlotSuccess(): void
    {
        // Arrange
        $cmsSlotTransfer = $this->tester->haveCmsSlot();

        // Act
        $validationResponse = $this->tester->getFacade()->validateCmsSlot($cmsSlotTransfer);

        // Assert
        $this->assertTrue($validationResponse->getIsSuccess());
    }

    /**
     * @return void
     */
    public function testValidateCmsSlotFailsOnInvalidName(): void
    {
        // Arrange
        $cmsSlotTransfer = $this->tester->haveCmsSlot([
            CmsSlotTransfer::NAME => str_repeat('t', 300),
        ]);

        // Act
        $validationResponse = $this->tester->getFacade()->validateCmsSlot($cmsSlotTransfer);

        // Assert
        $this->assertFalse($validationResponse->getIsSuccess());
    }

    /**
     * @return void
     */
    public function testValidateCmsSlotFailsOnInvalidDescription(): void
    {
        // Arrange
        $cmsSlotTransfer = $this->tester->haveCmsSlot([
            CmsSlotTransfer::DESCRIPTION => str_repeat('t', 1500),
        ]);

        // Act
        $validationResponse = $this->tester->getFacade()->validateCmsSlot($cmsSlotTransfer);

        // Assert
        $this->assertFalse($validationResponse->getIsSuccess());
    }

    /**
     * @return void
     */
    public function testValidateCmsSlotFailsOnInvalidKey(): void
    {
        // Arrange
        $cmsSlotTransfer = $this->tester->haveCmsSlot([
            CmsSlotTransfer::KEY => 'invalid key',
        ]);

        // Act
        $validationResponse = $this->tester->getFacade()->validateCmsSlot($cmsSlotTransfer);

        // Assert
        $this->assertFalse($validationResponse->getIsSuccess());
    }

    /**
     * @return void
     */
    public function testValidateCmsSlotFailsOnInvalidContentProviderType(): void
    {
        // Arrange
        $cmsSlotTransfer = $this->tester->haveCmsSlot([
            CmsSlotTransfer::CONTENT_PROVIDER_TYPE => '',
        ]);

        // Act
        $validationResponse = $this->tester->getFacade()->validateCmsSlot($cmsSlotTransfer);

        // Assert
        $this->assertFalse($validationResponse->getIsSuccess());
    }

    /**
     * @return void
     */
    public function testValidateCmsSlotFailsOnInvalidIsActive(): void
    {
        // Arrange
        $cmsSlotTransfer = $this->tester->haveCmsSlot([
            CmsSlotTransfer::IS_ACTIVE => 2,
        ]);

        // Act
        $validationResponse = $this->tester->getFacade()->validateCmsSlot($cmsSlotTransfer);

        // Assert
        $this->assertFalse($validationResponse->getIsSuccess());
    }

    /**
     * @return void
     */
    public function testValidateCmsSlotTemplateSuccess(): void
    {
        // Arrange
        $cmsSlotTemplateTransfer = $this->tester->haveCmsSlotTemplate();

        // Act
        $validationResponse = $this->tester->getFacade()->validateCmsSlotTemplate($cmsSlotTemplateTransfer);

        // Assert
        $this->assertTrue($validationResponse->getIsSuccess());
    }

    /**
     * @return void
     */
    public function testValidateCmsSlotTemplateFailsOnInvalidName(): void
    {
        // Arrange
        $cmsSlotTemplateTransfer = $this->tester->haveCmsSlotTemplate([
            CmsSlotTemplateTransfer::NAME => str_repeat('t', 300),
        ]);

        // Act
        $validationResponse = $this->tester->getFacade()->validateCmsSlotTemplate($cmsSlotTemplateTransfer);

        // Assert
        $this->assertFalse($validationResponse->getIsSuccess());
    }

    /**
     * @return void
     */
    public function testValidateCmsSlotTemplateFailsOnInvalidDescription(): void
    {
        // Arrange
        $cmsSlotTemplateTransfer = $this->tester->haveCmsSlotTemplate([
            CmsSlotTemplateTransfer::DESCRIPTION => str_repeat('t', 1500),
        ]);

        // Act
        $validationResponse = $this->tester->getFacade()->validateCmsSlotTemplate($cmsSlotTemplateTransfer);

        // Assert
        $this->assertFalse($validationResponse->getIsSuccess());
    }

    /**
     * @return void
     */
    public function testValidateCmsSlotTemplateFailsOnInvalidPath(): void
    {
        // Arrange
        $cmsSlotTemplateTransfer = $this->tester->haveCmsSlotTemplate([
            CmsSlotTemplateTransfer::PATH => 'invalid path',
        ]);

        // Act
        $validationResponse = $this->tester->getFacade()->validateCmsSlotTemplate($cmsSlotTemplateTransfer);

        // Assert
        $this->assertFalse($validationResponse->getIsSuccess());
    }

    /**
     * @return void
     */
    public function testActivateByIdCmsSlotSuccess(): void
    {
        // Arrange
        $cmsSlotTransfer = $this->tester->haveCmsSlotInDb([
            CmsSlotTransfer::IS_ACTIVE => false,
        ]);

        // Act
        $this->tester->getFacade()->activateByIdCmsSlot($cmsSlotTransfer->getIdCmsSlot());

        // Assert
        $this->assertTrue($this->tester->isActiveCmsSlotById($cmsSlotTransfer->getIdCmsSlot()));
    }

    /**
     * @return void
     */
    public function testDeactivateByIdCmsSlotSuccess(): void
    {
        // Arrange
        $cmsSlotTransfer = $this->tester->haveCmsSlotInDb([
            CmsSlotTransfer::IS_ACTIVE => true,
        ]);

        // Act
        $this->tester->getFacade()->deactivateByIdCmsSlot($cmsSlotTransfer->getIdCmsSlot());

        // Assert
        $this->assertFalse($this->tester->isActiveCmsSlotById($cmsSlotTransfer->getIdCmsSlot()));
    }

    /**
     * @return void
     */
    public function testGetCmsSlotsByCriteriaReturnsCmsSlotTransfers(): void
    {
        // Arrange
        $this->tester->haveCmsSlotInDb();
        $filterTransfer = (new FilterTransfer())
            ->setLimit(10)
            ->setOffset(0)
            ->setOrderBy(SpyCmsSlotTableMap::COL_ID_CMS_SLOT);

        // Act
        $cmsSlotTransfers = $this->tester->getFacade()->getCmsSlotsByCriteria(
            (new CmsSlotCriteriaTransfer())->setFilter($filterTransfer)
        );

        // Assert
        foreach ($cmsSlotTransfers as $cmsSlotTransfer) {
            $this->assertInstanceOf(CmsSlotTransfer::class, $cmsSlotTransfer);
        }
    }

    /**
     * @return void
     */
    public function testGetCmsSlotsByCriteriaReturnsCmsSlotTransfersWithCorrectData(): void
    {
        // Arrange
        $cmsSlotTransfer = $this->tester->haveCmsSlotInDb([CmsSlotTransfer::IS_ACTIVE => true]);

        // Act
        $cmsSlotTransferFromDb = $this->tester->getFacade()->getCmsSlotsByCriteria(
            (new CmsSlotCriteriaTransfer())->setCmsSlotIds([$cmsSlotTransfer->getIdCmsSlot()])
        )[0];

        // Assert
        $this->assertEquals($cmsSlotTransferFromDb, $cmsSlotTransfer);
    }

    /**
     * @return void
     */
    public function testGetCmsSlotTemplateByIdIsSuccessful(): void
    {
        //Arrange
        $cmsSlotTemplateTransfer = $this->tester->haveCmsSlotTemplateInDb();

        //Act
        $foundCmsSlotTemplateTransfer = $this->tester->getFacade()->getCmsSlotTemplateById(
            $cmsSlotTemplateTransfer->getIdCmsSlotTemplate()
        );

        // Assert
        $this->assertEquals($cmsSlotTemplateTransfer, $foundCmsSlotTemplateTransfer);
    }

    /**
     * @return void
     */
    public function testGetCmsSlotTemplateByIdFailsWithException(): void
    {
        //Arrange
        $this->expectExceptionObject(
            new MissingCmsSlotTemplateException(
                sprintf(
                    static::EXCEPTION_ERROR_MESSAGE_MISSING_CMS_SLOT_TEMPLATE,
                    0
                )
            )
        );

        //Act
        $cmsSlotTemplateTransfer = $this->tester->getFacade()->getCmsSlotTemplateById(0);

        // Assert
        $this->assertNull($cmsSlotTemplateTransfer);
    }

    /**
     * @return void
     */
    public function testGetCmsSlotByIdReturnsTransferWithCorrectDataIfSlotExists(): void
    {
        // Arrange
        $cmsSlotTransfer = $this->tester->haveCmsSlotInDb();

        // Act
        $cmsSlotTransferFromDb = $this->tester->getFacade()->getCmsSlotById($cmsSlotTransfer->getIdCmsSlot());

        // Assert
        $this->assertEquals($cmsSlotTransfer, $cmsSlotTransferFromDb);
    }

    /**
     * @return void
     */
    public function testFindCmsSlotByIdFailsWithException(): void
    {
        // Arrange
        $this->expectExceptionObject(
            new MissingCmsSlotException(
                sprintf(
                    static::EXCEPTION_ERROR_MESSAGE_MISSING_CMS_SLOT,
                    0
                )
            )
        );

        // Act
        $cmsSlotTransferFromDb = $this->tester->getFacade()->getCmsSlotById(0);

        // Assert
        $this->assertNull($cmsSlotTransferFromDb);
    }
}
