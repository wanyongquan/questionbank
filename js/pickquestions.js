// This file is part of YanZi question bank and paper generator system.

/**
 * JavaScript functions required for paper management.
 * @package papermgmt
 * @copyright 2018 Wan Yongquan
 */

function addtocart(e){
	var questionid = $(e).attr("data-id");
	//alert("id" + questionid);
	$.ajax({
		url:'../zujuan/ajax/zujuan.ajax.php',
		data:{
			action:'addquestiontocart',
			questionid:questionid
		},
		success:function(data){
			// update cart infor
			updateCartInfo();
			// update btn text
			$(e).html(data);
		}
	});
}