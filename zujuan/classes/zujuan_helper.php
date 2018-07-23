<?php
// 
/**
 * Paper management helper class.
 * @package core_paper
 * @copyright 2018 Wan Yongquan
 */

namespace core_paper;
?>

<?php require_once '../../config.php'; ?>
<?php


/**
 * Papers management helper class.
 */
class PaperHelper{
    public static function getCourseSubjects($courseid){
        global $DB;
        $querystr = "select * from tk_subjects where courseid = $courseid";
        $result = mysqli_query($DB, $querystr);
        if ($result){
           
           $html = '<option value="all" selected>'.get_string('choosesubject') .'</option>';
           foreach($result as $vl){
               $html .= '<option value="' . $vl['subject_id'] . '" >' . $vl['subjectname'] . '</option>';
               
           }
        }
        echo $html;
    }
    
    public static function moveQuestionUp($cart , $questionid){
        if (!isset($questionid) || !isset($cart)){
            return false;
        }
        $questionCart = $cart;
        
        $qtypeArr = $cart['qtype_data'];
        $questionDetail = getQuestionDetails($questionid);
        $question = mysqli_fetch_assoc($questionDetail);
        $qtype = $question['qtype'];
        if (isset($qtypeArr[ $qtype])){
            $qid_arr = $qtypeArr[$qtype];
            $qid_arr =  PaperHelper::array_swap_forward($qid_arr, $questionid);
            if ($qid_arr){
                $qtypeArr[$qtype] = $qid_arr;
            }
        }
        $questionCart['qtype_data'] = $qtypeArr;
        return $questionCart;
    }
    public static function moveQuestionDown($cart, $questionid){
        if (!isset($questionid) || !isset($cart)){
            return false;
        }
        $questionCart = $cart;
        
        $qtypeArr = $cart['qtype_data'];
        $questionDetail = getQuestionDetails($questionid);
        $question = mysqli_fetch_assoc($questionDetail);
        $qtype = $question['qtype'];
        if (isset($qtypeArr[ $qtype])){
            $qid_arr = $qtypeArr[$qtype];
            $qid_arr =  PaperHelper::array_swap_back($qid_arr, $questionid);
            if ($qid_arr){
                $qtypeArr[$qtype] = $qid_arr;
            }
        }
        $questionCart['qtype_data'] = $qtypeArr;
        return $questionCart;
    }
    
    
    public static function array_swap_forward($arr,$elem)
    {
        $index = array_search($elem, $arr);
        if ($index == 0){
            // do nothing if the specified element is the first element in array;
            return false;
        }
        $ndx = array_search($elem,$arr) - 1;
        $before = array_slice($arr,0,$ndx);
        $mid = array_reverse(array_slice($arr,$ndx,2));
        $after = array_slice($arr,$ndx + 2);
        
        return array_merge($before,$mid,$after);
    }
    
    public static function array_swap_back($arr,$elem)
    {
        $index = array_search($elem, $arr);
        if ($index == count($arr) - 1){
            // do nothing if the speficied element is the last element in array;
            return false;
        }
        $ndx = array_search($elem,$arr);
        $before = array_slice($arr,0,$ndx);
        $mid = array_reverse(array_slice($arr,$ndx,2));
        $after = array_slice($arr,$ndx + 2);
        
        return array_merge($before,$mid,$after);
    }

    public static function reloadQuestionCart($questionCart){
        
        if (!isset($questionCart)){            
           echo  ' you have add no question in cart';
        }else{
            $courseid = $questionCart ['courseid'];
            $qtypeArr = $questionCart ['qtype_data'];
            $html = '';
            $outindex = 0;
            $outLength = count($qtypeArr);
            foreach ( $qtypeArr as $qtype => $qid_arr ) {
                $outindex ++ ;
                $disableclass= "btn disabled";
                $disable_outter_moveup = $outindex == 1? $disableclass : '';
                $disable_outter_movedown= $outindex == $outLength ? $disableclass : '';
                $html .= '<div class="x_panel">
                          <div class="x_title">
                            <h2>' . $qtype . ' </h2>
                            <ul class="nav navbar-right widget-toolbar">';
                $html .= '  <li><a class="collapse-link ' .$disable_outter_moveup . '"><i class="fa fa-arrow-up"></i>'.get_string('moveup') .'</a>  </li>';
                $html .= '  <li><a class="collapse-link '. $disable_outter_movedown . '"><i class="fa fa-arrow-down"></i>'.get_string('movedown') .'</a>  </li>';
                $html .= '  </ul>
                            <div class="clearfix"></div>
                          </div>
                          <div class="x_content">';
                $innerIndex = 0;
                $innerLength = count($qid_arr);
                foreach ( $qid_arr as $vl ) {
                    $innerIndex ++;
                    $questionData = getQuestionDetails ( $vl );
                    $ques = mysqli_fetch_assoc ( $questionData );
                    $disable_inner_moveup = $innerIndex == 1 ? $disableclass: '';
                    $disable_inner_movedown = $innerIndex == $innerLength ? $disableclass : '';
                    $html .= '<div class="panel panel-default">
                                <div class="panel-heading">
                                <h5 style="float:left; margin: 5px 0 6px;">难度：easy  组卷次数：6 入库时间： 2018-8-1</h5>
                                <ul class="nav navbar-right widget-toolbar" >';
                    $html .= ' <li style="float:left"><a class="collapse-link '. $disable_inner_moveup . '" data-id="' . $vl . '" onclick="movequestionup(this)"><i class="fa fa-arrow-up"></i>'.get_string('moveup') .'</a></li>';
                    
                    $html .= '  <li style="float:left"><a class="collapse-link '. $disable_inner_movedown . '" data-id="' . $vl . '" onclick="movequestiondown(this)"><i class="fa fa-arrow-down"></i>'. get_string('movedown').'</a> </li>';
                    
                    $html .= ' <li style="float:left"><a class="collapse-link" data-id="<?=$vl?>"><i class="fa fa-trash-o"></i>'. get_string('removecart').'</a></li>';
                    
                    $html .= ' </ul>
                                <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">' . $ques ['question_body'] . '          </div>
                              </div>';
                }
                $html .= '</div>
                        </div>';
            }
            return $html;
        }
    }
}