<?php

use think\migration\Migrator;
use think\migration\db\Column;
use Phinx\Db\Adapter\MysqlAdapter;

class SystemUser extends Migrator
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
        $table = $this->table('system_user', ['engine' => 'InnoDB', 'collation' => 'utf8mb4_unicode_ci', 'comment' => '系统-用户表' ,'id' => 'id' ,'primary_key' => ['id']]);
        $table->addColumn('username', 'string', ['limit' => 50,'null' => false,'default' => '','signed' => true,'comment' => '用户账号',])
			->addColumn('nickname', 'string', ['limit' => 50,'null' => false,'default' => '','signed' => true,'comment' => '用户昵称',])
			->addColumn('avatar', 'string', ['limit' => 255,'null' => false,'default' => '','signed' => true,'comment' => '头像',])
			->addColumn('password', 'string', ['limit' => 255,'null' => false,'default' => '','signed' => true,'comment' => '用户密码',])
			->addColumn('mail', 'string', ['limit' => 32,'null' => false,'default' => '','signed' => true,'comment' => '联系邮箱',])
			->addColumn('phone', 'char', ['limit' => 11,'null' => false,'default' => '','signed' => true,'comment' => '联系手机',])
			->addColumn('login_at', 'datetime', ['null' => true,'signed' => true,'comment' => '登录时间',])
			->addColumn('login_ip', 'string', ['limit' => 15,'null' => false,'default' => '','signed' => true,'comment' => '登录IP',])
			->addColumn('login_num', 'integer', ['limit' => MysqlAdapter::INT_BIG,'null' => false,'default' => 0,'signed' => true,'comment' => '登录次数',])
			->addColumn('desc', 'string', ['limit' => 255,'null' => false,'default' => '','signed' => true,'comment' => '备注说明',])
			->addColumn('sort', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => false,'default' => 0,'signed' => true,'comment' => '排序',])
			->addColumn('status', 'boolean', ['null' => false,'default' => 1,'signed' => true,'comment' => '状态(0:禁用,1:启用)',])
			->addColumn('create_time', 'datetime', ['null' => false,'default' => 'CURRENT_TIMESTAMP','signed' => true,'comment' => '创建时间',])
			->addColumn('update_time', 'datetime', ['null' => true,'signed' => true,'comment' => '更新时间',])
			->addColumn('delete_time', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => false,'default' => 0,'signed' => true,'comment' => '删除时间',])
            ->create();
    }
}
