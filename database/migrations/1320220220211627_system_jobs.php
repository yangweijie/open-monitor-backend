<?php

use think\migration\Migrator;
use think\migration\db\Column;
use Phinx\Db\Adapter\MysqlAdapter;

class SystemJobs extends Migrator
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('system_jobs', ['engine' => 'InnoDB', 'collation' => 'utf8_general_ci', 'comment' => '' ,'id' => 'id' ,'primary_key' => ['id']]);
        $table->addColumn('queue', 'string', ['limit' => 255,'null' => false,'default' => null,'signed' => true,'comment' => '',])
			->addColumn('payload', 'text', ['limit' => MysqlAdapter::TEXT_LONG,'null' => false,'signed' => true,'comment' => '',])
			->addColumn('attempts', 'boolean', ['null' => false,'default' => null,'signed' => false,'comment' => '',])
			->addColumn('reserve_time', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => true,'signed' => false,'comment' => '',])
			->addColumn('available_time', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => false,'default' => null,'signed' => false,'comment' => '',])
			->addColumn('create_time', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => false,'default' => null,'signed' => false,'comment' => '',])
			->addIndex(['queue'], ['name' => 'queue'])
            ->create();
    }
}
