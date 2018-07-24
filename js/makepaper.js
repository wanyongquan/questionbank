// This file is part of YanZi question bank and paper generator system.

/**
 * JavaScript functions required for paper management.
 * @package papermgmt
 * @copyright 2018 Wan Yongquan
 */
$(document).ready(function(){
	reloadQuestionCart();
	$("#savepaper").on('click', function(){
		var courseid = $("#courseid").val();
		var papertitle = $("#papertitle").val();
		$.ajax({
			url: getProjectRootPath() + '/zujuan/ajax/zujuan.ajax.php',
			data:{
				action:'savepaper',
				courseid: courseid
			},
			success:function(data){
				var responseArr = JSON.parse(data);
				if (responseArr.success == true){
					alert('save success');
					window.location = '../zujuan/zujuan.php';
				}
			}
		});
	})
});

function movequestionup(e){
	var questionid = $(e).attr("data-id");
	$.ajax({
		url:getProjectRootPath()+ '/zujuan/ajax/zujuan.ajax.php',
		data:{
			action:'movequestionup',
			questionid:questionid
		},
		success:function(data){
			//TODO: update page layout
			reloadQuestionCart();
		}
	
	});
}
function movequestiondown(e){
	var questionid = $(e).attr("data-id");
	$.ajax({
		url: getProjectRootPath()+ '/zujuan/ajax/zujuan.ajax.php',
		data:{
			action:'movequestiondown',
			questionid:questionid
		},
		success:function(data){
			//TODO: update page layout
			reloadQuestionCart();
		}
	
	});
}

function reloadQuestionCart(){
	$.ajax({
		url:getProjectRootPath() + '/zujuan/ajax/zujuan.ajax.php',
		data:{
			action:'reloadquestioncart'
		},
		success:function(data){
			// update paper zone;
			$("#makepaperzone").html(data);
		}
	
	});
}