function clearField(me) {
	if (me.value == me.defaultValue) {
		me.value = '';
	}
}

function cursorLeft(me) {
	if (me.value == '') {
		me.value = me.defaultValue;
	}
}
