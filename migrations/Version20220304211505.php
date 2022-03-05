<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220304211505 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE business_oportunity (id INT AUTO_INCREMENT NOT NULL, request_id INT NOT NULL, offer_id INT DEFAULT NULL, contract_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_DEAEAA7D427EB8A5 (request_id), UNIQUE INDEX UNIQ_DEAEAA7D53C674EE (offer_id), UNIQUE INDEX UNIQ_DEAEAA7D2576E0FD (contract_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contract (id INT AUTO_INCREMENT NOT NULL, currency_id INT NOT NULL, delivery_conditions_id INT NOT NULL, status_id INT NOT NULL, amount INT NOT NULL, INDEX IDX_E98F285938248176 (currency_id), INDEX IDX_E98F2859C2099BEF (delivery_conditions_id), INDEX IDX_E98F28596BF700BD (status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contract_status (id INT AUTO_INCREMENT NOT NULL, status_id INT NOT NULL, date DATETIME NOT NULL, INDEX IDX_474080516BF700BD (status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cstatus (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE currency (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE delivery_conditions (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE material (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offer (id INT AUTO_INCREMENT NOT NULL, currency_id INT NOT NULL, payment_method_id INT NOT NULL, status_id INT NOT NULL, rejected_reason_id INT NOT NULL, amount_fob INT NOT NULL, amount_total INT NOT NULL, INDEX IDX_29D6873E38248176 (currency_id), INDEX IDX_29D6873E5AA1164F (payment_method_id), INDEX IDX_29D6873E6BF700BD (status_id), INDEX IDX_29D6873EBD07D97C (rejected_reason_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offer_status (id INT AUTO_INCREMENT NOT NULL, status_id INT NOT NULL, date DATETIME NOT NULL, INDEX IDX_A25512BD6BF700BD (status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ostatus (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment_method (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rejected_reason (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE request (id INT AUTO_INCREMENT NOT NULL, importer_company_id INT NOT NULL, specialist_id INT NOT NULL, requested_material_id INT NOT NULL, final_client_id INT NOT NULL, unit_id INT NOT NULL, quantity INT NOT NULL, date DATETIME NOT NULL, valid_until DATETIME NOT NULL, INDEX IDX_3B978F9FB15B97FC (importer_company_id), INDEX IDX_3B978F9F7B100C1A (specialist_id), INDEX IDX_3B978F9FF6ACC024 (requested_material_id), INDEX IDX_3B978F9F3F4DB0A3 (final_client_id), INDEX IDX_3B978F9FF8BD700D (unit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specialist (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unit (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE business_oportunity ADD CONSTRAINT FK_DEAEAA7D427EB8A5 FOREIGN KEY (request_id) REFERENCES request (id)');
        $this->addSql('ALTER TABLE business_oportunity ADD CONSTRAINT FK_DEAEAA7D53C674EE FOREIGN KEY (offer_id) REFERENCES offer (id)');
        $this->addSql('ALTER TABLE business_oportunity ADD CONSTRAINT FK_DEAEAA7D2576E0FD FOREIGN KEY (contract_id) REFERENCES contract (id)');
        $this->addSql('ALTER TABLE contract ADD CONSTRAINT FK_E98F285938248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE contract ADD CONSTRAINT FK_E98F2859C2099BEF FOREIGN KEY (delivery_conditions_id) REFERENCES delivery_conditions (id)');
        $this->addSql('ALTER TABLE contract ADD CONSTRAINT FK_E98F28596BF700BD FOREIGN KEY (status_id) REFERENCES contract_status (id)');
        $this->addSql('ALTER TABLE contract_status ADD CONSTRAINT FK_474080516BF700BD FOREIGN KEY (status_id) REFERENCES cstatus (id)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E38248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E5AA1164F FOREIGN KEY (payment_method_id) REFERENCES payment_method (id)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E6BF700BD FOREIGN KEY (status_id) REFERENCES offer_status (id)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873EBD07D97C FOREIGN KEY (rejected_reason_id) REFERENCES rejected_reason (id)');
        $this->addSql('ALTER TABLE offer_status ADD CONSTRAINT FK_A25512BD6BF700BD FOREIGN KEY (status_id) REFERENCES ostatus (id)');
        $this->addSql('ALTER TABLE request ADD CONSTRAINT FK_3B978F9FB15B97FC FOREIGN KEY (importer_company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE request ADD CONSTRAINT FK_3B978F9F7B100C1A FOREIGN KEY (specialist_id) REFERENCES specialist (id)');
        $this->addSql('ALTER TABLE request ADD CONSTRAINT FK_3B978F9FF6ACC024 FOREIGN KEY (requested_material_id) REFERENCES material (id)');
        $this->addSql('ALTER TABLE request ADD CONSTRAINT FK_3B978F9F3F4DB0A3 FOREIGN KEY (final_client_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE request ADD CONSTRAINT FK_3B978F9FF8BD700D FOREIGN KEY (unit_id) REFERENCES unit (id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE request DROP FOREIGN KEY FK_3B978F9FB15B97FC');
        $this->addSql('ALTER TABLE request DROP FOREIGN KEY FK_3B978F9F3F4DB0A3');
        $this->addSql('ALTER TABLE business_oportunity DROP FOREIGN KEY FK_DEAEAA7D2576E0FD');
        $this->addSql('ALTER TABLE contract DROP FOREIGN KEY FK_E98F28596BF700BD');
        $this->addSql('ALTER TABLE contract_status DROP FOREIGN KEY FK_474080516BF700BD');
        $this->addSql('ALTER TABLE contract DROP FOREIGN KEY FK_E98F285938248176');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873E38248176');
        $this->addSql('ALTER TABLE contract DROP FOREIGN KEY FK_E98F2859C2099BEF');
        $this->addSql('ALTER TABLE request DROP FOREIGN KEY FK_3B978F9FF6ACC024');
        $this->addSql('ALTER TABLE business_oportunity DROP FOREIGN KEY FK_DEAEAA7D53C674EE');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873E6BF700BD');
        $this->addSql('ALTER TABLE offer_status DROP FOREIGN KEY FK_A25512BD6BF700BD');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873E5AA1164F');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873EBD07D97C');
        $this->addSql('ALTER TABLE business_oportunity DROP FOREIGN KEY FK_DEAEAA7D427EB8A5');
        $this->addSql('ALTER TABLE request DROP FOREIGN KEY FK_3B978F9F7B100C1A');
        $this->addSql('ALTER TABLE request DROP FOREIGN KEY FK_3B978F9FF8BD700D');
        $this->addSql('DROP TABLE business_oportunity');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE contract');
        $this->addSql('DROP TABLE contract_status');
        $this->addSql('DROP TABLE cstatus');
        $this->addSql('DROP TABLE currency');
        $this->addSql('DROP TABLE delivery_conditions');
        $this->addSql('DROP TABLE material');
        $this->addSql('DROP TABLE offer');
        $this->addSql('DROP TABLE offer_status');
        $this->addSql('DROP TABLE ostatus');
        $this->addSql('DROP TABLE payment_method');
        $this->addSql('DROP TABLE rejected_reason');
        $this->addSql('DROP TABLE request');
        $this->addSql('DROP TABLE specialist');
        $this->addSql('DROP TABLE unit');
        $this->addSql('ALTER TABLE `user` CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`');
    }
}
