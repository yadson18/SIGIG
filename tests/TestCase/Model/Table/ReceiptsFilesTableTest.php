<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReceiptsFilesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReceiptsFilesTable Test Case
 */
class ReceiptsFilesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ReceiptsFilesTable
     */
    public $ReceiptsFiles;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.receipts_files'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ReceiptsFiles') ? [] : ['className' => 'App\Model\Table\ReceiptsFilesTable'];
        $this->ReceiptsFiles = TableRegistry::get('ReceiptsFiles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ReceiptsFiles);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
