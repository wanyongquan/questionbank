// This file is part of YanZi question bank and paper generator system.

/**
 * JavaScript functions required for paper management.
 * @package papermgmt
 * @copyright 2018 Wan Yongquan
 */

$(document).ready(function(){
	// load question candidate();
	var courseid= $("#courseid").val();
	
	reloadCandidateQuestion(courseid, -1, 'all', -1);
	
	/*subject selection changed handler*/
	$("#ques_subject").change(function(){
		var data =$(this).select2('data');
		var subjectid = data[0].id
		var courseid= $("#courseid").val();
		var qtypeid = $(this).attr('data-id');
		var qtype = $(this).attr('data-value');
		
		var difficultyid = $("#difficultyselect .active").attr('data-id');
		$.ajax({
			url:'../zujuan/ajax/zujuan.ajax.php',
			data:{
				action:'fetchquestion',
				subjectid:subjectid,
				courseid: courseid
			},
			success:function(data){
				// update page layout
				//$("#candidatequeslist").html(data);
				reloadCandidateQuestion(courseid, subjectid, qtype, difficultyid);
			}
		});
	});
	
	//questiontype changed
	$("#qtypeselect a").on('click', function(){
		// update active element
		$("#qtypeselect .active").removeClass('active');
		$(this).addClass('active');
		
		// get user selection filter
		var data =$("#ques_subject").select2('data');
		var subjectid = data[0].id
		var courseid= $("#courseid").val();
		
		var qtypeid = $(this).attr('data-id');
		var qtype = $(this).attr('data-value');
		
		var difficultyid = $("#difficultyselect .active").attr('data-id');
		
		//alert(courseid + subjectid + qtypeid + qtype + difficultyid);
		reloadCandidateQuestion(courseid, subjectid, qtype, difficultyid);
	});
	// difficulty changed;
	$("#difficultyselect a").on('click', function(){
		// update active element
		$("#difficultyselect .active").removeClass('active');
		$(this).addClass('active');
		
		// get user selection filter
		var data =$("#ques_subject").select2('data');
		var subjectid = data[0].id
		var courseid= $("#courseid").val();
		
		var qtypeid = $("#qtypeselect .active").attr('data-id');
		var qtype = $("#qtypeselect .active").attr('data-value');
		
		var difficultyid = $(this).attr('data-id');
		
		//alert(courseid + subjectid + qtypeid + qtype + difficultyid);
		reloadCandidateQuestion(courseid, subjectid, qtype, difficultyid);
	});
});

function addtocart(e){
	var questionid = $(e).attr("data-id");
	//alert("id" + questionid);
	$.ajax({
		url:'../zujuan/ajax/zujuan.ajax.php',
		data:{
			action:'addquestiontocart',
			questionid:questionid
		},
		success:function(data){
			// update cart infor
			updateCartInfo();
			// update btn text
			$(e).html(data);
		}
	});
}

function reloadCandidateQuestion(courseid, subjectid, qtype, difficultyid){
	
	$.ajax({
		url:'../zujuan/ajax/zujuan.ajax.php',
		data:{
			action:'fetchcandidatequestion',
			courseid: courseid,
			subjectid: subjectid,
			qtype: qtype,
			difficultyid: difficultyid
		},
		success:function(data){
			// update page layout
			$("#candidatequeslist").html(data);
		}
	});
}