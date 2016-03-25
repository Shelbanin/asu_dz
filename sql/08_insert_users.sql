SPOOL insert_users.lst;
PROMPT Автор: Щелбанин Александр Владимирович;
PROMPT Группа: ИУ4-83;
PROMPT Заполнение таблиц пользователей АСУ ТП изготовления RR-701-R-T;


INSERT INTO ASU_USER.USERS (
		USER_NAME,
		USER_SURNAME,
		USER_SECNAME,
		USER_PHONE
	)
	VALUES (
		'Александр',
		'Щелбанин',
		'Владимирович',
		'8-916-451-96-73'
	);
	
INSERT INTO ASU_USER.ACCOUNTS (
		ACC_LOGIN,
		ACC_PASSWORD,
		ACC_ROLE,
		ACC_INFO
	)
	VALUES (
		'shelbanin',
		'7175b6245fadd2ec63caccd40d2ec369',
		'2',
    asu_user.s_user_id.currval
	);
	
INSERT INTO ASU_USER.USERS (
		USER_NAME,
		USER_SURNAME,
		USER_SECNAME,
		USER_PHONE
	)
	VALUES (
		'Администратор',
		'Админов',
		'Администратович',
		'8-916-675-66-58'
	);
	
INSERT INTO ASU_USER.ACCOUNTS (
		ACC_LOGIN,
		ACC_PASSWORD,
		ACC_ROLE,
		ACC_INFO
	)
	VALUES (
		'admin',
		'21232f297a57a5a743894a0e4a801fc3',
		'1',
		asu_user.s_user_id.currval
	);

COMMIT;


PROMPT Работа скрипта успешно завершена;
SPOOL OFF;
