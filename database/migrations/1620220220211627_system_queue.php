<?php

use think\migration\Migrator;
use think\migration\db\Column;
use Phinx\Db\Adapter\MysqlAdapter;

class SystemQueue extends Migrator
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
        $table = $this->table('system_queue', ['engine' => 'InnoDB', 'collation' => 'utf8mb4_unicode_ci', 'comment' => '队列任务' ,'id' => 'id' ,'primary_key' => ['id']]);
        $table->addColumn('name', 'string', ['limit' => 255,'null' => false,'default' => null,'signed' => true,'comment' => '名称',])
			->addColumn('queue', 'string', ['limit' => 255,'null' => false,'default' => null,'signed' => true,'comment' => '队列名称',])
			->addColumn('queue_data', 'text', ['limit' => MysqlAdapter::TEXT_REGULAR,'null' => true,'signed' => true,'comment' => '队列数据',])
			->addColumn('status', 'boolean', ['null' => false,'default' => 1,'signed' => true,'comment' => '状态:1等待处理，2正在执行，3已完成，4已失败',])
			->addColumn('is_queue', 'boolean', ['null' => false,'default' => 0,'signed' => true,'comment' => '0并发，1排队',])
			->addColumn('task_time', 'string', ['limit' => 100,'null' => true,'signed' => true,'comment' => '耗时毫秒',])
			->addColumn('plan_time', 'datetime', ['null' => false,'default' => 'CURRENT_TIMESTAMP','signed' => true,'comment' => '计划时间',])
			->addColumn('exec_time', 'datetime', ['null' => false,'default' => 'CURRENT_TIMESTAMP','signed' => true,'comment' => '执行时间',])
			->addColumn('create_time', 'datetime', ['null' => false,'default' => 'CURRENT_TIMESTAMP','signed' => true,'comment' => '创建时间',])
			->addColumn('update_time', 'datetime', ['null' => true,'signed' => true,'comment' => '更新时间',])
            ->create();
    }
}
