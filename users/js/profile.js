/**
 * This file is part of ZhiXing Test Paper Generator Platform
 */

$(document).ready(function(){

	$("#btnsaveuser").on('click', function(){
		$("#editUserForm").submit();
	});
});


$("#editUserForm").validator().on('submit', function(e){

		e.preventDefault();
		UpdateUserProfile();
	
});

/**
 * update user profile information
 * @returns
 */
function UpdateUserProfile(){
	var fname = $("#fname").val();
	var lname = $("#lname").val();
	var email = $("#email").val();
	var tel =  $("#tel").val();
	 
	$.ajax({
		url:"ajax/profile.php",
		type:'POST',
		data:{
			fname:fname,
			lname:lname,
			email:email,
			tel:tel
		},
		dataType:'json',
		success:function(data){
			// display a prompt string as result notification;
			//var responseArr = JSON.parse(data);
			if (data.errors != undefined){
				$(".alert-danger").show();
				
				for(var err in data.errors){
					
					$("#alert-errors").append("<li>"+ data.errors[err]+ "</li>");
				}
			}
			if (data.successes != undefined){
				$(".alert-success").show();
				
				for(var msg in data.successes){
					$("#alert-msg").append("<li>"+ data.successes[msg] + "</li>");
				}
			}
			
		}
		
	});		
}
