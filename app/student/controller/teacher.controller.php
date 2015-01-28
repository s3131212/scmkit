<?php
//equire_once (dirname(__FILE__).'/excelreader/reader.php');
class Student_Controller {
    public function list_class(){
        echo Student_View::list_class();
    }

    public function list_student($dataperpage,$nowpage = "",$id){
        if(!isset($id)||!in_array($id,$_SESSION["class"])){
            header("location:../");
            exit();
        }
        echo Student_View::list_student($dataperpage,$nowpage,$id);
    }

    public function list_info($id){
        echo Student_View::list_info($id);
    }

    public function modify_info_table($id){
        echo Student_View::modify_info_table($id);
    }

    public function ger_leave($data){
        $leave=json_decode($data);
        $output = "";
        $output .="事假：";
        if(empty($leave[0]->affairs)) $output .= "無";
        else{
        foreach ($leave[0]->affairs as $key => $value) {
            $output .=  $key." -> " . $value ."節&nbsp&nbsp";
        } }
        $output .= "<br />";
        $output .= "病假：";
        if(empty($leave[0]->sick)) $output .=  "無";
        else{
        foreach ($leave[0]->sick as $key => $value) {
            $output .=  $key." -> " . $value ."節&nbsp&nbsp";
        } }
        $output .= "<br />";
        $output .= "喪假：";
        if(empty($leave[0]->bereavement)) $output .=  "無";
        else{
        foreach ($leave[0]->bereavement as $key => $value) {
            $output .=  $key." -> " . $value ."節&nbsp&nbsp";
        } }
        $output .=  "<br />";
        $output .= "公假：";
        if(empty($leave[0]->public)) $output .=  "無";
        else{
        foreach ($leave[0]->public as $key => $value) {
            $output .=  $key." -> " . $value ."節&nbsp&nbsp";
        } }
        $output .= "<br />";
        $output .= "曠課：";
        if(empty($leave[0]->truancy)) $output .=  "無";
        else{
        foreach ($leave[0]->truancy as $key => $value) {
            $output .=  $key." -> " . $value ."節&nbsp&nbsp";
        }}
        $output .= "<br />";
        return $output;
    }

    public function update_info($name,$login_name,$address,$phone,$personalid,$class_grade,$class_name,$academic_year,$firstleveldemerit,$secondleveldemerit,$warning,$firstcredit,$secondcredit,$reward,$id){
        $model = new Student_Model;
        $res = $model->get_info($id);
        if(!in_array($res["class"],$_SESSION["class"])){
            header("location:../");
            exit();
        }
        $incentive = json_decode($res["incentive"]);
        $incentive[0]->firstleveldemerit = $firstleveldemerit;
        $incentive[0]->secondleveldemerit = $secondleveldemerit;
        $incentive[0]->warning = $warning;
        $incentive[0]->firstcredit = $firstcredit;
        $incentive[0]->secondcredit = $secondcredit;
        $incentive[0]->reward = $reward;
        $json_encode = json_encode($incentive);
        $model->update_info($name,$login_name,$address,$phone,$personalid,$class_grade,$class_name,$academic_year,$json_encode,$id);
        echo json_encode(array(array("content"=>'<div class="alert alert-success" style="display:none;">變更完成</div>')));
        return true;
    }

    public function new_leave($id,$affairs_date,$affairs_num,$sick_date,$sick_num,$bereavement_date,$bereavement_num,$public_date,$public_num,$truancy_date,$truancy_num){
        $model = new Student_Model;
        $res = $model->get_info($id);
        if(!in_array($res["class"],$_SESSION["class"])){
            header("location:../");
            exit();
        }
        //全部丟給Model作
        $model->new_leave($id,$affairs_date,$affairs_num,$sick_date,$sick_num,$bereavement_date,$bereavement_num,$public_date,$public_num,$truancy_date,$truancy_num);
        echo json_encode(array(array("content"=>'<div class="alert alert-success" style="display:none;">變更完成</div>')));
        return false;
    }
    public function create_nav($dataperpage,$nowpage,$num,$class){
        if($num > $dataperpage) $num = floor($num/$dataperpage);
        else $num = 1;
        if($num>1){
            $page=1;
            $nav = '<ul class="pagination">';
            if($nowpage==null) $nowpage="1";
            while($page<=$num){
                if($nowpage == $page) $nav .= '<li class="active"><a href="student_list.php?page='.$page.'&class='.$class.'">'.$page.'</a></li>';
                else $nav .= '<li><a href="student_list.php?page='.$page.'&class='.$class.'">'.$page.'</a></li>';
                $page++;
            }
            $nav .= "</ul>";
        }else $nav = ""; 
        return $nav;
    }
}