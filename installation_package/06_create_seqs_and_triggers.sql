﻿SPOOL create_seqs_and_triggers.lst;
PROMPT Автор: Щелбанин Александр Владимирович;
PROMPT Группа: ИУ4-83;
PROMPT Создание последовательностей и триггеров БД для АСУ ТП изготовления RR-701-R-T;


PROMPT Создание последовательности для ACCOUNT.ACC_ID;
DROP SEQUENCE ASU_USER.S_ACC_ID ;
CREATE SEQUENCE ASU_USER.S_ACC_ID 
	INCREMENT BY 1 START WITH 1
	MAXVALUE 10000 MINVALUE 1 NOCYCLE 
	NOCACHE NOORDER;
PROMPT Создание последовательности успешно завершено;

PROMPT Создание триггера для ACCOUNT.ACC_ID;
CREATE OR REPLACE TRIGGER ASU_USER.T_ACC_ID 
	BEFORE INSERT ON ASU_USER.ACCOUNTS 
    FOR EACH ROW 
	BEGIN
		SELECT s_acc_id.nextval
			INTO :new.acc_id
			FROM DUAL;
	END;
/
PROMPT Создание триггера успешно завершено;
	
	
PROMPT Создание последовательности для ACCOUNT.USER_ID;
DROP SEQUENCE ASU_USER.S_USER_ID ;
CREATE SEQUENCE ASU_USER.S_USER_ID 
	INCREMENT BY 1 START WITH 1
	MAXVALUE 10000 MINVALUE 1 NOCYCLE 
	NOCACHE NOORDER;
PROMPT Создание последовательности успешно завершено;

PROMPT Создание триггера для ACCOUNT.USER_ID;
CREATE OR REPLACE TRIGGER ASU_USER.T_USER_ID 
	BEFORE INSERT ON ASU_USER.USERS 
	FOR EACH ROW 
	BEGIN
		SELECT s_user_id.nextval
			INTO :new.user_id
			FROM DUAL;
	END;
/
PROMPT Создание триггера успешно завершено;

PROMPT Создание последовательности для ASSEMBLY.ASMBL_ID;
DROP SEQUENCE ASU_USER.S_ASMBL_ID;
CREATE SEQUENCE ASU_USER.S_ASMBL_ID
  INCREMENT BY 1 START WITH 1
  MAXVALUE 10000 MINVALUE 1 NOCYCLE
  NOCACHE NOORDER;
PROMPT Создание последовательности успешно завершено;

PROMPT Создание триггера для ASSEMBLY.ASMBL_ID;
CREATE OR REPLACE TRIGGER ASU_USER.T_ASMBL_ID
  BEFORE INSERT ON ASU_USER.ASSEMBLY
  FOR EACH ROW
    BEGIN
      SELECT S_ASMBL_ID.nextval
      INTO :new.ASMBL_ID
      FROM DUAL;
    END;
/
PROMPT Создание триггера успешно завершено;

PROMPT Создание последовательности для CONTROL.CTRL_ID;
DROP SEQUENCE ASU_USER.S_CTRL_ID;
CREATE SEQUENCE ASU_USER.S_CTRL_ID
  INCREMENT BY 1 START WITH 1
  MAXVALUE 10000 MINVALUE 1 NOCYCLE
  NOCACHE NOORDER;
PROMPT Создание последовательности успешно завершено;

PROMPT Создание триггера для CONTROL.CTRL_ID;
CREATE OR REPLACE TRIGGER ASU_USER.T_CTRL_ID
  BEFORE INSERT ON ASU_USER.CONTROL
  FOR EACH ROW
    BEGIN
      SELECT S_CTRL_ID.nextval
      INTO :new.CTRL_ID
      FROM DUAL;
    END;
/
PROMPT Создание триггера успешно завершено;

PROMPT Создание последовательности для DATES.DATE_ID;
DROP SEQUENCE ASU_USER.S_DATE_ID;
CREATE SEQUENCE ASU_USER.S_DATE_ID
  INCREMENT BY 1 START WITH 1
  MAXVALUE 10000 MINVALUE 1 NOCYCLE
  NOCACHE NOORDER;
PROMPT Создание последовательности успешно завершено;

PROMPT Создание триггера для DATES.DATE_ID;
CREATE OR REPLACE TRIGGER ASU_USER.T_DATE_ID
  BEFORE INSERT ON ASU_USER.DATES
  FOR EACH ROW
    BEGIN
      SELECT S_DATE_ID.nextval
      INTO :new.DATE_ID
      FROM DUAL;
    END;
