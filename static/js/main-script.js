function setSelected(filter) {
	var me = this,
		filters = document.getElementById('filters'),
		selected = filters.getElementsByClassName('selected')[0];
	
	selected.className = selected.className.replace(/(?:^|\s)selected(?!\S)/g, '');
	filter.className += ' selected';
}
