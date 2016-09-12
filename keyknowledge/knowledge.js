/**
 * Holds the javascript functions for manipulate knowledge 
 */

// add knowledge
function addKnowledge(){
	// get values from page
	var knowledgename = $("#knowledge_name").val();
	
	$.ajax({
		url:'ajax/addknowledge.php',
		type:'POST',
		data:{
			knowledgename:knowledgename
		},
		success:function(data, status){
			// close the popup dialog
			$("#add_keyknowledge_modal").modal("hide");
			
			// clear field in popup dialog
			$("#knowledge_name").val("");
			
			// load the knowledge table
			reloadKnowleges();
		},
		error:function(xhr, textStatus, errorThrown){
			alert('An error occurred!' + errorThrown);
		}
	}
	);
}