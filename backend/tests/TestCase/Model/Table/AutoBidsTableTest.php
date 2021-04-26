<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AutoBidsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AutoBidsTable Test Case
 */
class AutoBidsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AutoBidsTable
     */
    protected $AutoBids;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.AutoBids',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('AutoBids') ? [] : ['className' => AutoBidsTable::class];
        $this->AutoBids = $this->getTableLocator()->get('AutoBids', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->AutoBids);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test toggleAutoBids method
     *
     * @return void
     */
    public function testToggleAutoBids(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
