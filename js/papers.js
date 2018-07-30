// This file is part of YanZi question bank and paper generator system.

/**
 * JavaScript functions required for paper management.
 * @package papermgmt
 * @copyright 2018 Wan Yongquan
 */


$(document).ready(function(){
	reloadpaperstable();
	
	$("#confirmEdit").on('show.bs.modal', function(e){
		// set the data-id attr with paperid;
		$(this).find('.btn-ok').attr('data-id', $(e.relatedTarget).data('id'));
		
	});

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

function editpaper(e){
	var paperid = $(e).attr("data-id");
	$.ajax({
		url: '../zujuan/ajax/zujuan.ajax.php',
		type:'POST',
		data:{
			action:'prepareforeditpaper',
			paperid: paperid
		},
		success:function(data){
			// hide the modal dialog
			$("#confirmEdit").modal("hide");
			
			// relocate
			window.location = data;
			
		}
	});
}

