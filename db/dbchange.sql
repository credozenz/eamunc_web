ALTER TABLE `images` ADD `video` TEXT NULL DEFAULT NULL AFTER `name`;
ALTER TABLE `images` CHANGE `video` `video` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL, CHANGE `image` `image` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;
ALTER TABLE `site_indexes` ADD `status` INT NOT NULL DEFAULT '1' COMMENT '0=>archive,1=>active' AFTER `date`;