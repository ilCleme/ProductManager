<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150708105104 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE elfinder_file (id INT AUTO_INCREMENT NOT NULL, parent_id INT NOT NULL, name VARCHAR(255) NOT NULL, content LONGBLOB NOT NULL, size INT NOT NULL, mtime INT NOT NULL, mime VARCHAR(255) NOT NULL, `read` VARCHAR(255) NOT NULL, `write` VARCHAR(255) NOT NULL, locked VARCHAR(255) NOT NULL, hidden VARCHAR(255) NOT NULL, width INT NOT NULL, height INT NOT NULL, INDEX parent_id (parent_id), UNIQUE INDEX parent_name (parent_id, name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbl_catalogue_category (id BIGINT AUTO_INCREMENT NOT NULL, id_tbl_catalogue_category BIGINT NOT NULL, id_tbl_lingua BIGINT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, img VARCHAR(255) DEFAULT NULL, position INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cross_tbl_catalogue_category_x_tbl_catalogue_category (id_item BIGINT NOT NULL, id_parent BIGINT NOT NULL, INDEX IDX_9C339AF943B391C (id_item), INDEX IDX_9C339AF1BB9D5A2 (id_parent), PRIMARY KEY(id_item, id_parent)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbl_catalogue_category_metatag (id INT AUTO_INCREMENT NOT NULL, id_tbl_catalogue_category BIGINT DEFAULT NULL, id_tbl_lingua INT DEFAULT NULL, meta_tag_title VARCHAR(100) DEFAULT NULL, meta_tag_charset VARCHAR(30) DEFAULT NULL, meta_tag_generator VARCHAR(100) DEFAULT NULL, meta_tag_author VARCHAR(100) DEFAULT NULL, meta_tag_description VARCHAR(255) DEFAULT NULL, meta_tag_keywords VARCHAR(255) DEFAULT NULL, UNIQUE INDEX id_tbl_cataloguefip_category (id_tbl_catalogue_category, id_tbl_lingua), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbl_catalogue_feature (id BIGINT AUTO_INCREMENT NOT NULL, id_tbl_catalogue_feature BIGINT NOT NULL, id_tbl_lingua TINYINT(1) NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, type_input VARCHAR(255) NOT NULL, compulsory TINYINT(1) NOT NULL, display VARCHAR(255) NOT NULL, position INT NOT NULL, inherit_from INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbl_catalogue_featurevalue (id BIGINT AUTO_INCREMENT NOT NULL, id_tbl_catalogue_featurevalue BIGINT NOT NULL, id_tbl_lingua TINYINT(1) NOT NULL, title VARCHAR(255) NOT NULL, img VARCHAR(255) DEFAULT NULL, position INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cross_tbl_catalogue_feature_x_tbl_catalogue_featurevalue (id_item BIGINT NOT NULL, id_parent BIGINT NOT NULL, INDEX IDX_466C262A943B391C (id_item), INDEX IDX_466C262A1BB9D5A2 (id_parent), PRIMARY KEY(id_item, id_parent)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbl_catalogue_fieldsearch (id BIGINT AUTO_INCREMENT NOT NULL, id_tbl_catalogue_fieldsearch BIGINT NOT NULL, id_tbl_lingua TINYINT(1) NOT NULL, id_tbl_catalogue_category VARCHAR(255) DEFAULT NULL, getname VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, typeinput VARCHAR(255) NOT NULL, compulsory TINYINT(1) NOT NULL, showOnlyValued TINYINT(1) NOT NULL, typesearch VARCHAR(255) NOT NULL, tablerif VARCHAR(255) NOT NULL, elementrif VARCHAR(255) NOT NULL, findin VARCHAR(255) NOT NULL, conditionBetweenField VARCHAR(255) NOT NULL, position INT NOT NULL, INDEX getname (getname), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbl_catalogue_import_log (id BIGINT AUTO_INCREMENT NOT NULL, tablerif VARCHAR(255) DEFAULT NULL, idrif BIGINT DEFAULT NULL, act VARCHAR(255) DEFAULT NULL, result TINYINT(1) NOT NULL, description LONGTEXT DEFAULT NULL, date_import DATETIME NOT NULL, id_user BIGINT NOT NULL, ip_user VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbl_catalogue_product (id BIGINT AUTO_INCREMENT NOT NULL, id_tbl_catalogue_product BIGINT NOT NULL, id_tbl_lingua TINYINT(1) NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, description_notag LONGTEXT DEFAULT NULL, short_description VARCHAR(255) DEFAULT NULL, cod VARCHAR(255) DEFAULT NULL, id_tbl_photo_cat INT NOT NULL, template VARCHAR(255) DEFAULT NULL, pub TINYINT(1) NOT NULL, featured TINYINT(1) NOT NULL, position INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cross_tbl_catalogue_category_x_tbl_catalogue_product (id_item BIGINT NOT NULL, id_parent BIGINT NOT NULL, INDEX IDX_5C935EE4943B391C (id_item), INDEX IDX_5C935EE41BB9D5A2 (id_parent), PRIMARY KEY(id_item, id_parent)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cross_tbl_catalogue_product_x_tbl_catalogue_featurevalue (id_item BIGINT NOT NULL, id_parent BIGINT NOT NULL, INDEX IDX_73EE4A46943B391C (id_item), INDEX IDX_73EE4A461BB9D5A2 (id_parent), PRIMARY KEY(id_item, id_parent)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbl_catalogue_product_metatag (id INT AUTO_INCREMENT NOT NULL, id_tbl_catalogue_product BIGINT NOT NULL, id_tbl_lingua INT DEFAULT NULL, meta_tag_title VARCHAR(100) DEFAULT NULL, meta_tag_charset VARCHAR(30) DEFAULT NULL, meta_tag_generator VARCHAR(100) DEFAULT NULL, meta_tag_author VARCHAR(100) DEFAULT NULL, meta_tag_description VARCHAR(255) DEFAULT NULL, meta_tag_keywords VARCHAR(255) DEFAULT NULL, UNIQUE INDEX id_tbl_cataloguefip_product (id_tbl_catalogue_product, id_tbl_lingua), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbl_photo (id BIGINT AUTO_INCREMENT NOT NULL, id_tbl_photo BIGINT NOT NULL, id_tbl_lingua BIGINT NOT NULL, nome VARCHAR(255) NOT NULL, img VARCHAR(255) NOT NULL, img_big VARCHAR(255) NOT NULL, thumbnail_x BIGINT NOT NULL, thumbnail_y BIGINT NOT NULL, id_tbl_photo_cat BIGINT NOT NULL, posizione BIGINT NOT NULL, pub BIGINT NOT NULL, didascalia VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbl_photo_cat (id BIGINT AUTO_INCREMENT NOT NULL, id_padre BIGINT NOT NULL, id_tbl_photo_cat BIGINT NOT NULL, id_tbl_lingua BIGINT NOT NULL, nome VARCHAR(255) NOT NULL, num INT NOT NULL, smarty_template VARCHAR(255) NOT NULL, posizione INT NOT NULL, set_loop TINYINT(1) DEFAULT NULL, set_random TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbl_user (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(25) NOT NULL, cognome VARCHAR(25) NOT NULL, login VARCHAR(25) NOT NULL, password VARCHAR(64) NOT NULL, email VARCHAR(60) NOT NULL, checkbox_tbl_gruppi VARCHAR(200) NOT NULL, checkbox1_tbl_gruppi VARCHAR(200) NOT NULL, UNIQUE INDEX UNIQ_38B383A154BD530C (nome), UNIQUE INDEX UNIQ_38B383A1807B13C4 (cognome), UNIQUE INDEX UNIQ_38B383A1AA08CB10 (login), UNIQUE INDEX UNIQ_38B383A1E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE acme_users (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(25) NOT NULL, password VARCHAR(64) NOT NULL, email VARCHAR(60) NOT NULL, is_active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_55884A7F85E0677 (username), UNIQUE INDEX UNIQ_55884A7E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        /*
        $this->addSql('ALTER TABLE cross_tbl_catalogue_category_x_tbl_catalogue_category ADD CONSTRAINT FK_9C339AF943B391C FOREIGN KEY (id_item) REFERENCES tbl_catalogue_category (id_tbl_catalogue_category)');
        $this->addSql('ALTER TABLE cross_tbl_catalogue_category_x_tbl_catalogue_category ADD CONSTRAINT FK_9C339AF1BB9D5A2 FOREIGN KEY (id_parent) REFERENCES tbl_catalogue_category (id_tbl_catalogue_category)');
        $this->addSql('ALTER TABLE cross_tbl_catalogue_feature_x_tbl_catalogue_featurevalue ADD CONSTRAINT FK_466C262A943B391C FOREIGN KEY (id_item) REFERENCES tbl_catalogue_featurevalue (id)');
        $this->addSql('ALTER TABLE cross_tbl_catalogue_feature_x_tbl_catalogue_featurevalue ADD CONSTRAINT FK_466C262A1BB9D5A2 FOREIGN KEY (id_parent) REFERENCES tbl_catalogue_feature (id)');
        $this->addSql('ALTER TABLE cross_tbl_catalogue_category_x_tbl_catalogue_product ADD CONSTRAINT FK_5C935EE4943B391C FOREIGN KEY (id_item) REFERENCES tbl_catalogue_product (id)');
        $this->addSql('ALTER TABLE cross_tbl_catalogue_category_x_tbl_catalogue_product ADD CONSTRAINT FK_5C935EE41BB9D5A2 FOREIGN KEY (id_parent) REFERENCES tbl_catalogue_category (id)');
        $this->addSql('ALTER TABLE cross_tbl_catalogue_product_x_tbl_catalogue_featurevalue ADD CONSTRAINT FK_73EE4A46943B391C FOREIGN KEY (id_item) REFERENCES tbl_catalogue_product (id)');
        $this->addSql('ALTER TABLE cross_tbl_catalogue_product_x_tbl_catalogue_featurevalue ADD CONSTRAINT FK_73EE4A461BB9D5A2 FOREIGN KEY (id_parent) REFERENCES tbl_catalogue_featurevalue (id)');
        */
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
        $this->addSql('ALTER TABLE cross_tbl_catalogue_category_x_tbl_catalogue_product DROP FOREIGN KEY FK_5C935EE41BB9D5A2');
        $this->addSql('ALTER TABLE cross_tbl_catalogue_feature_x_tbl_catalogue_featurevalue DROP FOREIGN KEY FK_466C262A1BB9D5A2');
        $this->addSql('ALTER TABLE cross_tbl_catalogue_feature_x_tbl_catalogue_featurevalue DROP FOREIGN KEY FK_466C262A943B391C');
        $this->addSql('ALTER TABLE cross_tbl_catalogue_product_x_tbl_catalogue_featurevalue DROP FOREIGN KEY FK_73EE4A461BB9D5A2');
        $this->addSql('ALTER TABLE cross_tbl_catalogue_category_x_tbl_catalogue_product DROP FOREIGN KEY FK_5C935EE4943B391C');
        $this->addSql('ALTER TABLE cross_tbl_catalogue_product_x_tbl_catalogue_featurevalue DROP FOREIGN KEY FK_73EE4A46943B391C');
        $this->addSql('DROP TABLE elfinder_file');
        $this->addSql('DROP TABLE tbl_catalogue_category');
        $this->addSql('DROP TABLE cross_tbl_catalogue_category_x_tbl_catalogue_category');
        $this->addSql('DROP TABLE tbl_catalogue_category_metatag');
        $this->addSql('DROP TABLE tbl_catalogue_feature');
        $this->addSql('DROP TABLE tbl_catalogue_featurevalue');
        $this->addSql('DROP TABLE cross_tbl_catalogue_feature_x_tbl_catalogue_featurevalue');
        $this->addSql('DROP TABLE tbl_catalogue_fieldsearch');
        $this->addSql('DROP TABLE tbl_catalogue_import_log');
        $this->addSql('DROP TABLE tbl_catalogue_product');
        $this->addSql('DROP TABLE cross_tbl_catalogue_category_x_tbl_catalogue_product');
        $this->addSql('DROP TABLE cross_tbl_catalogue_product_x_tbl_catalogue_featurevalue');
        $this->addSql('DROP TABLE tbl_catalogue_product_metatag');
        $this->addSql('DROP TABLE tbl_photo');
        $this->addSql('DROP TABLE tbl_photo_cat');
        $this->addSql('DROP TABLE tbl_user');
        $this->addSql('DROP TABLE acme_users');
    }
}
