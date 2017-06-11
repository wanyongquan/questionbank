<?php
    // include database file
    include("../../config.php");
?>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>名称</th><th>操作</th>
        </tr>
    </thead>
    <tbody>
<?php
$query = 'select * from tk_paper_rules order by rule_name';

    if (!$result = $DB->query($query)){
        exit(mysqli_error($DB));
    }
    $data = "";
    if ($result->num_rows > 0){
        foreach ($result  as $rule){
             $data .= '<tr>';
            $data .= '<td>'.$rule['rule_name'].'</td>';
            //$data .= '<td>'.$rule['description'].'</td>';
            $data .= '<td><a title="Edit" onclick="getruledetails('.$rule['rule_id'].')"';
            $data .= ' data-toggle="modal" data-target="#edit_rule_modal" data-backdrop="false">';
            $data .= '   <img src="'. $CFG->wwwroot.'/images/gear.png" ';
            $data .= '      alt="edit" class="iconsmall" /></a>';
            $data .= '    <a class="delete_product" data-id="'.$rule['rule_id'].'" ';
            $data .= ' data-toggle="modal" data-target="#delete_course_modal" data-backdrop="false">';
            $data .= '     <i class="glyphicon glyphicon-trash"></i></a></td>';
            $data .= '</tr>';
        }
    }else{
        $data .= "<tr><td>No data found</td></tr>";
    }

    $data .= "</tbody></table>";
    echo $data;

?>

