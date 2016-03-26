SPOOL create_constraints.lst;
PROMPT Автор: Щелбанин Александр ВЛадимирович;
PROMPT Группа: ИУ4-83;
PROMPT Создание ограничений БД для АСУ ТП изготовления RR-701-R-T;


PROMPT Создание ограничения C_ACC_LOGIN;
ALTER TABLE ASU_USER.ACCOUNTS
  DROP CONSTRAINT C_ACC_LOGIN;
ALTER TABLE ASU_USER.ACCOUNTS ADD (
  CONSTRAINT C_ACC_LOGIN UNIQUE(ACC_LOGIN)
);
PROMPT Создание ограничения успешно завершено;

PROMPT Создание ограничения C_USER_PHONE;
ALTER TABLE ASU_USER.USERS 
	DROP CONSTRAINT C_USER_PHONE;
ALTER TABLE ASU_USER.USERS ADD (
  CONSTRAINT C_USER_PHONE CHECK(
    USER_PHONE LIKE '8-___-___-__-__'
  )
);
PROMPT Создание ограничения успешно завершено;

PROMPT Создание ограничения C_DOC_URL;
ALTER TABLE ASU_USER.DOCUMENTS
  DROP CONSTRAINT C_DOC_URL;
ALTER TABLE ASU_USER.DOCUMENTS ADD (
  CONSTRAINT C_DOC_URL CHECK(DOC_URL LIKE 'http://%.%')
);
PROMPT Создание ограничения успешно завершено;


PROMPT Работа скрипта успешно завершена;
SPOOL OFF;
