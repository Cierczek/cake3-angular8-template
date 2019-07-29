<?php

use Cake\Console\ConsoleIo;
use Phinx\Migration\AbstractMigration;

class CreateUsersTable extends AbstractMigration
{
    public function change()
    {

        $console = new ConsoleIo();
        $console->out('Create Users Table', 0);

        $usersTable = $this->table('users');
        $usersTable->addColumn('username', 'string', [
            'limit' => 255,
            'null' => false,
        ]);
        $usersTable->addColumn('password', 'string', [
            'limit' => 255,
            'null' => false,
        ]);
        $usersTable->addColumn('gender', 'integer', [
            'limit' => 1,
            'null' => false
        ]);
        $usersTable->addColumn('name', 'string', [
            'limit' => 255,
            'null' => false,
        ]);
        $usersTable->addColumn('surname', 'string', [
            'limit' => 255,
            'null' => false,
        ]);
        $usersTable->addColumn('email', 'string', [
            'limit' => 255,
            'null' => false,
        ]);
        $usersTable->addColumn('birth', 'datetime', [
            'null' => false
        ]);
        $usersTable->addColumn('phone', 'string', [
            'limit' => 255,
            'null' => false
        ]);
        $usersTable->addColumn('mobile', 'string', [
            'limit' => 255,
            'null' => false
        ]);
        $usersTable->addColumn('created', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $usersTable->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $usersTable->create();
        $console->success('...OK');
    }

}