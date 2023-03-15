<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230315144554 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE display_chat (id INT AUTO_INCREMENT NOT NULL, user_sender_id INT NOT NULL, user_recipient_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE party (id INT AUTO_INCREMENT NOT NULL, user_host_id INT NOT NULL, description LONGTEXT NOT NULL, game VARCHAR(255) NOT NULL, player_number_needed INT NOT NULL, player_number_total INT NOT NULL, address_location VARCHAR(255) NOT NULL, address_gps_lat DOUBLE PRECISION NOT NULL, address_gps_long DOUBLE PRECISION NOT NULL, type_location_id INT NOT NULL, date DATE NOT NULL, last_sign_in DATE NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', trait1_id INT NOT NULL, trait2_id INT NOT NULL, trait3_id INT NOT NULL, trait4_id INT NOT NULL, canceled TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE party_user (id INT AUTO_INCREMENT NOT NULL, party_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trait_categories (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, category_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_location (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, gender_id INT NOT NULL, pseudo VARCHAR(255) NOT NULL, birthdate DATE NOT NULL, city VARCHAR(255) NOT NULL, city_gps_lat INT NOT NULL, city_gps_long INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, favorite_game VARCHAR(255) NOT NULL, trait1_id INT NOT NULL, trait2_id INT NOT NULL, trait3_id INT NOT NULL, trait4_id INT NOT NULL, picture_profil VARCHAR(255) NOT NULL, user_level_id INT NOT NULL, rate DOUBLE PRECISION NOT NULL, absence INT NOT NULL, last_connexion DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_black_list (id INT AUTO_INCREMENT NOT NULL, user_that_block_id INT NOT NULL, user_banned_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_chat (id INT AUTO_INCREMENT NOT NULL, user_sender_id INT NOT NULL, user_recipient_id INT NOT NULL, body LONGTEXT NOT NULL, creataed_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', message_read TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_comment (id INT AUTO_INCREMENT NOT NULL, sender_user_id INT NOT NULL, concerned_user_id INT NOT NULL, party_id INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', read_by_concerned_user TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_friend (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, user_friend_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_level (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, picture_profil VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE display_chat');
        $this->addSql('DROP TABLE party');
        $this->addSql('DROP TABLE party_user');
        $this->addSql('DROP TABLE trait_categories');
        $this->addSql('DROP TABLE type_location');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_black_list');
        $this->addSql('DROP TABLE user_chat');
        $this->addSql('DROP TABLE user_comment');
        $this->addSql('DROP TABLE user_friend');
        $this->addSql('DROP TABLE user_level');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
