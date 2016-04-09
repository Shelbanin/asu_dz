SPOOL install.lst

PROMPT Скрипт развертывания БД АСУ ТП изготовления RR-701-R-T
PROMPT Автор: Щелбанин Александр Владимирович
PROMPT Дата создания 9.04.16
PROMPT Дата последнего изменения 9.04.16

@01_create_asu_table.sql;
@02_create_tables.sql;
@03_create_constraints.sql;
@04_create_primary_keys.sql;
@05_create_forign_keys.sql;
@06_create_seqs_and_triggers.sql;
@07_insert_roles.sql;
@08_insert_users.sql;
@09_insert_statuses.sql;
@10_insert_oper_types.sql;
@11_create_function.sql;

COMMIT;
SPOOL OFF;
