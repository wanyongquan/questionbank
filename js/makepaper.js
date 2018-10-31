// This file is part of YanZi question bank and paper generator system.

/**
 * JavaScript functions required for paper management.
 * @package papermgmt
 * @copyright 2018 Wan Yongquan
 */
$(document).ready(function(){
	reloadQuestionCart();
	/*$("#savepaper").on('click', function(){
		
	});*/

	// save paper modal dialog submitted
	$("#editPaperTitle").bootstrapValidator({
		message:'This value not valid',
		feedbackIcons:{
			valid:'glyphicon glyphicon-ok',
			invalid:'glyphicon glyphicon-remove',
			validating:'glyphicon glyphicon-refresh'
		},
		fields: {
			paper_title:{
				message:'The paper title is not valid',
				validators:{
					notEmpty:{ message:'试卷标题必须填写，不能为空'}
				}
			}
		}
	})
	.on('success.form.bv', function(e){
		// prevent default submission;
		e.preventDefault();
		
		var papertitle = $("#paper_title").val();
		
		$.ajax({
			url: getProjectRootPath() + '/zujuan/ajax/zujuan.ajax.php',
			data:{
				action:'savepaper',
				papertitle:papertitle
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
	
	// set the courseid in hidden field;
	$('#editPaperTitle').on('show.bs.modal', function(e){ 
		//$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
		
		$(this).find('#hidden_courseId').attr('value', $(e.relatedTarget).data('id'));
	});
	
	$("#confirmClear").on('show.bs.modal', function(e){
		// set the data-id attr with paperid;
		$(this).find('.btn-ok').attr('data-id', $(e.relatedTarget).data('id'));
		
	});
	
    $("#paperAnalysis").on('show.bs.modal',function(e){
        showQtypeChart();    	
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
	
	$.ajax({
		url:getProjectRootPath() + '/zujuan/ajax/zujuan.ajax.php',
		type:'POST',
		data:{
			action:'getQtypeInCart'
		},
		success:function(data){
			var responseArr = JSON.parse(data);
			for(var i = 0; i< responseArr.length; i++){
				
				qtypes.push({name: responseArr[i].qtype, value: responseArr[i].quesCount});
			}

			var qtypeOption ={
					title:{
						text:"题型分布",
						x:'center'
					},
					tooltip:{
						trigger:"item",
						formatter:"{a} <br/> {b}:{c} ({d}%)"
					},

					toolbox:{
						show:true,
						feature:{
							mark:{show:true},
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
							}
						}
					},
					calculable:true,
					series:[{
						name:"题型",
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
		}
	});
}
function showSubjectChart(){
	// init pie chart 
	var subjectChart = echarts.init(document.getElementById('subjectdistribution'));
	
	var subjects  = [];
	$.ajax({
		url:getProjectRootPath() + '/zujuan/ajax/zujuan.ajax.php',
		type:'POST',
		data:{
			action:'getSubjectInCart'
		},
		success:function(data){
			var responseArr = JSON.parse(data);
			for(var i = 0; i< responseArr.length; i++){
				subjects.push({name:responseArr[i].subject, value:responseArr[i].QC});
			}
			var subjectOption ={
					title:{
						text:"知识点分布",
						x:'center'
					},
					tooltip:{
						trigger:"item",
						formatter:"{a} <br/> {b}:{c} ({d}%)"
					},
					toolbox:{
						show:true,
						feature:{
							mark:{show:true},
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
							}
						}
					},
					calculable:true,
					series:[{
						name:"知识点",
						type:'pie',
						radius:'55%',
						center:['50%','60%'],
						data:subjects,
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
			subjectChart.setOption(subjectOption);
		}
	});
}

function showSubjectChart(){
	// init pie chart 
	var subjectChart = echarts.init(document.getElementById('subjectdistribution'));
	
	var subjects  = [];
	$.ajax({
		url:getProjectRootPath() + '/zujuan/ajax/zujuan.ajax.php',
		type:'POST',
		data:{
			action:'getSubjectInCart'
		},
		success:function(data){
			var responseArr = JSON.parse(data);
			for(var i = 0; i< responseArr.length; i++){
				subjects.push({name:responseArr[i].subject, value:responseArr[i].QC});
			}
			var subjectOption ={
					title:{
						text:"知识点分布",
						x:'center'
					},
					tooltip:{
						trigger:"item",
						formatter:"{a} <br/> {b}:{c} ({d}%)"
					},
					toolbox:{
						show:true,
						feature:{
							mark:{show:true},
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
							}
						}
					},
					calculable:true,
					series:[{
						name:"知识点",
						type:'pie',
						radius:'55%',
						center:['50%','60%'],
						data:subjects,
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
			subjectChart.setOption(subjectOption);
		}
	});
}
function showDifficultyChart(){
	// init pie chart 
	var difficultyChart = echarts.init(document.getElementById('difficultydistribution'));
	
	var difficulties  = [];
	$.ajax({
		url:getProjectRootPath() + '/zujuan/ajax/zujuan.ajax.php',
		type:'POST',
		data:{
			action:'getDifficultyInCart'
		},
		success:function(data){
			var responseArr = JSON.parse(data);
			for(var i = 0; i< responseArr.length; i++){
				difficulties.push({name:responseArr[i].Difficulty, value:responseArr[i].QC});
			}
			var option ={
					title:{
						text:"难度分布",
						x:'center'
					},
					tooltip:{
						trigger:"item",
						formatter:"{a} <br/> {b}:{c} ({d}%)"
					},
					toolbox:{
						show:true,
						feature:{
							mark:{show:true},
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
							}
						}
					},
					calculable:true,
					series:[{
						name:"难度",
						type:'pie',
						radius:'55%',
						center:['50%','60%'],
						data:difficulties,
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
			difficultyChart.setOption(option);
		}
	});
}

/**
 * show report of questions on page;
 * @returns
 */
function showOverallReport(){
	$.ajax({
		url:getProjectRootPath() + '/zujuan/ajax/zujuan.ajax.php',
		type:'GET',
		data:{action:'getoverallreport'},
		success:function(data){
			$("#overallreport").html(data);
		}
	});
}