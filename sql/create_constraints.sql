﻿SPOOL create_constraints.lst;
PROMT Автор: Щелбанин Александр ВЛадимирович;
PROMT Группа: ИУ4-83;
PROMT Создание ограничений БД для АСУ ТП изготовления RR-701-R-T;


PROMT Создание ограничения C_USER_PHONE;
ALTER TABLE "ASU_USER"."USERS" 
	DROP CONSTRAINT "C_USER_PHONE";
ALTER TABLE "ASU_USER"."USERS" 
    ADD (CONSTRAINT "C_USER_PHONE" 
	CHECK(USER_PHONE LIKE '8-___-___-__-__'));
PROMT Создание ограничения успешно завершено;
			
PROMT Работа скрипта успешно завершена;
SPOOL OFF;