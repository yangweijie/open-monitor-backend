<?php

use think\migration\Migrator;
use think\migration\db\Column;
use Phinx\Db\Adapter\MysqlAdapter;

class Errors extends Migrator
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
        $table = $this->table('errors', ['engine' => 'InnoDB', 'collation' => 'utf8_general_ci', 'comment' => '异常' ,'id' => 'id','signed' => true ,'primary_key' => ['id']]);
        $table->addColumn('project_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => false,'default' => null,'signed' => true,'comment' => '',])
			->addColumn('create_time', 'datetime', ['null' => true,'signed' => true,'comment' => '',])
			->addColumn('update_time', 'datetime', ['null' => true,'signed' => true,'comment' => '',])
			->addColumn('message', 'string', ['limit' => 255,'null' => true,'signed' => true,'comment' => '',])
			->addColumn('handled', 'boolean', ['null' => true,'signed' => true,'comment' => '',])
			->addColumn('group_hash', 'string', ['limit' => 32,'null' => true,'signed' => true,'comment' => '',])
			->addColumn('muted', 'boolean', ['null' => true,'signed' => true,'comment' => '',])
			->addColumn('last_seen_at', 'datetime', ['null' => true,'signed' => true,'comment' => '',])
			->addColumn('class', 'string', ['limit' => 255,'null' => false,'default' => null,'signed' => true,'comment' => '',])
			->addColumn('file', 'string', ['limit' => 1024,'null' => true,'signed' => true,'comment' => '',])
			->addColumn('line', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => true,'signed' => true,'comment' => '',])
			->addColumn('code', 'string', ['limit' => 255,'null' => true,'signed' => true,'comment' => '',])
			->addColumn('stack', 'json', ['null' => true,'signed' => true,'comment' => '',])
			->addColumn('hash', 'string', ['limit' => 32,'null' => true,'signed' => true,'comment' => '',])
            ->create();
    }
}
