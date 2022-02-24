<?php

use think\migration\Migrator;
use think\migration\db\Column;
use Phinx\Db\Adapter\MysqlAdapter;

class SystemConfig extends Migrator
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
        $table = $this->table('system_config', ['engine' => 'InnoDB', 'collation' => 'utf8mb4_unicode_ci', 'comment' => '系统-配置' ,'id' => 'id' ,'primary_key' => ['id']]);
        $table->addColumn('name', 'string', ['limit' => 100,'null' => false,'default' => '','signed' => true,'comment' => '配置字段',])
			->addColumn('value', 'text', ['limit' => MysqlAdapter::TEXT_MEDIUM,'null' => true,'signed' => true,'comment' => '配置值',])
			->addColumn('mark', 'string', ['limit' => 255,'null' => false,'default' => '','signed' => true,'comment' => '标记',])
            ->create();
    }
}
