CREATE TABLE `twitter`.`categories` ( `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT , `name` VARCHAR(100) NOT NULL , `parent_id` BIGINT(20) UNSIGNED NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
ALTER TABLE `categories` ADD FOREIGN KEY (`parent_id`) REFERENCES `categories`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

INSERT INTO `categories` (`id`, `name`, `parent_id`) VALUES ('', 'grandfather', NULL), ('', 'father', '1'), ('', 'Uncle', '1'), ('', 'me', '2'), ('', 'brother', '2'), ('', 'cousine', '3'), ('', 'cousin2', '3')

-- getCategoryWithAllChildsTree

-- Category::whereNull('parent_id')->with('childs')->get();
SELECT
    `categories`.id AS id,
    `categories`.`name` AS NAME,
    `categories2`.id AS child_id,
    `categories2`.name AS child_name,
    `categories2`.parent_id AS child_pid
FROM
    `categories`
LEFT JOIN `categories` AS `categories2`
ON
    `categories`.`id` = `categories2`.`parent_id`
WHERE
    `categories`.id = 1
