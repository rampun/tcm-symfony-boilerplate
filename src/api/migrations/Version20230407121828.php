<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use TheCodingMachine\FluidSchema\TdbmFluidSchema;
use RuntimeException;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230407121828 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create a comments table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $db = new TdbmFluidSchema($schema);

        $db->table('comments')
            ->column('id')->guid()->primaryKey()->comment('@UUID')
            ->column('text')->string(255)->notNull();
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        throw new RuntimeException('Never rollback a migration!');
    }
}
