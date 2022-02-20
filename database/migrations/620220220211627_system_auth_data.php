<?php

use think\migration\Migrator;
use think\migration\db\Column;
use Phinx\Db\Adapter\MysqlAdapter;

class SystemAuthData extends Migrator
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
        $table = $this->table('system_auth_data', ['engine' => 'InnoDB', 'collation' => 'utf8mb4_unicode_ci', 'comment' => '系统-数据-权限' ,'id' => 'id' ,'primary_key' => ['id']]);
        $table->addColumn('auth_type', 'boolean', ['null' => false,'default' => 1,'signed' => true,'comment' => '权限类型：1组织(system_auth)，2个人(system_user)',])
			->addColumn('auth_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => false,'default' => 0,'signed' => true,'comment' => '权限用户：组织/个人 id',])
			->addColumn('data_type', 'boolean', ['null' => false,'default' => 1,'signed' => true,'comment' => '数据范围类型：1组织(system_auth)，2个人(system_user)',])
			->addColumn('data_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => false,'default' => 1,'signed' => true,'comment' => '数据范围：组织/个人 id',])
			->addColumn('create_time', 'datetime', ['null' => false,'default' => 'CURRENT_TIMESTAMP','signed' => true,'comment' => '创建时间',])
			->addColumn('update_time', 'datetime', ['null' => true,'signed' => true,'comment' => '更新时间',])
            ->create();
    }
}
