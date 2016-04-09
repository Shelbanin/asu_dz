﻿SPOOL create_tables.lst;
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

PROMPT Создание таблицы, содержащую роли системы;
DROP TABLE ASU_USER.ROLES;
CREATE TABLE ASU_USER.ROLES (
	ROLE_ID NUMBER(10) NOT NULL,
	ROLE_NAME VARCHAR2(20) NOT NULL,
  ROLE_ABRIV VARCHAR2(10) NOT NULL
  ) TABLESPACE USERS;
PROMPT Создание таблицы успешно завершено;

PROMPT Создание таблицы, содержащую статусы заказов;
DROP TABLE ASU_USER.STATUS;
CREATE TABLE ASU_USER.STATUS (
  ST_ID NUMBER(10) NOT NULL,
  ST_NAME VARCHAR2(20) NOT NULL
  )TABLESPACE USERS;
PROMPT Создание таблицы успешно завершено;

PROMPT Создание таблицы, содержащую даты начала и завершения выполнения заказов;
DROP TABLE ASU_USER.DATES;
CREATE TABLE ASU_USER.DATES (
  DATE_ID NUMBER(10) NOT NULL,
  DATE_START_SPEC VARCHAR2(10) NOT NULL,
  DATE_END_SPEC VARCHAR2(10) NOT NULL,
  DATE_START_FACT VARCHAR2(10),
  DATE_END_FACT VARCHAR2(10)
  ) TABLESPACE USERS;
PROMPT Создание таблицы успешно завершено;

PROMPT Создание таблицы, содержащую даты начала и завершения выполнения заказов;
DROP TABLE ASU_USER.ORDERS;
CREATE TABLE ASU_USER.ORDERS (
  ORD_ID NUMBER(10) NOT NULL,
  ORD_AMOUNT NUMBER(10) NOT NULL,
  ORD_STATUS NUMBER(10) DEFAULT 1 NOT NULL,
  ORD_PROGRESS NUMBER(10) DEFAULT 0 NOT NULL,
  ORD_DATES NUMBER(10) NOT NULL,
  ORD_OWNER NUMBER(10) NOT NULL,
  ORD_PERFORMER NUMBER(10) NOT NULL,
  ORD_INFO NUMBER(10),
  ORD_DESCRIPTION VARCHAR2(4000) NOT NULL
  ) TABLESPACE USERS;
PROMPT Создание таблицы успешно завершено;

PROMPT Создание таблицы, содержащую информацию о конкретном заказе;
DROP TABLE ASU_USER.ORDER_INFO;
CREATE TABLE ASU_USER.ORDER_INFO (
  OINF_ID NUMBER(10) NOT NULL,
  OINF_PREPARATION NUMBER(10) NOT NULL,
  OINF_ASSENBLY NUMBER(10) NOT NULL,
  OINF_CONTROL NUMBER(10) NOT NULL
  ) TABLESPACE USERS;
PROMPT Создание таблицы успешно завершено;

PROMPT Создание таблицы, содержащую информацию о подготовке ЭРЭ конкретного заказа;
DROP TABLE ASU_USER.PREPARATION;
CREATE TABLE ASU_USER.PREPARATION (
  PREP_ID NUMBER(10) NOT NULL,
  PREP_UNBOXING NUMBER(10) NOT NULL,
  PREP_UNBOX_AMOUNT NUMBER(10) DEFAULT 0 NOT NULL,
  PREP_CONTROL NUMBER(10) NOT NULL,
  PREP_CTRL_AMOUNT NUMBER(10) DEFAULT 0 NOT NULL,
  PREP_OTYPE NUMBER(10) DEFAULT 1 NOT NULL
  ) TABLESPACE USERS;
PROMPT Создание таблицы успешно завершено;

PROMPT Создание таблицы, содержащую информацию о сборке одного устройств конкретного заказа;
DROP TABLE ASU_USER.ASSEMBLY;
CREATE TABLE ASU_USER.ASSEMBLY (
  ASMBL_ID NUMBER(10) NOT NULL,
  ASMBL_PLACING NUMBER(10) NOT NULL,
  ASMBL_PLACED_AMOUNT NUMBER(10) DEFAULT 0 NOT NULL,
  ASMBL_SOLDERING NUMBER(10) NOT NULL,
  ASMBL_SLDR_AMOUNT NUMBER(10) DEFAULT 0 NOT NULL,
  ASMBL_WASHING NUMBER(10) NOT NULL,
  ASMBL_WSHD_AMOUNT NUMBER(10) DEFAULT 0 NOT NULL,
  ASMBL_PACKAGING NUMBER(10) NOT NULL,
  ASMBL_PKG_AMOUNT NUMBER(10) DEFAULT 0 NOT NULL,
  ASMBL_OTYPE NUMBER(10) DEFAULT 2 NOT NULL
  ) TABLESPACE USERS;
PROMPT Создание таблицы успешно завершено;

PROMPT Создание таблицы, содержащую информацию о функциональном контроле устройств конкретного заказа;
DROP TABLE ASU_USER.CONTROL;
CREATE TABLE ASU_USER.CONTROL (
  CTRL_ID NUMBER(10) NOT NULL,
  CTRL_TYPE NUMBER(10) NOT NULL,
  CTRL_AMOUNT NUMBER(10) DEFAULT 0 NOT NULL,
  CTRL_OTYPE NUMBER(10) DEFAULT 3 NOT NULL
  ) TABLESPACE USERS;
PROMPT Создание таблицы успешно завершено;

PROMPT Создание таблицы, содержащую информацию о нормативных документах;
DROP TABLE ASU_USER.DOCUMENTS;
CREATE TABLE ASU_USER.DOCUMENTS (
  DOC_ID NUMBER(10) NOT NULL,
  DOC_NAME VARCHAR2(25) NOT NULL,
  DOC_URL VARCHAR2(100) NOT NULL,
  DOC_DESCRIPTION VARCHAR2(4000) NOT NULL
  ) TABLESPACE USERS;
PROMPT Создание таблицы успешно завершено;

PROMPT Создание таблицы, содержащую информацию о типах операций;
DROP TABLE ASU_USER.OPERATION_TYPES;
CREATE TABLE ASU_USER.OPERATION_TYPES (
  OTYP_ID NUMBER(10) NOT NULL,
  OTYP_NAME VARCHAR2(50) NOT NULL
  ) TABLESPACE USERS;
PROMPT Создание таблицы успешно завершено;

PROMPT Создание таблицы, содержащую информацию о типах операций;
DROP TABLE ASU_USER.OPERATIONS_INFO;
CREATE TABLE ASU_USER.OPERATIONS_INFO (
  OPER_ID NUMBER(10) NOT NULL,
  OPER_NAME VARCHAR2(25) NOT NULL,
  OPER_TYPE NUMBER(10) NOT NULL,
  OPER_DESCRIPTION VARCHAR2(4000) NOT NULL
  ) TABLESPACE USERS;
PROMPT Создание таблицы успешно завершено;


PROMPT Работа скрипта успешно завершена;
SPOOL OFF;
