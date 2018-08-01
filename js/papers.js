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

function beforeEditPaper(e){
	// check if there are questions in cart;
	var actionurl = getProjectRootPath() + '/zujuan/ajax/zujuan.ajax.php';
		
		$.ajax({
			url: actionurl,
			type:'POST',
			data:{
				action:'updatecartinfo'			
			},
		    success:function(data){
		    	// update UI element
		    	//alert('arrive here' + data);
		    	if (data == 0){
		    		// forward to edit page;
		    		editpaper(e);
		    	}else{
		    		// set the attr data-id of .btn-ok with paper id;
					$("#confirmEdit").find('.btn-ok').attr('data-id', $(e).data('id'));
					// pop up confirm edit dialog;
		    		$("#confirmEdit").modal("show");
		    	}
		    	
		    }
		});
}
