<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181128135119 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, user_name VARCHAR(255) NOT NULL, user_register_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, fk_user_id INT NOT NULL, fk_category_id INT NOT NULL, sub_comment_id INT DEFAULT NULL, comment_title VARCHAR(255) NOT NULL, comment_content LONGTEXT NOT NULL, comment_date DATETIME NOT NULL, INDEX IDX_9474526C5741EEB9 (fk_user_id), INDEX IDX_9474526C7BB031D6 (fk_category_id), INDEX IDX_9474526CD4A2EEDE (sub_comment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, category_name VARCHAR(255) NOT NULL, category_image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C5741EEB9 FOREIGN KEY (fk_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C7BB031D6 FOREIGN KEY (fk_category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CD4A2EEDE FOREIGN KEY (sub_comment_id) REFERENCES comment (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C5741EEB9');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CD4A2EEDE');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C7BB031D6');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE category');
    }
}
