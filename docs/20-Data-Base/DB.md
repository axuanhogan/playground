# Database
* ## test_playlists_track
    * ### Structure
        | Field                       | Type         | Attributes | Remark     |
        | --------------------------- |:------------:|:----------:|:----------:|
        | track_id                    | int          | UNSIGNED   | 流水編號    |
        | id                          | varchar(20)  |            | 編號        |
        | title                       | varchar(30)  |            | 標題        |
        | description                 | text         |            | 說明        |
        | image_url                   | varchar(100) |            | 圖片連結    |
        | annotation                  | varchar(20)  |            | 註解        |
    * ### Index
        | Field    | Key Name | Type  | Unique | Null |
        | -------- |:--------:|:-----:|:------:|:----:|
        | track_id | Primary  | BTREE | ✓      |      |
    * ### Create SQL
        ``` sql
        CREATE TABLE `test_playlists_track` (
            `track_id` int UNSIGNED NOT NULL COMMENT '流水編號',
            `id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '編號',
            `title` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '標題',
            `description` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '內容',
            `image_url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '圖片',
            `annotation` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '註解'
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

        ALTER TABLE `test_playlists_track`
            ADD PRIMARY KEY (`test_playlists_track_id`);

        ALTER TABLE `test_playlists_track`
            MODIFY `test_playlists_track_id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '流水編號', AUTO_INCREMENT = 7;
        ```