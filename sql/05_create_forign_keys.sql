SPOOL create_forign_keys.lst;
PROMPT Автор: Щелбанин Александр ВЛадимирович;
PROMPT Группа: ИУ4-83;
PROMPT Создание вторичных ключей БД для АСУ ТП изготовления RR-701-R-T;

PROMPT Создание вторичного ключа для ACCOUNTS;
ALTER TABLE ASU_USER.ACCOUNTS
  DROP CONSTRAINT ACC_USER_ID_FK;
ALTER TABLE ASU_USER.ACCOUNTS 
    ADD (CONSTRAINT ACC_USER_ID_FK FOREIGN KEY(ACC_INFO) 
    REFERENCES ASU_USER.USERS(USER_ID) 
    ON DELETE CASCADE);
PROMPT Создание вторичного ключа успешно завершено;


PROMPT Работа скрипта успешно завершена;
SPOOL OFF;
