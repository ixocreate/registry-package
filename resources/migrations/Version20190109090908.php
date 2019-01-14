<?php declare(strict_types=1);

namespace IxocreateMigration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Type;
use Doctrine\Migrations\AbstractMigration;
use Ixocreate\CommonTypes\Entity\UuidType;

final class Version20190109090908 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $table = $schema->createTable('registry_registry');

        $table->addColumn('id', Type::STRING);
        $table->addColumn('value', Type::TEXT);
        $table->setPrimaryKey(['id']);
    }

    public function down(Schema $schema) : void
    {
        $schema->dropTable('registry_registry');
    }
}
