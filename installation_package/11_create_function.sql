SPOOL insert_oper_types.lst;
PROMPT �����: �������� ��������� ������������;
PROMPT ������: ��4-83;
PROMPT �������� ������� ��� ���������� ��������� �������;


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

PROMPT ������ ������� ������� ���������;
SPOOL OFF;
