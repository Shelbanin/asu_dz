SPOOL create_tables.lst;
PROMPT Автор: Щелбанин Александр Владимирович;
PROMPT Группа: ИУ4-83;
PROMPT Создание таблиц БД для АСУ ТП изготовления RR-701-R-T;


PROMPT Создание таблицы, содержащую информацию о пользователях системы;
DROP TABLE ASU_USER.USERS;
CREATE TABLE ASU_USER.USERS (
	USER_ID NUMBER(10) NOT NULL, 
	USER_NAME VARCHAR2(20) NOT NULL, 
	USER_SURNAME VARCHAR2(20) NOT NULL,
  USER_SECNAME VARCHAR2(20) NOT NULL,
	USER_PHONE VARCHAR2(15) NOT NULL
	) TABLESPACE USERS;
PROMPT Создание таблицы успешно завершено;


PROMPT Создание таблицы, содержащую информацию об аккаунтах пользователей системы;
DROP TABLE ASU_USER.ACCOUNTS;
CREATE TABLE ASU_USER.ACCOUNTS (
	ACC_ID NUMBER(10) NOT NULL,
  ACC_LOGIN VARCHAR2(20) NOT NULL,
	ACC_PASSWORD  VARCHAR2(50) NOT NULL, 
	ACC_ROLE NUMBER(10) DEFAULT 2 NOT NULL, 
	ACC_INFO NUMBER(10) NOT NULL
	) TABLESPACE USERS;
PROMPT Создание таблицы успешно завершено;


PROMPT Работа скрипта успешно завершена;
SPOOL OFF;
