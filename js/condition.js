$(document).ready(function(){
	
	showSubjectTree();
	
	$( "#multichoice_spinner" ).spinner({max:0,min:0}); 

	    
});

$("#i-condition-frm").on('submit', function(e){
	e.preventDefault();
	generatePaper(e);
});

function showSubjectTree(){
	var courseId  = $("#currCourse").val();
	
	$.ajax({
		url:getProjectRootPath() + '/zujuan/ajax/zujuan.ajax.php',
		type:'POST',
		data:{action:'getcoursesubjects',
			courseId:courseId},
		success:function(data){
			var subjectNodes = [];
			var responseArr = JSON.parse(data);
			for(var i = 0 ; i< responseArr.length; i++){
				var node = { text: responseArr[i].subjectname,
						tags:[{id:responseArr[i].id}]}
				subjectNodes.push(node);
			}
		    $("#tree").treeview({data:subjectNodes, multiSelect:true,showCheckbox:true});
		    $("#tree").on('nodeSelected', function(event, data){
		        loadTags(data);
		    });  
		    
		    $("#tree").on('nodeUnselected', function(event, data){
		        loadTags(data);
		    });
		    $("#tree").on('nodeChecked', function(event, data){
		        loadTags(data);
		    });  
		    $("#tree").on('nodeUnchecked', function(event, data){
		        loadTags(data);
		    });  
		 
		}
	});

	function loadTags(data){
		//alert('selected' + data.text);
    	
    	var exists = false;
    	var choosensubjects = $("[name='choosensubjects[]']");
    	if (choosensubjects != null){
    		for(var i= 0 ; i< choosensubjects.length; i++){
    			
    			var id = $(choosensubjects[i]).attr('data-id');
    			if (data.tags.length> 0 ){
    				if (id == data.tags[0].id){
    					exists = true;
    					break;
    				}
    			}
    		}
    	}
    	if (exists == false){
	        $("#choosenSubjectTags").append('<div class="i-subject-item" data-id="' + data.tags[0].id+ '">' + data.text 
	        		+ '<input type="checkbox" checked name="choosensubjects[]" value="' + data.tags[0].id + '" style="display:none">'
	        		+ '<a name="rmlink"><i class="fa fa-times"></i></a></div>')
	        $("#tree").treeview('checkNode', [data.nodeId, {silent:true}]);
	        $("#tree").treeview('selectNode', [data.nodeId, {silent:true}]);
	        bindListener();
    	}
    	else{
    		
    		$("#tree").treeview('checkNode', [data.nodeId, {silent:true}]);
    		$("#tree").treeview('selectNode', [data.nodeId, {silent:true}]);
    	}
    	
    	// update available question subtotal;
    	reloadAvailableQuestionCount();
    	
    	
	}
}

function reloadAvailableQuestionCount(){
	var courseId = $("#courseId").val();
	var choosensubjects = $("[name='choosensubjects[]']");
	var subjectIds = [];
	for(var i = 0; i< choosensubjects.length;i++){
		subjectIds.push( $(choosensubjects[i]).val() );
		
	}
	$.ajax({
		url:getProjectRootPath() + '/zujuan/ajax/zujuan.ajax.php',
		type:'POST',
		data:{
			action:'getAvailableQuestionCount',
			courseId: courseId,
			subjectIds: subjectIds
		},
		success:function(data){
			var responseArr = JSON.parse(data);
			if (responseArr != null){
				for(var i = 0; i< responseArr.length; i++){
					$('#' + responseArr[i].qtype ).val(responseArr[i].QC);
					 $( "#"+responseArr[i].qtype+ "_demand" ).attr('max', responseArr[i].QC);
				}
			}
		}	
	});
}
// 用来绑定事件(使用unbind避免重复绑定)
function bindListener(){
    $("a[name=rmlink]").unbind().click(function(){
        $(this).parent().remove();
        var id = $(this).parent().attr('data-id');
        var selectednode = $("#tree").treeview('getSelected');
        $.each(selectednode, function(index , value){
        	//alert(index + value);
        	if (value.tags[0].id == id){
        		 $("#tree").treeview('unselectNode', [value.nodeId, {silent:true}]);
        		 $("#tree").treeview('uncheckNode', [value.nodeId, {silent:true}]);
        	}
        });
       
    })
    
    
}
function getTree(){
	
	var tree = [
		  {
			  text: "Parent -1",
			  icon: "glyphicon glyphicon-stop",
			  selectedIcon: "glyphicon glyphicon-stop",
			  color: "#000000",
			  backColor: "#FFFFFF",
			  href: "#node-1",
			  selectable: true,
			  state: {
			    checked: true,
			    disabled: false,
			    expanded: true,
			    selected: true
			  },
              tags:[{'id':'134'}],
             
		    nodes: [
		      {
		        text: "Child 1",
		        nodes: [
		          {
		            text: "Grandchild 1"
		          },
		          {
		            text: "Grandchild 2"
		          }
		        ]
		      },
		      {
		        text: "Child 2"
		      }
		    ]
		  },
		  {
		    text: "Parent 2"
		  },
		  {
		    text: "Parent 3"
		  },
		  {
		    text: "Parent 4"
		  },
		  {
		    text: "Parent 5"
		  }
		];
	
	var node = {text:"suibian"};
	tree.push(node);
    return tree;
}

function submitForm(){
	$("#i-condition-frm").submit();
}
function generatePaper(e){
	
	var courseId = $("#courseId").val();
	$.ajax({
		url:getProjectRootPath() + '/zujuan/ajax/zujuan.ajax.php',
		type:'POST',
		data:$("#i-condition-frm").serialize()+'&'+  $.param({action:'generatepaper', courseId:courseId}),
		success:function(data){
			//redirect to make test paper center;
			//$("#i-condition-frm").serialize() ,+ $.param({action:'generatepaper', courseId:courseId})
			var responseArr = JSON.parse(data);
			if (responseArr.success == true){
				window.location= responseArr.returnurl;
			}
		}
	});
}