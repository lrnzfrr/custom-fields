<?php
use Migrations\AbstractMigration;

class CreateCustomFields extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('custom_fields');

        $table->addColumn('fk_id', 'integer', [
            'default' => 0,
            'length' => 11,
            'null' => false,
            'signed' => false,
        ]);

        $table->addColumn('fk_table', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);

        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);

        $table->addColumn('value', 'text', [
            'default' => null,
            'null' => false,
        ]);        

        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->create();
    }
}