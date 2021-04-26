<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AuctionItemsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AuctionItemsTable Test Case
 */
class AuctionItemsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AuctionItemsTable
     */
    protected $AuctionItems;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
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
        $config = $this->getTableLocator()->exists('AuctionItems') ? [] : ['className' => AuctionItemsTable::class];
        $this->AuctionItems = $this->getTableLocator()->get('AuctionItems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->AuctionItems);

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
}
