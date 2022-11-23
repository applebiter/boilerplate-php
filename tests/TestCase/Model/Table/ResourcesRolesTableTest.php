<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ResourcesRolesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ResourcesRolesTable Test Case
 */
class ResourcesRolesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ResourcesRolesTable
     */
    protected $ResourcesRoles;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.ResourcesRoles',
        'app.Resources',
        'app.Roles',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ResourcesRoles') ? [] : ['className' => ResourcesRolesTable::class];
        $this->ResourcesRoles = $this->getTableLocator()->get('ResourcesRoles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ResourcesRoles);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ResourcesRolesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ResourcesRolesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
