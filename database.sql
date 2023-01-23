CREATE TABLE `twitter`.`categories` ( `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT , `name` VARCHAR(100) NOT NULL , `parent_id` BIGINT(20) UNSIGNED NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
ALTER TABLE `categories` ADD FOREIGN KEY (`parent_id`) REFERENCES `categories`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

INSERT INTO `categories` (`id`, `name`, `parent_id`) VALUES ('', 'grandfather', NULL), ('', 'father', '1'), ('', 'Uncle', '1'), ('', 'me', '2'), ('', 'brother', '2'), ('', 'cousine', '3'), ('', 'cousin2', '3')

-- getCategoryWithAllChildsTree

-- Category::whereNull('parent_id')->with('childs')->get();

SELECT
    cat1.`id` as id1,
    cat1.`title`,
    cat1.`PID`,
    cat2.`id`,
    cat2.`title`,
    cat2.`PID`
FROM
    `category` AS cat1
JOIN(
    SELECT
        cat3.`id`,
        cat3.`title`,
        cat3.`PID`
    FROM
        `category` AS cat3
    )
    as cat2
    on cat2.PID = cat1.id
WHERE
    cat2.PID = cat1.id
ORDER BY `cat2`.`id` ASC


-- //////////////////////////////////

