<?php

use think\migration\Migrator;
use think\migration\db\Column;
use Phinx\Db\Adapter\MysqlAdapter;

class Segement extends Migrator
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
        $table = $this->table('segement', ['engine' => 'InnoDB', 'collation' => 'utf8_general_ci', 'comment' => '片段' ,'id' => 'id','signed' => true ,'primary_key' => ['id']]);
        $table->addColumn('hash', 'string', ['limit' => 32,'null' => false,'default' => null,'signed' => true,'comment' => '',])
			->addColumn('group_hash', 'string', ['limit' => 32,'null' => false,'default' => null,'signed' => true,'comment' => '',])
			->addColumn('type', 'string', ['limit' => 32,'null' => false,'default' => '','signed' => true,'comment' => '类型',])
			->addColumn('project_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => false,'default' => null,'signed' => false,'comment' => '',])
			->addColumn('host', 'json', ['null' => true,'signed' => true,'comment' => '',])
			->addColumn('create_time', 'datetime', ['null' => false,'default' => null,'signed' => true,'comment' => '',])
			->addColumn('duration', 'float', ['precision' => 10,'scale' => 2,'null' => false,'default' => null,'signed' => true,'comment' => '',])
			->addColumn('label', 'string', ['limit' => 2048,'null' => true,'signed' => true,'comment' => '',])
			->addColumn('start', 'float', ['precision' => 10,'scale' => 2,'null' => true,'signed' => false,'comment' => '',])
			->addIndex(['group_hash'], ['name' => 'group_hash'])
            ->create();
    }
}
