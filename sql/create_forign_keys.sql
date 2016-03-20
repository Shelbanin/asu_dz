SPOOL create_tables.lst;
PROMT Автор: Щелбанин Александр ВЛадимирович;
PROMT Группа: ИУ4-83;
PROMT Создание вторичных ключей БД для АСУ ТП изготовления RR-701-R-T;

PROMT Создание вторичного ключа для ACCOUNTS;
ALTER TABLE "ASU_USER"."ACCOUNTS" 
    ADD (CONSTRAINT "ACC_USER_ID_FK" FOREIGN KEY("ACC_INFO") 
    REFERENCES "ASU_USER"."USERS"("USER_ID") 
    ON DELETE CASCADE);
PROMT Создание вторичного ключа успешно завершено;


PROMT Работа скрипта успешно завершена;
SPOOL OFF;