/**
 * Holds the javascript functions for manipulate subject 
 */

// add subject
function addSubject(){
	// get values from page
	var subjectname = $("#subject_name").val();
	
	$.ajax({
		url:'ajax/addSubject.php',
		type:'POST',
		data:{
			subjectname:subjectname
		},
		success:function(data, status){
			// close the popup dialog
			$("#add_subject_modal").modal("hide");
			
			// clear field in popup dialog
			$("#subject_name").val("");
			
			// load the subject table
			reloadsubjects();
		},
		error:function(xhr, textStatus, errorThrown){
			alert('An error occurred!' + errorThrown);
		}
	}
	);
}

// get subject table records
function reloadSubjects(){
	$.get("ajax/getsubjects.php",{}, function(data, status){
		$(".subject_content").html(data);
	});
}

function getSubjectDetails(id){
	// add subject id to hidden field
	$("#hidden_subject_id").val(id);
	$.post("ajax/getSubjectDetails.php",
		{subjectid:id},
		function(data, status){
			// parse data in json
			var subject = JSON.parse(data);
			// assign existing data to modal popup
			$("#edit_subject_name").val(subject.subjectName);
			
		}
	);
	
	
}

function updateSubjectDetails(){
	// get values from page
	var coursename = $("#edit_subject_name").val();
	
	// get the subject id from hidden field
	var subjectid = $("#hidden_subject_id").val();
	
	// update subject by sending request to server using sql
	$.post('ajax/updateSubject.php',
			{subjectid:subjectid,
			 subjectname:subjectname},
			function(data, status){
				 // hide the popup modal
				 $("#edit_subject_modal").modal("hide");
				 
				 // reload subject list;
				 reloadSubjects();
			 }
	);
}

function deleteSubject(){
	var subjectid = $("#hidden_edit_subject_id").val();
	
	$.post("ajax/deleteSubject.php",
			{subjectid:subjectid},
			function(data,status){
				// hide the modal popup
				$("#delete_subject_modal").modal("hide");
				
				// reload subject table
				reloadSubjects();
			}	
		);
}

$(document).ready(function(){
	// reload subject table
	reloadSubjects();
	
	$('#delete_subject_modal').on('show.bs.modal', function(e){ 
		//$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
		
		$(this).find('#hidden_edit_subject_id').attr('value', $(e.relatedTarget).data('id'));
	});

	}
)