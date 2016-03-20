SPOOL insert_users.lst;
PROMT Автор: Щелбанин Александр Владимирович;
PROMT Группа: ИУ4-83;
PROMT Заполнение таблиц пользователей АСУ ТП изготовления RR-701-R-T;

INSERT INTO USERS (
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
	
INSERT INTO ACCOUNTS (
		ACC_LOGIN,
		ACC_PASSWORD,
		ACC_ROLE,
		ACC_INFO
	)
	VALUES (
		'shelbanin',
		'handover',
		'1',
		s_user_id.currval
	);

	
INSERT INTO USERS (
		USER_NAME,
		USER_SURNAME,
		USER_SECNAME,
		USER_PHONE
	)
	VALUES (
		'Евгения',
		'Сидорова',
		'Петровна',
		'8-916-375-62-58'
	);
	
INSERT INTO ACCOUNTS (
		ACC_LOGIN,
		ACC_PASSWORD,
		ACC_INFO
	)
	VALUES (
		'sidorova',
		'handover',
		s_user_id.currval
	);
	
INSERT INTO USERS (
		USER_NAME,
		USER_SURNAME,
		USER_SECNAME,
		USER_PHONE
	)
	VALUES (
		'Николай',
		'Админов',
		'Александрович',
		'8-916-675-66-58'
	);
	
INSERT INTO ACCOUNTS (
		ACC_LOGIN,
		ACC_PASSWORD,
		ACC_ROLE,
		ACC_INFO
	)
	VALUES (
		'admin',
		'handover',
		'1',
		s_user_id.currval
	);

PROMT Работа скрипта успешно завершена;
SPOOL OFF;
