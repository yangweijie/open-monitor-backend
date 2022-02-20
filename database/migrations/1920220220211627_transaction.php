<?php

use think\migration\Migrator;
use think\migration\db\Column;
use Phinx\Db\Adapter\MysqlAdapter;

class Transaction extends Migrator
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
        $table = $this->table('transaction', ['engine' => 'InnoDB', 'collation' => 'utf8_general_ci', 'comment' => '会话表' ,'id' => 'id','signed' => true ,'primary_key' => ['id']]);
        $table->addColumn('group_hash', 'string', ['limit' => 32,'null' => false,'default' => null,'signed' => true,'comment' => 'path 加密后的',])
			->addColumn('project_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => false,'default' => null,'signed' => false,'comment' => '',])
			->addColumn('memory', 'float', ['precision' => 10,'scale' => 2,'null' => true,'signed' => true,'comment' => '内存',])
			->addColumn('p50', 'float', ['precision' => 11,'scale' => 1,'null' => true,'signed' => true,'comment' => '耗时平均',])
			->addColumn('last_record', 'json', ['null' => true,'signed' => true,'comment' => '最后一次记录',])
			->addColumn('name', 'string', ['limit' => 255,'null' => true,'signed' => true,'comment' => '',])
			->addColumn('type', 'enum', ['values' => ['request','process']])
			->addColumn('host', 'json', ['null' => true,'signed' => true,'comment' => '',])
			->addColumn('create_time', 'datetime', ['null' => true,'signed' => true,'comment' => '',])
			->addColumn('update_time', 'datetime', ['null' => true,'signed' => true,'comment' => '',])
			->addColumn('context', 'json', ['null' => true,'signed' => true,'comment' => '',])
			->addColumn('http', 'json', ['null' => true,'signed' => true,'comment' => '',])
			->addColumn('hash', 'string', ['limit' => 128,'null' => true,'signed' => true,'comment' => '',])
			->addColumn('result', 'string', ['limit' => 16,'null' => true,'signed' => true,'comment' => '',])
			->addIndex(['hash'], ['name' => 'hash'])
			->addIndex(['group_hash'], ['name' => 'group_hash'])
            ->create();
    }
}
