<?php

use think\migration\Migrator;
use think\migration\db\Column;
use Phinx\Db\Adapter\MysqlAdapter;

class User extends Migrator
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
        $table = $this->table('user', ['engine' => 'InnoDB', 'collation' => 'utf8_general_ci', 'comment' => 'User 用户表' ,'id' => 'id','signed' => true ,'primary_key' => ['id']]);
        $table->addColumn('name', 'string', ['limit' => 64,'null' => false,'default' => '','signed' => true,'comment' => '昵称',])
			->addColumn('password', 'string', ['limit' => 64,'null' => false,'default' => '','signed' => true,'comment' => '密码',])
			->addColumn('email', 'string', ['limit' => 255,'null' => false,'default' => null,'signed' => true,'comment' => '邮箱',])
			->addColumn('tel', 'string', ['limit' => 32,'null' => true,'signed' => true,'comment' => '手机',])
			->addColumn('job', 'string', ['limit' => 255,'null' => true,'signed' => true,'comment' => '职业',])
			->addColumn('config', 'json', ['null' => true,'signed' => true,'comment' => '配置',])
			->addColumn('keys', 'json', ['null' => true,'signed' => true,'comment' => '开发者key',])
			->addColumn('create_time', 'datetime', ['null' => true,'signed' => true,'comment' => '',])
			->addColumn('update_time', 'datetime', ['null' => true,'signed' => true,'comment' => '',])
			->addColumn('last_usage_day', 'datetime', ['null' => true,'signed' => true,'comment' => '最后使用时间',])
            ->create();
    }
}
