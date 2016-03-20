SPOOL create_seqs_and_triggers.lst;
PROMT Автор: Щелбанин Александр Владимирович;
PROMT Группа: ИУ4-83;
PROMT Создание последовательностей и триггеров БД для АСУ ТП изготовления RR-701-R-T;


PROMT Создание последовательности для ACCOUNT.ACC_ID;
DROP SEQUENCE "ASU_USER"."S_ACC_ID" ;
CREATE SEQUENCE "ASU_USER"."S_ACC_ID" 
	INCREMENT BY 1 START WITH 1
	MAXVALUE 10000 MINVALUE 1 NOCYCLE 
	NOCACHE NOORDER;
PROMT Создание последовательности успешно завершено;

PROMT Создание триггера для ACCOUNT.ACC_ID;
CREATE OR REPLACE TRIGGER "ASU_USER"."T_ACC_ID" 
	BEFORE INSERT ON "ASU_USER"."ACCOUNTS" 
    FOR EACH ROW 
BEGIN
	SELECT s_acc_id.nextval
		INTO :new.acc_id
		FROM DUAL;
END;
PROMT Создание триггера успешно завершено;
	
	
PROMT Создание последовательности для ACCOUNT.USER_ID;
DROP SEQUENCE "ASU_USER"."S_USER_ID" ;
CREATE SEQUENCE "ASU_USER"."S_USER_ID" 
	INCREMENT BY 1 START WITH 1
	MAXVALUE 10000 MINVALUE 1 NOCYCLE 
	NOCACHE NOORDER;
PROMT Создание последовательности успешно завершено;

PROMT Создание триггера для ACCOUNT.USER_ID;
CREATE OR REPLACE TRIGGER "ASU_USER"."T_USER_ID" 
	BEFORE INSERT ON "ASU_USER"."USERS" 
	FOR EACH ROW 
BEGIN
	SELECT s_user_id.nextval
		INTO :new.user_id
		FROM DUAL;
END;
PROMT Создание триггера успешно завершено;	
	
	
PROMT Работа скрипта успешно завершена;
SPOOL OFF;
