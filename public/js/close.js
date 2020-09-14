function base_url(url) {
	return window.location.origin + "/mensajeria" + url;
}

function cerrarform(id) {

	$("#"+id).hide('blind');
}