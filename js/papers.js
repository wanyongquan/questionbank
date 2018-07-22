// This file is part of YanZi question bank and paper generator system.

/**
 * JavaScript functions required for paper management.
 * @package papermgmt
 * @copyright 2018 Wan Yongquan
 */


$(document).ready(function(){
	reloadpaperstable();
});

/**
 * get papers and show in table;
 * @returns
 */
function reloadpaperstable(){
	var dttable = $("#paperstable").dataTable();
	dttable.fnClearTable();
	dttable.fnDestroy();
	
	$("#paperstable").DataTable({
		"serverSide":true,
		"processing":true,
		"searching":false,
		"ajax":{
			"url":'ajax/zujuan.ajax.php',
			"data":{
				action:'reloadpaperstable'}
			}
	});
	
}

