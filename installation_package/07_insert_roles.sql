SPOOL insert_users.lst;
PROMPT Автор: Щелбанин Александр Владимирович;
PROMPT Группа: ИУ4-83;
PROMPT Заполнение таблиц пользователей АСУ ТП изготовления RR-701-R-T;

INSERT INTO ASU_USER.ROLES (
    ROLE_ID,
    ROLE_NAME,
    ROLE_ABRIV
  )
  VALUES (
    1 ,
    'Администратор',
    'adm'
  );

INSERT INTO ASU_USER.ROLES (
    ROLE_ID,
    ROLE_NAME,
    ROLE_ABRIV
  )
  VALUES (
    2 ,
    'Технолог',
    'teh'
  );

COMMIT;
PROMPT Работа скрипта успешно завершена;
SPOOL OFF;
