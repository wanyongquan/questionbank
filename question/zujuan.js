/**
 * 
 */

$(document).ready(function(){
    // load all questions on page load by default;
    var courseid = $("input[name='courseid']").val();
    findQuestionsofCourse(courseid);
    
    $(".tree-item").click(function(){
        // get the question that belong to the selected subject;
        var subjectid = $(this).data("treeid");
       
        $(".tree-item").removeClass("tree-selected");
        $(this).addClass("tree-selected");
        $.ajax({
            url:'ajax/findquestions.php',
            type:'POST',
            data:{
                courseid:courseid,
                subjectid : subjectid
            },
            success:function(data, status){
                //reload question list
               $(".qlist").html(data);
            }
        })
    }) ;
});

function findQuestionsofCourse(courseid){
    
    $.ajax({
        url:'ajax/findquestions.php',
        type:'POST',
        data:{
            courseid:courseid
        },
        success:function(data, status){
            //reload question list
           $(".qlist").html(data);
        }
    });
}
