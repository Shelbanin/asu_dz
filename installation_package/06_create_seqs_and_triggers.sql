SPOOL create_seqs_and_triggers.lst;
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
PROMPT Создание триггера успешно завершено;	
	
	
PROMPT Работа скрипта успешно завершена;
SPOOL OFF;
