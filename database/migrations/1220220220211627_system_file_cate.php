<?php

use think\migration\Migrator;
use think\migration\db\Column;
use Phinx\Db\Adapter\MysqlAdapter;

class SystemFileCate extends Migrator
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
        $table = $this->table('system_file_cate', ['engine' => 'InnoDB', 'collation' => 'utf8mb4_unicode_ci', 'comment' => '上传文件分类' ,'id' => 'id' ,'primary_key' => ['id']]);
        $table->addColumn('name', 'string', ['limit' => 100,'null' => false,'default' => '','signed' => true,'comment' => '分类名称',])
			->addColumn('pid', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => false,'default' => 0,'signed' => true,'comment' => '上级id',])
			->addColumn('mark', 'string', ['limit' => 255,'null' => false,'default' => '','signed' => true,'comment' => '标记',])
			->addColumn('per_type', 'boolean', ['null' => false,'default' => 1,'signed' => true,'comment' => '权限类型：0所有人，1仅自己',])
			->addColumn('status', 'boolean', ['null' => false,'default' => 1,'signed' => true,'comment' => '是否显示',])
			->addColumn('admin_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => false,'default' => null,'signed' => true,'comment' => '后台上传人员',])
			->addColumn('sort', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => false,'default' => 0,'signed' => true,'comment' => '排序',])
            ->create();
    }
}
