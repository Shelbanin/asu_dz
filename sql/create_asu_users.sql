SPOOL create_asu_users.lst;
PROMT Автор: Щелбанин Александр ВЛадимирович;
PROMT Группа: ИУ4-83;
PROMT Создание пользователей АСУ ТП изготовления RR-701-R-T;

PROMT Создание пользователя с привелегиями DBA;
CREATE USER "ASU_DBA"  PROFILE "DEFAULT" 
    IDENTIFIED BY "handover" DEFAULT TABLESPACE "USERS" 
    ACCOUNT UNLOCK;
GRANT "CONNECT" TO "ASU_DBA";
GRANT "DBA" TO "ASU_DBA";
PROMT Создание пользователя с привелегиями DBA;

PROMT Создание роли пользователя АСУ;
CREATE ROLE "USER_ROLE"  NOT IDENTIFIED;
GRANT DELETE ANY TABLE TO "USER_ROLE"
GRANT INSERT ANY 
    TABLE TO "USER_ROLE";
GRANT SELECT ANY 
    TABLE TO "USER_ROLE";
GRANT UPDATE ANY 
    TABLE TO "USER_ROLE";
PROMT Создание роли пользователя АСУ успешно выполнено;

PROMT Создание пользователя АСУ;
CREATE USER "ASU_USER"  PROFILE "DEFAULT" 
    IDENTIFIED BY "handover" DEFAULT TABLESPACE "USERS" 
    QUOTA UNLIMITED 
    ON USERS 
    ACCOUNT UNLOCK;
GRANT "CONNECT" TO "ASU_USER";
GRANT "USER_ROLE" TO "ASU_USER";
PROMT Создание пользователя АСУ успешно выполнено;

PROMT Работа скрипта успешно завершена;
SPOOL OFF;
