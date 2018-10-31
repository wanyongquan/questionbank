/**
 * Hold on all functions that manipulate questions
 */

function reloadQuestions(){
	
/*    $.ajax({
        url:'ajax/getQuestions.php',
        type:'get',
        dataType:'text',
        success:function(data, status){
            $(".question_content").html(data);
           
        },
        error:function(xhr){
            alert(xhr.responseText);
        }
    })*/
}

$(document).ready(function(){
    // reload the question table
    //reloadQuestions();
    
    // submit the choice form
    $("#btnAddQuestion").on('click', function(){
        $("#choose_questiontype_form").submit();
    })
    
    // set the data-id when delete_modal shown
    $("#delete_question_modal").on('show.bs.modal', function(e){
    	$(this).find('.btn-ok').attr('data-id', $(e.relatedTarget).data('id'));
    });
/*    $("body").on("beforeunload",function(){
        alert("body beforeunload 事件触发 - 展示页面二");
      });*/
/*    $(window).bind('beforeunload',function(){
        return '您输入的内容尚未保存，确定离开此页面吗？';
   });*/
    //$(window).on('beforeunload',function(){return'Your own message goes here...';});
    $(window).on("beforeunload", function(event){
        //alert('unload');
        //console.log("window beforeunload")
        //event.returnValue="before unload";
        $.ajax({
            url:'quit.php',
            async:false
            
        })
        //return " iam return";
    });
    
});


// get the question type that user choose and forward to create question page;
function choosequestiontype(){
    $.ajax({
        url:'ajax/questiontypeconfirm.php',
        type:'POST',
        datatype:"text",
        data:$("#choose_questiontype_form").serialize(),
        success:function(data, status){
            // clear radio state
            //alert('choose type , done');
            $('input[name="questiontype"]').prop('checked',false);
            // close the modal dialog;
            
            $("#choose_questiontype_modal").modal("hide");
            
            // redirect
            //alert('redirect url:' + data);
            window.location= data;
            },
        error:function(data){
            alert('error');
        }
        });
}

// delete a question 
function deleteQuestion(e){
	var questionid = $(e).attr('data-id');
	$.post('ajax/delete.php',
			{id:questionid},
			function(data, status){
				// hide the modal popup
				$("#delete_question_modal").modal('hide');
				
				// reload the question list
				reloadQuestions();
			});
}


function getQuestionDetails(id){
	// add question_id to the hidden input 
	$("#hidden_question_id").val(id);
	$.post("ajax/getQuestionDetails.php",
			{id:id},
			function(data, status){
			    // parse data in json
			    var question = JSON.parse(data);
			    
			    // 
			}
	);
}

// call choose function after submit modal
$("#choose_questiontype_form").bootstrapValidator().on('success.form.bv', function(e){
    
    if (e.isDefaultPrevented()){
        //
       
    }else{
        e.preventDefault();

        choosequestiontype();
    }
});

$('input[type=radio]').on('change', function(){
   
    if (!this.checked) return;
    
    var meid = $(this).attr('id');
    
    $('.summarycontent.'+meid).show();
    $('.summarycontent').not('div.' + meid).hide();
    
   
});
