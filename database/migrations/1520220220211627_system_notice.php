<?php

use think\migration\Migrator;
use think\migration\db\Column;
use Phinx\Db\Adapter\MysqlAdapter;

class SystemNotice extends Migrator
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
        $table = $this->table('system_notice', ['engine' => 'InnoDB', 'collation' => 'utf8mb4_unicode_ci', 'comment' => '系统通知' ,'id' => 'id' ,'primary_key' => ['id']]);
        $table->addColumn('user_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => false,'default' => null,'signed' => true,'comment' => '系统用户id',])
			->addColumn('color', 'string', ['limit' => 255,'null' => false,'default' => '','signed' => true,'comment' => '图标和标题标签颜色',])
			->addColumn('avatar', 'string', ['limit' => 255,'null' => false,'default' => null,'signed' => true,'comment' => '头像或图标',])
			->addColumn('type', 'boolean', ['null' => false,'default' => 1,'signed' => true,'comment' => '1图标,2头像',])
			->addColumn('title', 'string', ['limit' => 20,'null' => false,'default' => null,'signed' => true,'comment' => '标题',])
			->addColumn('content', 'string', ['limit' => 255,'null' => false,'default' => null,'signed' => true,'comment' => '内容',])
			->addColumn('target_url', 'string', ['limit' => 255,'null' => false,'default' => '','signed' => true,'comment' => '跳转链接',])
			->addColumn('is_read', 'boolean', ['null' => false,'default' => 0,'signed' => true,'comment' => '1:已读,0未读',])
			->addColumn('create_time', 'datetime', ['null' => false,'default' => 'CURRENT_TIMESTAMP','signed' => true,'comment' => '创建时间',])
			->addColumn('update_time', 'datetime', ['null' => true,'signed' => true,'comment' => '更新时间',])
            ->create();
    }
}
