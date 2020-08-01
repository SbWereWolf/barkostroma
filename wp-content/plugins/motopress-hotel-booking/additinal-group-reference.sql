create table log
(
	id bigint auto_increment
		primary key,
	message text null,
	moment timestamp default CURRENT_TIMESTAMP null
);

create table mphb_additional_service_group
(
	id bigint auto_increment,
	code varchar(50) not null comment 'Код для группы услуг',
	sort_order bigint null comment 'Порядок сортировки',
	title varchar(100) not null comment 'Имя группы',
	remark text null comment 'Описание группы дополнительных услуг',
	inserted_at datetime default now() null comment 'Добавлено',
	constraint mphb_additional_service_group_pk
		primary key (id)
);

create unique index mphb_additional_service_group_code_uindex
	on mphb_additional_service_group (code);

create unique index mphb_additional_service_group_sort_order_uindex
	on mphb_additional_service_group (sort_order);

INSERT INTO mphb_additional_service_group
(code, sort_order, title, remark)
VALUES ('default', -1, 'Прочие', 'Группа по умолчанию, системная, изменять только если вы реально понимаете что и зачем вы делаете');

DELIMITER $$
DROP FUNCTION IF EXISTS define_group;

CREATE FUNCTION define_group(a_post_id bigint,
                             new_group_code varchar(50))
    RETURNS bigint
    DETERMINISTIC
BEGIN
    DECLARE affected_rows bigint DEFAULT 0;
    DECLARE post_exists bigint DEFAULT 0;
    DECLARE record_exists bigint DEFAULT 0;
    DECLARE group_exists bigint DEFAULT 0;
    DECLARE meta_code varchar(255) DEFAULT 'mphb_service_group';
    DECLARE group_code longtext;
    DECLARE dummy int;

    delete from log where true;

    select null
    into dummy
    from mphb_additional_service_group
    where code COLLATE utf8mb4_general_ci = new_group_code COLLATE utf8mb4_general_ci
    limit 1;
    SELECT FOUND_ROWS() into record_exists;
    insert into log (message) values (record_exists);

    if(record_exists)
    then
        select null
        into dummy
        from wppv_posts
        where id = a_post_id
        limit 1;
        SELECT FOUND_ROWS() into post_exists;
    end if;
    insert into log (message) values (post_exists);

    if (post_exists = 1)
    then
        select meta_value
        into group_code
        from wppv_postmeta
        where post_id = a_post_id
          and meta_key COLLATE utf8mb4_general_ci = meta_code COLLATE utf8mb4_general_ci
        limit 1;
        SELECT FOUND_ROWS() into group_exists;
    end if;
    insert into log (message) values (group_exists);
    insert into log (message) values (concat('find group with name ', group_code));

    if (group_exists = 1 and group_code <> new_group_code)
    then
        insert into log (message) values ('before update');
        update wppv_postmeta
        set meta_value = new_group_code
        where post_id = a_post_id
          and meta_key COLLATE utf8mb4_general_ci = meta_code COLLATE utf8mb4_general_ci;
        SELECT ROW_COUNT() into affected_rows;
        insert into log (message) values ('after update');
    end if;
    insert into log (message) values (affected_rows);

    if (post_exists = 1 and group_exists = 0)
    then
        insert into log (message) values ('before insert');
        insert into wppv_postmeta(post_id, meta_key, meta_value)
        VALUES (a_post_id, meta_code, new_group_code);
        SELECT ROW_COUNT() into affected_rows;
        insert into log (message) values ('after insert');
    end if;
    insert into log (message) values (affected_rows);

    return (affected_rows);
END$$
DELIMITER ;
