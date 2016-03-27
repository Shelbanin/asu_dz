SPOOL insert_oper_types.lst;
PROMPT Автор: Щелбанин Александр Владимирович;
PROMPT Группа: ИУ4-83;
PROMPT Заполнение таблицы типов операций АСУ ТП изготовления RR-701-R-T;

INSERT INTO ASU_USER.OPERATION_TYPES (
    OTYP_ID,
    OTYP_NAME
  )
  VALUES (
    1,
    'Подготовка комплектующих'
  );
INSERT INTO ASU_USER.OPERATION_TYPES (
    OTYP_ID,
    OTYP_NAME
  )
  VALUES (
    2,
    'Сборка'
  );
INSERT INTO ASU_USER.OPERATION_TYPES (
    OTYP_ID,
    OTYP_NAME
  )
  VALUES (
    3,
    'Функциональный контроль'
  );

COMMIT;
PROMPT Работа скрипта успешно завершена;
SPOOL OFF;
