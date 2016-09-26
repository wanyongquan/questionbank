/**
 * Holds functions that manipulate multichoice question
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
});

function onSubmitQForm(){
    var qid = $("#hidden_question_id").val();
    
    if (qid == null || qid==""){
        // add page
        document.question_form.action="addQuestion.php";
    }else{
        // edit page
        document.question_form.action="updateQuestion.php";
    }
    
}


