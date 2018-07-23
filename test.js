/**
 * 
 */

$(document).ready(function() {
    
//    $("#example").DataTable({
//    	"processing":true,
//    	"serverSide":true,
//    	"ajax":{
//    		"url":"test.ajax.php",
//    		"data": function(d){
//    			d.mykey = "myvalue";
//    		}
//    	}
//    });
//    
//	$.extend($.fn.datatable.default,{
//		searching:false
//	});
	reloadTable();
	
//	$("#paginate").DataTable({
//		searching:false
//	})
/*    $('#testform').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email is required and cannot be empty'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
            'browsers[]': {
                validators: {
                    notEmpty: {
                        message: 'Please specify at least one browser you use daily for development'
                    }
                }
            },
            'editors[]': {
                validators: {
                    notEmpty: {
                        message: 'At least one names are required'
                    }
                }
            }
        }
    });
*/
});

function deletebtn(e){
	alert('deleted');
	//
	
	var datatable = $("#paginate").dataTable();
	datatable.fnClearTable();
	datatable.fnDestroy();
	
  $("#paginate").DataTable({
	"processing":true,
	"serverSide":true,
	searching:false,
	"ajax":{
		"url":"test.ajax.php",
		"data": function(d){
			d.mykey = "myvalue";
		}
	}
});
}
function reloadTable(){
	var datatable = $("#paginate").dataTable();
	datatable.fnClearTable();
	datatable.fnDestroy();
	
			//$("#paginate").find('tbody').html(html);
	      $('#paginate').dataTable({
          "serverSide":true,
          "processing":true,
          searching:false,
          "pageLength": 25,
          "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
          // "aaSorting": [],
           "ajax":"test.ajax.php"
      });
	
}