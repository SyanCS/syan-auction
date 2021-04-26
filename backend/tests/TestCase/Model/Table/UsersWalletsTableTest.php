<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersWalletsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersWalletsTable Test Case
 */
class UsersWalletsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersWalletsTable
     */
    protected $UsersWallets;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.UsersWallets',
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
        $config = $this->getTableLocator()->exists('UsersWallets') ? [] : ['className' => UsersWalletsTable::class];
        $this->UsersWallets = $this->getTableLocator()->get('UsersWallets', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->UsersWallets);

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
