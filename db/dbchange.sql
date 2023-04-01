ALTER TABLE `images` ADD `video` TEXT NULL DEFAULT NULL AFTER `name`;
ALTER TABLE `images` CHANGE `video` `video` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL, CHANGE `image` `image` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;
ALTER TABLE `site_indexes` ADD `status` INT NOT NULL DEFAULT '1' COMMENT '0=>archive,1=>active' AFTER `date`;


ALTER TABLE `users` CHANGE `role` `role` INT NOT NULL DEFAULT '2' COMMENT '1->President,2->Delegates,3->Bureau members,4->vip user';
ALTER TABLE `users` CHANGE `type` `type` INT NOT NULL DEFAULT '0' COMMENT '1=>isg_delegates,2=>school_delegates,3=>staff';

ALTER TABLE `committees` ADD `live_url` VARCHAR(250) NULL AFTER `video`;