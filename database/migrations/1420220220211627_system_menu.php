<?php

use think\migration\Migrator;
use think\migration\db\Column;
use Phinx\Db\Adapter\MysqlAdapter;

class SystemMenu extends Migrator
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
        $table = $this->table('system_menu', ['engine' => 'InnoDB', 'collation' => 'utf8mb4_unicode_ci', 'comment' => '系统-菜单表' ,'id' => 'id' ,'primary_key' => ['id']]);
        $table->addColumn('pid', 'integer', ['limit' => MysqlAdapter::INT_BIG,'null' => false,'default' => 0,'signed' => true,'comment' => '父ID',])
			->addColumn('name', 'string', ['limit' => 100,'null' => false,'default' => '','signed' => true,'comment' => '名称',])
			->addColumn('icon', 'string', ['limit' => 100,'null' => false,'default' => '','signed' => true,'comment' => '菜单图标',])
			->addColumn('url', 'string', ['limit' => 400,'null' => false,'default' => '','signed' => true,'comment' => '链接',])
			->addColumn('mark', 'string', ['limit' => 255,'null' => false,'default' => '','signed' => true,'comment' => '标记',])
			->addColumn('sort', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => false,'default' => 0,'signed' => true,'comment' => '菜单排序',])
			->addColumn('status', 'boolean', ['null' => false,'default' => 1,'signed' => true,'comment' => '状态(0:禁用,1:启用)',])
			->addColumn('open', 'boolean', ['null' => false,'default' => 1,'signed' => true,'comment' => '菜单展开(0:禁用,1:启用)',])
			->addColumn('admin_visible', 'boolean', ['null' => false,'default' => 1,'signed' => true,'comment' => '超级管理员状态(0:隐藏,1:显示)',])
			->addColumn('create_time', 'datetime', ['null' => false,'default' => 'CURRENT_TIMESTAMP','signed' => true,'comment' => '创建时间',])
			->addColumn('update_time', 'datetime', ['null' => true,'signed' => true,'comment' => '更新时间',])
            ->create();
    }
}
