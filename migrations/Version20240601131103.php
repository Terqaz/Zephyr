<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240601131103 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE airline_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE flight_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE place_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE search_history_item_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE seen_item_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_favorite_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE airline (id INT NOT NULL, name VARCHAR(80) NOT NULL, abbreviation VARCHAR(16) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE flight (id INT NOT NULL, airline_id INT NOT NULL, from_place_id INT NOT NULL, to_place_id INT NOT NULL, price DOUBLE PRECISION NOT NULL, start_time TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, end_time TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, transfers_count INT DEFAULT 0 NOT NULL, views_count BIGINT DEFAULT 0 NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C257E60E130D0C16 ON flight (airline_id)');
        $this->addSql('CREATE INDEX IDX_C257E60E4B494283 ON flight (from_place_id)');
        $this->addSql('CREATE INDEX IDX_C257E60EC0FF3CB7 ON flight (to_place_id)');
        $this->addSql('CREATE TABLE place (id INT NOT NULL, type VARCHAR(32) NOT NULL, name VARCHAR(255) NOT NULL, image_url VARCHAR(255) DEFAULT NULL, users_assessment INT DEFAULT 0 NOT NULL, views_count BIGINT DEFAULT 0 NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE search_history_item (id INT NOT NULL, user_data_id INT NOT NULL, flight_id INT DEFAULT NULL, query VARCHAR(1024) NOT NULL, search_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3E282BC6FF8BF36 ON search_history_item (user_data_id)');
        $this->addSql('CREATE INDEX IDX_3E282BC91F478C5 ON search_history_item (flight_id)');
        $this->addSql('CREATE TABLE seen_item (id INT NOT NULL, user_data_id INT NOT NULL, flight_id INT DEFAULT NULL, place_id INT DEFAULT NULL, seen_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D840EA116FF8BF36 ON seen_item (user_data_id)');
        $this->addSql('CREATE INDEX IDX_D840EA1191F478C5 ON seen_item (flight_id)');
        $this->addSql('CREATE INDEX IDX_D840EA11DA6A219 ON seen_item (place_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, name VARCHAR(128) NOT NULL, description VARCHAR(255) DEFAULT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON "user" (email)');
        $this->addSql('CREATE TABLE user_favorite (id INT NOT NULL, user_data_id INT NOT NULL, flight_id INT DEFAULT NULL, place_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_88486AD96FF8BF36 ON user_favorite (user_data_id)');
        $this->addSql('CREATE INDEX IDX_88486AD991F478C5 ON user_favorite (flight_id)');
        $this->addSql('CREATE INDEX IDX_88486AD9DA6A219 ON user_favorite (place_id)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60E130D0C16 FOREIGN KEY (airline_id) REFERENCES airline (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60E4B494283 FOREIGN KEY (from_place_id) REFERENCES place (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60EC0FF3CB7 FOREIGN KEY (to_place_id) REFERENCES place (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE search_history_item ADD CONSTRAINT FK_3E282BC6FF8BF36 FOREIGN KEY (user_data_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE search_history_item ADD CONSTRAINT FK_3E282BC91F478C5 FOREIGN KEY (flight_id) REFERENCES flight (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE seen_item ADD CONSTRAINT FK_D840EA116FF8BF36 FOREIGN KEY (user_data_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE seen_item ADD CONSTRAINT FK_D840EA1191F478C5 FOREIGN KEY (flight_id) REFERENCES flight (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE seen_item ADD CONSTRAINT FK_D840EA11DA6A219 FOREIGN KEY (place_id) REFERENCES place (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_favorite ADD CONSTRAINT FK_88486AD96FF8BF36 FOREIGN KEY (user_data_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_favorite ADD CONSTRAINT FK_88486AD991F478C5 FOREIGN KEY (flight_id) REFERENCES flight (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_favorite ADD CONSTRAINT FK_88486AD9DA6A219 FOREIGN KEY (place_id) REFERENCES place (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE airline_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE flight_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE place_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE search_history_item_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE seen_item_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE user_favorite_id_seq CASCADE');
        $this->addSql('ALTER TABLE flight DROP CONSTRAINT FK_C257E60E130D0C16');
        $this->addSql('ALTER TABLE flight DROP CONSTRAINT FK_C257E60E4B494283');
        $this->addSql('ALTER TABLE flight DROP CONSTRAINT FK_C257E60EC0FF3CB7');
        $this->addSql('ALTER TABLE search_history_item DROP CONSTRAINT FK_3E282BC6FF8BF36');
        $this->addSql('ALTER TABLE search_history_item DROP CONSTRAINT FK_3E282BC91F478C5');
        $this->addSql('ALTER TABLE seen_item DROP CONSTRAINT FK_D840EA116FF8BF36');
        $this->addSql('ALTER TABLE seen_item DROP CONSTRAINT FK_D840EA1191F478C5');
        $this->addSql('ALTER TABLE seen_item DROP CONSTRAINT FK_D840EA11DA6A219');
        $this->addSql('ALTER TABLE user_favorite DROP CONSTRAINT FK_88486AD96FF8BF36');
        $this->addSql('ALTER TABLE user_favorite DROP CONSTRAINT FK_88486AD991F478C5');
        $this->addSql('ALTER TABLE user_favorite DROP CONSTRAINT FK_88486AD9DA6A219');
        $this->addSql('DROP TABLE airline');
        $this->addSql('DROP TABLE flight');
        $this->addSql('DROP TABLE place');
        $this->addSql('DROP TABLE search_history_item');
        $this->addSql('DROP TABLE seen_item');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE user_favorite');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
