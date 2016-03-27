﻿SPOOL create_primary_keys.lst;
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

PROMPT Создание первичного ключа для ROLES;
ALTER TABLE ASU_USER.ROLES
  DROP CONSTRAINT ROLE_ID_PK;
ALTER TABLE ASU_USER.ROLES
  ADD (CONSTRAINT ROLE_ID_PK PRIMARY KEY(ROLE_ID));
PROMPT Создание первичного ключа успешно завершено;

PROMPT Создание первичного ключа для ASSEMBLY;
ALTER TABLE ASU_USER.ASSEMBLY
  DROP CONSTRAINT ASMBL_ID_PK;
ALTER TABLE ASU_USER.ASSEMBLY
  ADD (CONSTRAINT ASMBL_ID_PK PRIMARY KEY(ASMBL_ID));
PROMPT Создание первичного ключа успешно завершено;

PROMPT Создание первичного ключа для CONTROL;
ALTER TABLE ASU_USER.CONTROL
  DROP CONSTRAINT CTRL_ID_PK;
ALTER TABLE ASU_USER.CONTROL
  ADD (CONSTRAINT CTRL_ID_PK PRIMARY KEY(CTRL_ID));
PROMPT Создание первичного ключа успешно завершено;


PROMPT Создание первичного ключа для DATES;
ALTER TABLE ASU_USER.DATES
  DROP CONSTRAINT DATE_ID_PK;
ALTER TABLE ASU_USER.DATES
  ADD (CONSTRAINT DATE_ID_PK PRIMARY KEY(DATE_ID));
PROMPT Создание первичного ключа успешно завершено;

PROMPT Создание первичного ключа для DOCUMENTS;
ALTER TABLE ASU_USER.DOCUMENTS
  DROP CONSTRAINT DOC_ID_PK;
ALTER TABLE ASU_USER.DOCUMENTS
  ADD (CONSTRAINT DOC_ID_PK PRIMARY KEY(DOC_ID));
PROMPT Создание первичного ключа успешно завершено;

PROMPT Создание первичного ключа для OPERATIONS_INFO;
ALTER TABLE ASU_USER.OPERATIONS_INFO
  DROP CONSTRAINT OPED_ID_PK;
ALTER TABLE ASU_USER.OPERATIONS_INFO
  ADD (CONSTRAINT OPED_ID_PK PRIMARY KEY(OPER_ID));
PROMPT Создание первичного ключа успешно завершено;

PROMPT Создание первичного ключа для OPERATION_TYPES;
ALTER TABLE ASU_USER.OPERATION_TYPES
  DROP CONSTRAINT OTYP_ID_PK;
ALTER TABLE ASU_USER.OPERATION_TYPES
  ADD (CONSTRAINT OTYP_ID_PK PRIMARY KEY(OTYP_ID));
PROMPT Создание первичного ключа успешно завершено;

PROMPT Создание первичного ключа для ORDER_INFO;
ALTER TABLE ASU_USER.ORDER_INFO
  DROP CONSTRAINT OINF_ID_PK;
ALTER TABLE ASU_USER.ORDER_INFO
  ADD (CONSTRAINT OINF_ID_PK PRIMARY KEY(OINF_ID));
PROMPT Создание первичного ключа успешно завершено;

PROMPT Создание первичного ключа для ORDERS;
ALTER TABLE ASU_USER.ORDERS
  DROP CONSTRAINT ORD_ID_PK;
ALTER TABLE ASU_USER.ORDERS
  ADD (CONSTRAINT ORD_ID_PK PRIMARY KEY(ORD_ID));
PROMPT Создание первичного ключа успешно завершено;

PROMPT Создание первичного ключа для PREPARATION;
ALTER TABLE ASU_USER.PREPARATION
  DROP CONSTRAINT PREP_ID_PK;
ALTER TABLE ASU_USER.PREPARATION
  ADD (CONSTRAINT PREP_ID_PK PRIMARY KEY(PREP_ID));
PROMPT Создание первичного ключа успешно завершено;

PROMPT Создание первичного ключа для STATUS;
ALTER TABLE ASU_USER.STATUS
  DROP CONSTRAINT ST_ID_PK;
ALTER TABLE ASU_USER.STATUS
  ADD (CONSTRAINT ST_ID_PK PRIMARY KEY(ST_ID));
PROMPT Создание первичного ключа успешно завершено;


PROMPT Работа скрипта успешно завершена;
SPOOL OFF;
