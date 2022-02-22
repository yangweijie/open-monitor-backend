<?php

use think\migration\Migrator;
use think\migration\db\Column;
use Phinx\Db\Adapter\MysqlAdapter;

class Project extends Migrator
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
        $table = $this->table('project', ['engine' => 'InnoDB', 'collation' => 'utf8_general_ci', 'comment' => '项目表' ,'id' => 'id','signed' => true ,'primary_key' => ['id']]);
        $table->addColumn('name', 'string', ['limit' => 255,'null' => true,'signed' => true,'comment' => '名称',])
			->addColumn('platform', 'string', ['limit' => 255,'null' => true,'signed' => true,'comment' => '使用的平台',])
			->addColumn('is_active', 'boolean', ['null' => true,'signed' => false,'comment' => '是否启用',])
			->addColumn('weekly_report', 'boolean', ['null' => true,'signed' => true,'comment' => '是否需要周报',])
			->addColumn('user_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => false,'default' => 0,'signed' => false,'comment' => '用户id',])
			->addColumn('create_time', 'datetime', ['null' => true,'signed' => true,'comment' => '',])
			->addColumn('update_time', 'datetime', ['null' => true,'signed' => true,'comment' => '',])
			->addColumn('last_usage_day', 'datetime', ['null' => true,'signed' => true,'comment' => '',])
			->addColumn('key', 'string', ['limit' => 64,'null' => false,'default' => null,'signed' => true,'comment' => '项目的key',])
			->addIndex(['key'], ['unique' => true,'name' => 'key'])
            ->create();
    }
}
