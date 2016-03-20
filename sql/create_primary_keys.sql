SPOOL create_tables.lst;
PROMT Автор: Щелбанин Александр ВЛадимирович;
PROMT Группа: ИУ4-83;
PROMT Создание первичных ключей БД для АСУ ТП изготовления RR-701-R-T;


PROMT Создание первичного ключа для ACCOUNTS;
ALTER TABLE "ASU_USER"."ACCOUNTS" 
	DROP CONSTRAINT "ACC_ID_PK";
ALTER TABLE "ASU_USER"."ACCOUNTS" 
    ADD (CONSTRAINT "ACC_ID_PK" PRIMARY KEY("ACC_ID")) 
PROMT Создание первичного ключа успешно завершено;


PROMT Создание первичного ключа для USERS;
ALTER TABLE "ASU_USER"."USERS" 
	DROP CONSTRAINT "USER_ID_PK";
ALTER TABLE "ASU_USER"."USERS" 
    ADD (CONSTRAINT "USER_ID_PK" PRIMARY KEY("USER_ID"));
PROMT Создание первичного ключа успешно завершено;


PROMT Работа скрипта успешно завершена;
SPOOL OFF;
