// This file is part of YanZi question bank and paper generator system.

/**
 * JavaScript functions required for paper management.
 * @package papermgmt
 * @copyright 2018 Wan Yongquan
 */
$(document).ready(function(){
	reloadQuestionCart();
	$("#savepaper").on('click', function(){
		var courseid = $("#courseid").val();
		var papertitle = $("#papertitle").val();
		$.ajax({
			url: getProjectRootPath() + '/zujuan/ajax/zujuan.ajax.php',
			data:{
				action:'savepaper',
				courseid: courseid
			},
			success:function(data){
				var responseArr = JSON.parse(data);
				if (responseArr.success == true){
					alert('save success');
					window.location = '../zujuan/zujuan.php';
				}
			}
		});
	});
	
	$("#confirmClear").on('show.bs.modal', function(e){
		// set the data-id attr with paperid;
		$(this).find('.btn-ok').attr('data-id', $(e.relatedTarget).data('id'));
		
	});
	
	
});

function movequestionup(e){
	var questionid = $(e).attr("data-id");
	$.ajax({
		url:getProjectRootPath()+ '/zujuan/ajax/zujuan.ajax.php',
		data:{
			action:'movequestionup',
			questionid:questionid
		},
		success:function(data){
			//TODO: update page layout
			reloadQuestionCart();
		}
	
	});
}
function movequestiondown(e){
	var questionid = $(e).attr("data-id");
	$.ajax({
		url: getProjectRootPath()+ '/zujuan/ajax/zujuan.ajax.php',
		data:{
			action:'movequestiondown',
			questionid:questionid
		},
		success:function(data){
			//TODO: update page layout
			reloadQuestionCart();
		}
	
	});
}

function reloadQuestionCart(){
	$.ajax({
		url:getProjectRootPath() + '/zujuan/ajax/zujuan.ajax.php',
		data:{
			action:'reloadquestioncart'
		},
		success:function(data){
			// update paper zone;
			$("#makepaperzone").html(data);
		}
	
	});
}
function clearcart(e){
	var paperid = $(e).attr("data-id");
	$.ajax({
		url: '../zujuan/ajax/zujuan.ajax.php',
		type:'POST',
		data:{
			action:'clearcart'
		},
		success:function(data){
			// hide the modal dialog
			$("#confirmClear").modal("hide");
			
			reloadQuestionCart();
			
			updateCartInfo();
		}
	});
}
function showQtypeChart(){
	// init pie chart 
	var qtypeChart = echarts.init(document.getElementById('qtypedistribution'));
	
	var qtypes  = [];
//	$.ajax({
//		url:'getdata.php',
//		type:'POST',
//		success:function(data){
//			var responseArr = JSON.parse(data);
//			for(var i = 0; i< responseArr.qtypes.length; i++){
//				qtypes.push(responseArr.qtypes[i].qtype);
//			}
			qtypes.push({value: 1, name:'choice'});
			qtypes.push({value: 2, name:'truefalse'});
			qtypes.push({value: 2, name:'shortanswer'});
			var qtypeOption ={
					title:{
						text:"题型分布",
						x:'center'
					},
					tooltip:{
						trigger:"item",
						formatter:"{a} <br/> {b}:{c} ({d}%)"
					},
					legend:{
						orient:"vertical",
						x:'left',
						data:['type1', 'type2', 'type3']
					},
					toolbox:{
						show:true,
						feature:{
							mark:{show:true},
							dataView:{show:true, readonly :false},
							magicType:{
								show:true,
								type:['pie', 'funnel'],
								option:{
									funnel:{
										x:"25%",
										width:"50%",
										funnelAlign:"left",
										max:1548
									}
								}
							},
							
							saveAsImage:{show:true}
						}
					},
					calculable:true,
					series:[{
						name:"Qtype",
						type:'pie',
						radius:'55%',
						center:['50%','60%'],
						data:qtypes,
						itemStyle:{
							normal:{
								label:{
									show:true,
									formatter:'{b}: {c}\n ({d}%)'
								},
								labelLine:{
									show:true
								}
							},
							emphasis:{
								shadowBlur:10,
								shadowOffsetX:0,
								shadowColor:'rgba(0,0,0,0.5)'
							}
						}
					
					}]
			};
			qtypeChart.setOption(qtypeOption);
//		}
//	});
}