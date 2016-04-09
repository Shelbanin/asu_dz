SPOOL insert_oper_types.lst;
PROMPT Автор: Щелбанин Александр Владимирович;
PROMPT Группа: ИУ4-83;
PROMPT Создание функции для вычисления прогресса заказов;


CREATE OR REPLACE FUNCTION ASU_USER.PROGRESS (
  prep_unbox number, prep_ctrl number,
  asmbl_placing number, asmbl_sold number,
  asmbl_wsh number, asmbl_pkg number,
  control number, amount number
  ) RETURN number AS progress number;
  begin
    progress := 100 * (prep_unbox + prep_ctrl +
                       asmbl_placing + asmbl_sold + asmbl_wsh +
                       asmbl_pkg + control) / (7 * amount);
    return progress;
  end;
/

PROMPT Работа скрипта успешно завершена;
SPOOL OFF;
