<?php

use think\migration\Migrator;
use think\migration\db\Column;
use Phinx\Db\Adapter\MysqlAdapter;

class SystemAuth extends Migrator
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
        $table = $this->table('system_auth', ['engine' => 'InnoDB', 'collation' => 'utf8mb4_unicode_ci', 'comment' => '系统-权限' ,'id' => 'id' ,'primary_key' => ['id']]);
        $table->addColumn('pid', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => false,'default' => 0,'signed' => true,'comment' => '上级id',])
			->addColumn('admin_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => false,'default' => 0,'signed' => true,'comment' => '创建人id',])
			->addColumn('name', 'string', ['limit' => 20,'null' => false,'default' => '','signed' => true,'comment' => '权限角色名称',])
			->addColumn('status', 'boolean', ['null' => false,'default' => 1,'signed' => true,'comment' => '权限角色状态',])
			->addColumn('sort', 'integer', ['limit' => MysqlAdapter::INT_BIG,'null' => false,'default' => 0,'signed' => true,'comment' => '排序',])
			->addColumn('desc', 'string', ['limit' => 255,'null' => false,'default' => '','signed' => true,'comment' => '备注说明',])
			->addColumn('create_time', 'datetime', ['null' => false,'default' => 'CURRENT_TIMESTAMP','signed' => true,'comment' => '创建时间',])
			->addColumn('update_time', 'datetime', ['null' => true,'signed' => true,'comment' => '更新时间',])
            ->create();
    }
}
