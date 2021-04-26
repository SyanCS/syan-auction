<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AutoBidsItemsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AutoBidsItemsTable Test Case
 */
class AutoBidsItemsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AutoBidsItemsTable
     */
    protected $AutoBidsItems;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.AutoBidsItems',
        'app.Users',
        'app.AuctionItems',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('AutoBidsItems') ? [] : ['className' => AutoBidsItemsTable::class];
        $this->AutoBidsItems = $this->getTableLocator()->get('AutoBidsItems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->AutoBidsItems);

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
}
