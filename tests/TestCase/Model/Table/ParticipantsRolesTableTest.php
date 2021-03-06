<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ParticipantsRolesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ParticipantsRolesTable Test Case
 */
class ParticipantsRolesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ParticipantsRolesTable
     */
    public $ParticipantsRoles;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.participants_roles',
        'app.participants',
        'app.observations',
        'app.runs',
        'app.answers',
        'app.questions',
        'app.clients',
        'app.sessions',
        'app.users',
        'app.clients_participants',
        'app.roles',
        'app.participants_sessions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ParticipantsRoles') ? [] : ['className' => ParticipantsRolesTable::class];
        $this->ParticipantsRoles = TableRegistry::get('ParticipantsRoles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ParticipantsRoles);

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
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
