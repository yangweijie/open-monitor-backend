<?php

use think\migration\Migrator;
use think\migration\db\Column;
use Phinx\Db\Adapter\MysqlAdapter;

class SystemFile extends Migrator
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
        $table = $this->table('system_file', ['engine' => 'InnoDB', 'collation' => 'utf8mb4_unicode_ci', 'comment' => '上传文件' ,'id' => 'id' ,'primary_key' => ['id']]);
        $table->addColumn('name', 'string', ['limit' => 100,'null' => false,'default' => '','signed' => true,'comment' => '文件名称',])
			->addColumn('real_name', 'string', ['limit' => 100,'null' => false,'default' => '','signed' => true,'comment' => '原始文件名',])
			->addColumn('cate_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => false,'default' => 0,'signed' => true,'comment' => '分类id',])
			->addColumn('url', 'string', ['limit' => 255,'null' => false,'default' => '','signed' => true,'comment' => '访问url',])
			->addColumn('path', 'string', ['limit' => 255,'null' => false,'default' => '','signed' => true,'comment' => '路径',])
			->addColumn('file_type', 'string', ['limit' => 20,'null' => false,'default' => '','signed' => true,'comment' => '文件类型',])
			->addColumn('ext', 'string', ['limit' => 10,'null' => false,'default' => null,'signed' => true,'comment' => '文件后缀',])
			->addColumn('file_size', 'integer', ['limit' => MysqlAdapter::INT_BIG,'null' => false,'default' => null,'signed' => true,'comment' => '文件大小',])
			->addColumn('admin_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR,'null' => true,'signed' => true,'comment' => '后台上传人员',])
			->addColumn('uptype', 'string', ['limit' => 20,'null' => false,'default' => 'local','signed' => true,'comment' => '上传类型',])
			->addColumn('is_delete', 'boolean', ['null' => false,'default' => 0,'signed' => true,'comment' => '1已删除，0正常',])
			->addColumn('create_time', 'timestamp', ['null' => false,'default' => 'CURRENT_TIMESTAMP','signed' => true,'comment' => '',])
			->addColumn('update_time', 'timestamp', ['null' => true,'signed' => true,'comment' => '',])
			->addIndex(['file_type','ext'], ['name' => 'file_type'])
            ->create();
    }
}
