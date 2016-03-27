﻿SPOOL create_forign_keys.lst;
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

ALTER TABLE ASU_USER.ACCOUNTS
  DROP CONSTRAINT ACC_ROLE_ID_FK;
ALTER TABLE ASU_USER.ACCOUNTS
  ADD (CONSTRAINT ACC_ROLE_ID_FK FOREIGN KEY(ACC_ROLE)
  REFERENCES ASU_USER.ROLES(ROLE_ID)
  ON DELETE CASCADE);
PROMPT Создание вторичнs[] ключtq успешно завершено;

PROMPT Создание вторичных ключа для ORDERS;
ALTER TABLE ASU_USER.ORDERS
  DROP CONSTRAINT ORD_DATE_ID_FK;
ALTER TABLE ASU_USER.ORDERS
  ADD (CONSTRAINT ORD_DATE_ID_FK FOREIGN KEY(ORD_DATES)
  REFERENCES ASU_USER.DATES(DATE_ID)
  ON DELETE CASCADE);

ALTER TABLE ASU_USER.ORDERS
  DROP CONSTRAINT ORD_ST_ID_FK;
ALTER TABLE ASU_USER.ORDERS
  ADD (CONSTRAINT ORD_ST_ID_FK FOREIGN KEY(ORD_STATUS)
  REFERENCES ASU_USER.STATUS(ST_ID)
  ON DELETE CASCADE);

ALTER TABLE ASU_USER.ORDERS
  DROP CONSTRAINT ORD_OINF_ID_FK;
ALTER TABLE ASU_USER.ORDERS
  ADD (CONSTRAINT ORD_OINF_ID_FK FOREIGN KEY(ORD_INFO)
  REFERENCES ASU_USER.OPERATIONS_INFO(OPER_ID)
  ON DELETE CASCADE);
PROMPT Создание вторичных ключей успешно завершено;

PROMPT Создание вторичных ключа для ORDER_INFO;
ALTER TABLE ASU_USER.ORDER_INFO
  DROP CONSTRAINT OINF_PREP_ID_FK;
ALTER TABLE ASU_USER.ORDER_INFO
  ADD (CONSTRAINT OINF_PREP_ID_FK FOREIGN KEY(OINF_PREPARATION)
  REFERENCES ASU_USER.PREPARATION(PREP_ID)
  ON DELETE CASCADE);

ALTER TABLE ASU_USER.ORDER_INFO
  DROP CONSTRAINT OINF_ASMBL_ID_FK;
ALTER TABLE ASU_USER.ORDER_INFO
  ADD (CONSTRAINT OINF_ASMBL_ID_FK FOREIGN KEY(OINF_ASSEMBLY)
  REFERENCES ASU_USER.ASSEMBLY(ASMBL_ID)
  ON DELETE CASCADE);

ALTER TABLE ASU_USER.ORDER_INFO
  DROP CONSTRAINT OINF_CTRL_IF_FK;
ALTER TABLE ASU_USER.ORDER_INFO
  ADD (CONSTRAINT OINF_CTRL_IF_FK FOREIGN KEY(OINF_CONTROL)
  REFERENCES ASU_USER.CONTROL(CTRL_ID)
  ON DELETE CASCADE);

ALTER TABLE ASU_USER.ORDER_INFO
  DROP CONSTRAINT OPER_OTYPE_ID_FK;
ALTER TABLE ASU_USER.OPERATIONS_INFO
  ADD (CONSTRAINT OPER_OTYPE_ID_FK FOREIGN KEY(OPER_TYPE)
  REFERENCES ASU_USER.OPERATION_TYPES(OTYP_ID)
  ON DELETE CASCADE);
PROMPT Создание вторичных ключей успешно завершено;

PROMPT Создание вторичных ключа для PREPARATION;
ALTER TABLE ASU_USER.PREPARATION
  DROP CONSTRAINT PREP_UNBOX_OINF_ID_FK;
ALTER TABLE ASU_USER.PREPARATION
  ADD (CONSTRAINT PREP_UNBOX_OINF_ID_FK FOREIGN KEY(PREP_UNBOXING)
  REFERENCES ASU_USER.ORDER_INFO(OINF_ID)
  ON DELETE CASCADE);

ALTER TABLE ASU_USER.PREPARATION
  DROP CONSTRAINT PREP_CTRL_OINF_ID_FK;
ALTER TABLE ASU_USER.PREPARATION
  ADD (CONSTRAINT PREP_CTRL_OINF_ID_FK FOREIGN KEY(PREP_CONTROL)
  REFERENCES ASU_USER.OPERATIONS_INFO(OPER_ID)
  ON DELETE CASCADE);
PROMPT Создание вторичных ключей успешно завершено;

PROMPT Создание вторичных ключа для ASSEMBLY;
ALTER TABLE ASU_USER.ASSEMBLY
  DROP CONSTRAINT ASMBL_SL_OINF_ID_FK;
ALTER TABLE ASU_USER.ASSEMBLY
  ADD (CONSTRAINT ASMBL_SL_OINF_ID_FK FOREIGN KEY(ASMBL_SOLDERING)
  REFERENCES ASU_USER.OPERATIONS_INFO(OPER_ID)
  ON DELETE CASCADE);

ALTER TABLE ASU_USER.ASSEMBLY
DROP CONSTRAINT ASMBL_WSH_OINF_ID_FK;
ALTER TABLE ASU_USER.ASSEMBLY
ADD (CONSTRAINT ASMBL_WSH_OINF_ID_FK FOREIGN KEY(ASMBL_WASHING)
REFERENCES ASU_USER.OPERATIONS_INFO(OPER_ID)
ON DELETE CASCADE);

ALTER TABLE ASU_USER.ASSEMBLY
  DROP CONSTRAINT ASMBL_PKG_OINF_ID_FK;
ALTER TABLE ASU_USER.ASSEMBLY
  ADD (CONSTRAINT ASMBL_PKG_OINF_ID_FK FOREIGN KEY(ASMBL_PACKAGING)
  REFERENCES ASU_USER.OPERATIONS_INFO(OPER_ID)
  ON DELETE CASCADE);
PROMPT Создание вторичных ключей успешно завершено;

PROMPT Создание вторичных ключа для CONTROL;
ALTER TABLE ASU_USER.CONTROL
  DROP CONSTRAINT PREP_CTRL_OINF_ID_FK;
ALTER TABLE ASU_USER.CTRL_OINF_ID_FK
  ADD (CONSTRAINT CTRL_OINF_ID_FK FOREIGN KEY(CTRL_TYPE)
  REFERENCES ASU_USER.OPERATIONS_INFO(OPER_ID)
  ON DELETE CASCADE);
PROMPT Создание вторичных ключей успешно завершено;


PROMPT Работа скрипта успешно завершена;
SPOOL OFF;
