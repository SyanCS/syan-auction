<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BidsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BidsTable Test Case
 */
class BidsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BidsTable
     */
    protected $Bids;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Bids',
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
        $config = $this->getTableLocator()->exists('Bids') ? [] : ['className' => BidsTable::class];
        $this->Bids = $this->getTableLocator()->get('Bids', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Bids);

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
     * Test getItemHighestBid method
     *
     * @return void
     */
    public function testGetItemHighestBid(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