/
PROMPT Создание триггера успешно завершено;

PROMPT Создание последовательности для DOCUMENTS.DOC_ID;
DROP SEQUENCE ASU_USER.S_DOC_ID;
CREATE SEQUENCE ASU_USER.S_DOC_ID
  INCREMENT BY 1 START WITH 1
  MAXVALUE 10000 MINVALUE 1 NOCYCLE
  NOCACHE NOORDER;
PROMPT Создание последовательности успешно завершено;

PROMPT Создание триггера для DOCUMENTS.DOC_ID;
CREATE OR REPLACE TRIGGER ASU_USER.T_DOC_ID
  BEFORE INSERT ON ASU_USER.DOCUMENTS
  FOR EACH ROW
    BEGIN
      SELECT S_DOC_ID.nextval
      INTO :new.DOC_ID
      FROM DUAL;
    END;
/
PROMPT Создание триггера успешно завершено;

PROMPT Создание последовательности для OPERATIONS_INFO.OPER_ID;
DROP SEQUENCE ASU_USER.S_OPER_ID;
CREATE SEQUENCE ASU_USER.S_OPER_ID
  INCREMENT BY 1 START WITH 1
  MAXVALUE 10000 MINVALUE 1 NOCYCLE
  NOCACHE NOORDER;
PROMPT Создание последовательности успешно завершено;

PROMPT Создание триггера для OPERATIONS_INFO.OPER_ID;
CREATE OR REPLACE TRIGGER ASU_USER.T_OPER_ID
  BEFORE INSERT ON ASU_USER.OPERATIONS_INFO
  FOR EACH ROW
    BEGIN
      SELECT S_OPER_ID.nextval
      INTO :new.OPER_ID
      FROM DUAL;
    END;
/
PROMPT Создание триггера успешно завершено;

PROMPT Создание последовательности для ORDER_INFO.OINF_ID;
DROP SEQUENCE ASU_USER.S_OINF_ID;
CREATE SEQUENCE ASU_USER.S_OINF_ID
  INCREMENT BY 1 START WITH 1
  MAXVALUE 10000 MINVALUE 1 NOCYCLE
  NOCACHE NOORDER;
PROMPT Создание последовательности успешно завершено;

PROMPT Создание триггера для ORDER_INFO.OINF_ID;
CREATE OR REPLACE TRIGGER ASU_USER.T_OINF_ID
  BEFORE INSERT ON ASU_USER.ORDER_INFO
  FOR EACH ROW
    BEGIN
      SELECT S_OINF_ID.nextval
      INTO :new.OINF_ID
      FROM DUAL;
    END;
/
PROMPT Создание триггера успешно завершено;

PROMPT Создание последовательности для ORDERS.ORD_ID;
DROP SEQUENCE ASU_USER.S_ORD_ID;
CREATE SEQUENCE ASU_USER.S_ORD_ID
  INCREMENT BY 1 START WITH 1000
  MAXVALUE 10000 MINVALUE 1 NOCYCLE
  NOCACHE NOORDER;
PROMPT Создание последовательности успешно завершено;

PROMPT Создание триггера для ORDERS.ORD_ID;
CREATE OR REPLACE TRIGGER ASU_USER.T_ORD_ID
BEFORE INSERT ON ASU_USER.ORDERS
FOR EACH ROW
  BEGIN
    SELECT S_ORD_ID.nextval
    INTO :new.ORD_ID
    FROM DUAL;
  END;
/
PROMPT Создание триггера успешно завершено;

PROMPT Создание последовательности для PREPARATION.PREP_ID;
DROP SEQUENCE ASU_USER.S_PREP_ID;
CREATE SEQUENCE ASU_USER.S_PREP_ID
  INCREMENT BY 1 START WITH 1
  MAXVALUE 10000 MINVALUE 1 NOCYCLE
  NOCACHE NOORDER;
PROMPT Создание последовательности успешно завершено;

PROMPT Создание триггера для PREPARATION.PREP_ID;
CREATE OR REPLACE TRIGGER ASU_USER.T_PREP_ID
  BEFORE INSERT ON ASU_USER.PREPARATION
  FOR EACH ROW
    BEGIN
      SELECT S_PREP_ID.nextval
      INTO :new.PREP_ID
      FROM DUAL;
    END;
/
PROMPT Создание триггера успешно завершено;


PROMPT Работа скрипта успешно завершена;
SPOOL OFF;
