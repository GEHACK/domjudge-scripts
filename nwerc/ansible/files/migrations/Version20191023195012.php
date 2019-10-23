<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191023195012 extends AbstractMigration implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function getDescription() : string
    {
        return 'NWERC: update executables';
    }

    public function up(Schema $schema) : void
    {
        // Load executable contents
        $dir = sprintf(
            '%s/files/nwerc/',
            $this->container->getParameter('domjudge.sqldir')
        );

        foreach (glob($dir . '*.zip') as $zipFile) {
            $id     = pathinfo($zipFile)['filename'];
            $params = [
                ':execid' => $id,
                ':md5sum' => md5_file($zipFile),
            ];
            // We use sprintf and insert the zip contents directly because otherwise
            // it would be printed on stdout and that will break terminals
            $content = strtoupper(bin2hex(file_get_contents($zipFile)));
            $this->addSql(
                sprintf(
                    'UPDATE executable SET zipfile = 0x%s, md5sum = :md5sum WHERE execid = :execid',
                    $content
                ),
                $params
            );
        }
    }

    public function down(Schema $schema) : void
    {
        $this->abortIf(
            true,
            'Downgrading to non-NWERC schema not supported'
        );
    }
}
