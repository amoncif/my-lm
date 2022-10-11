<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221006074957 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE customer_order (customer_number VARCHAR(20) NOT NULL, order_number VARCHAR(20) NOT NULL, order_date DATE NOT NULL, amount NUMERIC(7, 2) NOT NULL, currency_code VARCHAR(3) NOT NULL, INDEX customer_number (customer_number), INDEX order_number (order_number), PRIMARY KEY(customer_number, order_number)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment (id INT AUTO_INCREMENT NOT NULL, order_number VARCHAR(20) DEFAULT NULL, customer_number VARCHAR(20) DEFAULT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, agreed_to_terms TINYINT(1) NOT NULL, payment_type VARCHAR(255) NOT NULL, INDEX IDX_6D28840D551F0F812755C305 (order_number, customer_number), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment_status (id INT AUTO_INCREMENT NOT NULL, payment_id INT DEFAULT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_5E38FE8A4C3A3BB (payment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D551F0F812755C305 FOREIGN KEY (order_number, customer_number) REFERENCES customer_order (order_number, customer_number)');
        $this->addSql('ALTER TABLE payment_status ADD CONSTRAINT FK_5E38FE8A4C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840D551F0F812755C305');
        $this->addSql('ALTER TABLE payment_status DROP FOREIGN KEY FK_5E38FE8A4C3A3BB');
        $this->addSql('DROP TABLE customer_order');
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE payment_status');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
