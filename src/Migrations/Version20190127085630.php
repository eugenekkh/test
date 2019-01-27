<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190127085630 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE ip_check (id CHAR(36) NOT NULL --(DC2Type:uuid)
        , ip VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE ip_check_result (id CHAR(36) NOT NULL --(DC2Type:uuid)
        , ipcheck_id CHAR(36) DEFAULT NULL --(DC2Type:uuid)
        , checked_at DATETIME NOT NULL, geo_data_time_zone VARCHAR(255) NOT NULL, geo_data_country_country_code VARCHAR(255) NOT NULL, geo_data_country_country VARCHAR(255) NOT NULL, geo_data_country_country_rus VARCHAR(255) NOT NULL, geo_data_region_region VARCHAR(255) NOT NULL, geo_data_region_region_rus VARCHAR(255) NOT NULL, geo_data_city_city VARCHAR(255) NOT NULL, geo_data_city_city_rus VARCHAR(255) NOT NULL, geo_data_city_zip_code INTEGER NOT NULL, geo_data_coordinates_latitude DOUBLE PRECISION NOT NULL, geo_data_coordinates_longitude DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3A45FEB92B6ADE97 ON ip_check_result (ipcheck_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE ip_check');
        $this->addSql('DROP TABLE ip_check_result');
    }
}
