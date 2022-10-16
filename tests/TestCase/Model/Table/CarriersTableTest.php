<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CarriersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CarriersTable Test Case
 */
class CarriersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CarriersTable
     */
    protected $Carriers;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Carriers',
        'app.Countries',
        'app.Devices',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Carriers') ? [] : ['className' => CarriersTable::class];
        $this->Carriers = $this->getTableLocator()->get('Carriers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Carriers);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\CarriersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\CarriersTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
