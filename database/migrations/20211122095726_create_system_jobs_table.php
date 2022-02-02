<?php

use think\migration\db\Column;
use think\migration\Migrator;

class CreateSystemJobsTable extends Migrator
{
    public function change()
    {
        $this->table('system_jobs')
            ->addColumn(Column::string('queue'))
            ->addColumn(Column::longText('payload'))
            ->addColumn(Column::tinyInteger('attempts')->setUnsigned())
            ->addColumn(Column::unsignedInteger('reserve_time')->setNullable())
            ->addColumn(Column::unsignedInteger('available_time'))
            ->addColumn(Column::unsignedInteger('create_time'))
            ->addIndex('queue')
            ->create();
    }
}
