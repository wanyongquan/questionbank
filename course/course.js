/**
 * Hold the javascript functions 
 */

// Add course
function addCourse(){
	return;
	// get values from page
	var coursename = $("#coursename").val();
	var description = $("#description").val();
	alert('onclick')
	if(!coursename){
		// add error highlight
		//$("#coursename").closest('.form-group').removeClass('has-success').addClass('has-error');
		// stop submission
		//e.preventDefault();
		//return;
	}else{
		$("#coursename").closest('.form-group').removeClass('has-error').addClass('has-success');
	}
	// handler
	$.post("ajax/addcourse.php", {
		coursename:coursename,
		description:description
	}, function (data, status){
		// close the popup dialog
		$("#add_new_course_modal").modal("hide");
		
		// clear fields in popup form
		$("#coursename").val("");
		$("#description").val("");
		
		// read course list again
		reloadCourses();
		
	});
}

// get courses
function reloadCourses(){
	$.get("ajax/getCourses.php", {}, function(data, status){
		$(".coursescontent").html(data);
	});
}

function getCourseDetails(id){
	// add course_id to the hidden field for furture usage
	$("#hidden_course_id").val(id);
	$.post("ajax/getCourseDetails.php", {
			id:id
		},
		function(data, status){
			// parse data in json
			var course=JSON.parse(data);
			// assign existing data to the modal popup fields
			$("#edit_coursename").val(course.coursename);
			$("#edit_coursedescription").val(course.description);
		}
	);
	// show modal popup
	
	//$("#edit_course_modal").modal("show");
}

function updateCourseDetails(){
	// get values from page
	var coursename = $("#edit_coursename").val();
	var coursedescription = $("#edit_coursedescription").val();
	
	// get the course id from hidden field
	var id = $("#hidden_course_id").val();
	
	// update course by sending request to server using ajax
	$.post("ajax/updateCourse.php",{
		id:id,
		coursename:coursename,
		coursedescription:coursedescription,
		},
		function(data,status){
			// hide the modal popup
			$("#edit_course_modal").modal("hide");
			
			// todo: reload course list;
			reloadCourses();
		}
	);
}

function deleteCourse(e){
	var courseid= $(e).attr('data-id');
	$.post("ajax/deleteCourse.php", {
			id: courseid
		},
		function(data, status){
			// hide the modal popup
			$("#delete_course_modal").modal("hide");
			
			// reload course table
			reloadCourses();
		}
	);
}
function deleteCourse2(e){
	//e.preventDefault();
	
	var courseid = $(e).attr('data-id');
	alert(courseid);
	
	var parent = $(e).parent("td").parent("tr");
	bootbox.dialog({
		message:"Are you sure want to delete this?",
		title:"<i class='glyphicon glyphicon-trash'></i>Delete ",
		buttons:{
			success:{
				label:"NO",
				className:"btn-success",
				callback:function(){
					$('.bootbox').modal('hide');
				}
			},
			danger:{
				label:"Delete!",
				className:"btn-danger",
				callback:function(){
					// call ajax 
					//using $.ajax;
					$.ajax({
						type:'POST',
						url:'ajax/deleteCourse.php',
						data:'id=' + courseid
					})
					.done(function(response){
						bootbox.alert(response);
						parent.fadeOut('slow');
					})
					.fail(function(){
						bootbox.alert('Failed to delete ...');
					})
				}
			}// end of danger
		}// end of buttons
	});
}

$(document).ready(function() {
	// load the course table on page load.
	reloadCourses();
	
	$("#btnAddCourse").on('click', function(){
		$("#addCourseForm").submit();
	})
	$("#btnEditCourse").on('click', function(){
		$("#edit_course_form").submit();
	})
	
	$('#delete_course_modal').on('show.bs.modal', function(e){
		   
			$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
			$(this).find('.btn-ok').attr('data-id', $(e.relatedTarget).data('id'));
		});

	}

);

$("#addCourseForm").validator().on('submit', function(e){
	
	if (e.isDefaultPrevented()){
		// handle error
	}else{
		event.preventDefault();
		//call method;
		alert('add course');
		addCourse();
	}
	
});

$("#edit_course_form").validator().on('submit', function(e){
	
	if (e.isDefaultPrevented()){
		// handle error
	}else{
		event.preventDefault();
		//call method;
		
		updateCourseDetails();
	}
	
});
