SPOOL insert_statuses.lst;
PROMPT Автор: Щелбанин Александр Владимирович;
PROMPT Группа: ИУ4-83;
PROMPT Заполнение таблицы статусов АСУ ТП изготовления RR-701-R-T;

INSERT INTO "ASU_USER"."STATUS" (
    "ST_ID",
    "ST_NAME"
  )
  VALUES (
    1,
    'Новый'
  );

INSERT INTO "ASU_USER"."STATUS" (
    "ST_ID",
    "ST_NAME"
  )
  VALUES (
    2,
    'В процессе'
  );

INSERT INTO "ASU_USER"."STATUS" (
    "ST_ID",
    "ST_NAME"
  )
  VALUES (
    3,
    'Завершенный'
  );


COMMIT;
PROMPT Работа скрипта успешно завершена;
SPOOL OFF;
