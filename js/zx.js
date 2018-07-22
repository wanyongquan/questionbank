/**
 * hold functions for general use
 */

$(document).ready(function(){
	//var path = getProjectRootPath();
	//alert(path);
	updateCartInfo();
});
function getProjectRootPath(){
	  var pathName = document.location.pathname;
      var index = pathName.substr(1).indexOf("/");
     var result = pathName.substr(0,index+1);
     return result;
/** solution 2
  	//full url: http://localhost/test/index.php
	var currPath = window.document.location.href;
	//app url: /test/index.php
	var pagePath = window.document.location.pathname;
	// host 
	var pos = currPath.indexOf(pagePath);
	var host = currPath.substring(0, pos);
	// project name with slash: /test
	var projectName = pagePath.substring(0, pagePath.substr(1).indexOf('/') + 1);
	return ( host + projectName);*/
}

function updateCartInfo(){
	var actionurl = getProjectRootPath() + '/zujuan/ajax/zujuan.ajax.php';
	
	$.ajax({
		url: actionurl,
		type:'POST',
		data:{
			action:'updatecartinfo'			
		},
	    success:function(data){
	    	// update UI element
	    	//alert('arrive here' + data);
	    	$("#quescartcount").html(data);
	    }
	})
}

function updateCartBrief(){
	var actionurl = getProjectRootPath() + '/zujuan/ajax/zujuan.ajax.php';
	
	$.ajax({
		url:actionurl,
		type:'POST',
		data:{
			action:'updatecartbrief'
		},
		success:function(data){
			// update cart drowdown list
			$("#quesCart").html(data);
		}
	})
}