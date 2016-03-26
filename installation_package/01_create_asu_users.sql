SPOOL create_asu_users.lst;
PROMPT Автор: Щелбанин Александр Владимирович;
PROMPT Группа: ИУ4-83;
PROMPT Создание пользователей АСУ ТП изготовления RR-701-R-T;


PROMPT Создание пользователя с привелегиями DBA;
DROP USER ASU_DBA;
CREATE USER ASU_DBA PROFILE DEFAULT
    IDENTIFIED BY handover DEFAULT TABLESPACE USERS 
    ACCOUNT UNLOCK;
GRANT CONNECT TO ASU_DBA;
GRANT DBA TO ASU_DBA;
PROMPT Создание пользователя с привелегиями DBA;

PROMPT Создание роли пользователя АСУ;
DROP ROLE USER_ROLE;
CREATE ROLE USER_ROLE NOT IDENTIFIED;
GRANT DELETE ANY TABLE TO USER_ROLE
GRANT INSERT ANY 
    TABLE TO USER_ROLE;
GRANT SELECT ANY 
    TABLE TO USER_ROLE;
GRANT UPDATE ANY 
    TABLE TO USER_ROLE;
PROMPT Создание роли пользователя АСУ успешно выполнено;


PROMPT Создание пользователя АСУ;
DROP USER ASU_USER;
CREATE USER ASU_USER PROFILE DEFAULT
    IDENTIFIED BY handover DEFAULT TABLESPACE USERS 
    QUOTA UNLIMITED 
    ON USERS 
    ACCOUNT UNLOCK;
GRANT CONNECT TO ASU_USER;
GRANT USER_ROLE TO ASU_USER;
PROMPT Создание пользователя АСУ успешно выполнено;


PROMPT Работа скрипта успешно завершена;
SPOOL OFF;
