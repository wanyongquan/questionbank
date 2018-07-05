/**
 * Holds functions that manipulate fillblank question
 */

function getSubjects(){
    // get all subjects
    $.ajax({
        url:'../getSubjects.php',
        dataType:'text',
        success:function(data){
           // $.each(data, function(index, item){
           //     items += "<option vlaue='"+ item.id +"'>" + item.subjectName + "</option>";
           // });
            
            $("#subject_list").html(data);
        },
         error:function(){
             alert('error');
         }
    });
}

function getDifficultyLevels(){
    // get all difficultylevels
    $.ajax({
        url:'../getDifficultyLevels.php',
        dataType:'text',
        success:function(data){
           // $.each(data, function(index, item){
           //     items += "<option vlaue='"+ item.id +"'>" + item.subjectName + "</option>";
           // });
            
            $("#difficultylevel_list").html(data);
        },
         error:function(){
             alert('error');
         }
    });
}
$(document).ready(function(e){
    var items = "";
    // get all subjects 
    //getSubjects();
    // get all difficultylevels
    //$difficultylevelid = 
    //getDifficultyLevels();
    
    // jquery validation for question form
    $("#question_form").validate({
       rules:{
           "check_options[]":{
               required:true,
               minlength:1
           }           
       },
       messages:{
           "check_options[]":"Please set at least one answer as correct answer"
       },
       errorElement:"em",
       errorPlacement:function(error, element){
           error.addClass("help-block");
        // Add `has-feedback` class to the parent div.form-group
           // in order to add icons to inputs
           element.parents( ".col-lg-8" ).addClass( "has-feedback" );

           if ( element.prop( "type" ) === "checkbox" ) {
               error.insertAfter( element.parent( "label" ) );
           } else {
               error.insertAfter( element );
           }

           // Add the span element, if doesn't exists, and apply the icon classes to it.
           if ( !element.next( "span" )[ 0 ] ) {
               $( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
           }
       },
       success: function ( label, element ) {
           // Add the span element, if doesn't exists, and apply the icon classes to it.
           if ( !$( element ).next( "span" )[ 0 ] ) {
               $( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
           }
       },
       highlight:function(element, errorClass,validClass){
           $(element).parents(".col-lg-8").addClass("has-error").removeClass("has-success");
           $( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
       },
       unhighlight:function(element, errorClass,validClass){
           $(element).parents(".col-lg-8").addClass("has-success").removeClass("has-error");
           $( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
       }
    });
    
    // edit form validation
   /* $('#question_form')
        .bootstrapValidator({
            message:'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                
                'check_option[]':{
                    validators: {
                        notEmpty: {
                            message: 'Please specify at least one correct answer'
                        }
                    }
                }
            }
        }
       
    );*/
});

function onSubmitQForm(){
    var qid = $("#questionid").val();
    
    if (qid == null || qid==""){
        // add page
        document.question_form.action="addQuestion.php";
    }else{
        // edit page
        document.question_form.action="updateQuestion.php";
    }
    
}


