SPOOL create_primary_keys.lst;
PROMPT Автор: Щелбанин Александр ВЛадимирович;
PROMPT Группа: ИУ4-83;
PROMPT Создание первичных ключей БД для АСУ ТП изготовления RR-701-R-T;


PROMPT Создание первичного ключа для ACCOUNTS;
ALTER TABLE ASU_USER.ACCOUNTS 
	DROP CONSTRAINT ACC_ID_PK;
ALTER TABLE ASU_USER.ACCOUNTS 
    ADD (CONSTRAINT ACC_ID_PK PRIMARY KEY(ACC_ID));
PROMPT Создание первичного ключа успешно завершено;

PROMPT Создание первичного ключа для USERS;
ALTER TABLE ASU_USER.USERS 
	DROP CONSTRAINT USER_ID_PK;
ALTER TABLE ASU_USER.USERS 
    ADD (CONSTRAINT USER_ID_PK PRIMARY KEY(USER_ID));
PROMPT Создание первичного ключа успешно завершено;


PROMPT Работа скрипта успешно завершена;
SPOOL OFF;
