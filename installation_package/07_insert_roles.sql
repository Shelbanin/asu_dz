SPOOL insert_users.lst;
PROMPT Автор: Щелбанин Александр Владимирович;
PROMPT Группа: ИУ4-83;
PROMPT Заполнение таблиц пользователей АСУ ТП изготовления RR-701-R-T;

INSERT INTO ASU_USER.ROLES (
    ROLE_ID,
    ROLE_NAME
  )
  VALUES (
    1 ,
    'Администратор'
  );

INSERT INTO ASU_USER.ROLES (
    ROLE_ID,
    ROLE_NAME
  )
  VALUES (
    2 ,
    'Технолог'
  );

COMMIT;
PROMPT Работа скрипта успешно завершена;
SPOOL OFF;
