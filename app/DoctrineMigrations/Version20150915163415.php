<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150915163415 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        //$this->addSql('ALTER TABLE cross_tbl_catalogue_category_x_tbl_catalogue_category ADD CONSTRAINT FK_9C339AF943B391C FOREIGN KEY (id_item) REFERENCES tbl_catalogue_category (id_tbl_catalogue_category)');
        //$this->addSql('ALTER TABLE cross_tbl_catalogue_category_x_tbl_catalogue_category ADD CONSTRAINT FK_9C339AF1BB9D5A2 FOREIGN KEY (id_parent) REFERENCES tbl_catalogue_category (id_tbl_catalogue_category)');
        //$this->addSql('ALTER TABLE cross_tbl_catalogue_feature_x_tbl_catalogue_featurevalue ADD CONSTRAINT FK_466C262A943B391C FOREIGN KEY (id_item) REFERENCES tbl_catalogue_featurevalue (id)');
        //$this->addSql('ALTER TABLE cross_tbl_catalogue_feature_x_tbl_catalogue_featurevalue ADD CONSTRAINT FK_466C262A1BB9D5A2 FOREIGN KEY (id_parent) REFERENCES tbl_catalogue_feature (id)');
        $this->addSql('ALTER TABLE tbl_catalogue_product ADD classe_energetica VARCHAR(255) DEFAULT NULL, ADD prezzo VARCHAR(255) DEFAULT NULL, ADD planimetria VARCHAR(255) DEFAULT NULL');
        //$this->addSql('ALTER TABLE cross_tbl_catalogue_category_x_tbl_catalogue_product ADD CONSTRAINT FK_5C935EE4943B391C FOREIGN KEY (id_item) REFERENCES tbl_catalogue_product (id)');
        //$this->addSql('ALTER TABLE cross_tbl_catalogue_category_x_tbl_catalogue_product ADD CONSTRAINT FK_5C935EE41BB9D5A2 FOREIGN KEY (id_parent) REFERENCES tbl_catalogue_category (id)');
        //$this->addSql('ALTER TABLE cross_tbl_catalogue_product_x_tbl_catalogue_featurevalue ADD CONSTRAINT FK_73EE4A461BB9D5A2 FOREIGN KEY (id_parent) REFERENCES tbl_catalogue_product (id)');
        //$this->addSql('ALTER TABLE cross_tbl_catalogue_product_x_tbl_catalogue_featurevalue ADD CONSTRAINT FK_73EE4A46943B391C FOREIGN KEY (id_item) REFERENCES tbl_catalogue_featurevalue (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cross_tbl_catalogue_category_x_tbl_catalogue_category DROP FOREIGN KEY FK_9C339AF943B391C');
        $this->addSql('ALTER TABLE cross_tbl_catalogue_category_x_tbl_catalogue_category DROP FOREIGN KEY FK_9C339AF1BB9D5A2');
        $this->addSql('ALTER TABLE cross_tbl_catalogue_category_x_tbl_catalogue_product DROP FOREIGN KEY FK_5C935EE4943B391C');
        $this->addSql('ALTER TABLE cross_tbl_catalogue_category_x_tbl_catalogue_product DROP FOREIGN KEY FK_5C935EE41BB9D5A2');
        $this->addSql('ALTER TABLE cross_tbl_catalogue_feature_x_tbl_catalogue_featurevalue DROP FOREIGN KEY FK_466C262A943B391C');
        $this->addSql('ALTER TABLE cross_tbl_catalogue_feature_x_tbl_catalogue_featurevalue DROP FOREIGN KEY FK_466C262A1BB9D5A2');
        $this->addSql('ALTER TABLE cross_tbl_catalogue_product_x_tbl_catalogue_featurevalue DROP FOREIGN KEY FK_73EE4A461BB9D5A2');
        $this->addSql('ALTER TABLE cross_tbl_catalogue_product_x_tbl_catalogue_featurevalue DROP FOREIGN KEY FK_73EE4A46943B391C');
        $this->addSql('ALTER TABLE tbl_catalogue_product DROP classe_energetica, DROP prezzo, DROP planimetria');
    }
}
