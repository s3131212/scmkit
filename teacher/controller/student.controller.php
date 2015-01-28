<?php
//equire_once (dirname(__FILE__).'/excelreader/reader.php');
class Student_Controller {
    public function list_class($class_array){
        $model = new Student_Model;
        $table = "";
        foreach ($class_array as $d) {
            $classname = $model->get_class($d);
            $table .= "<a href='student_list.php?class=".$classname["id"]."'><button>".$classname["grade"]."年".$classname["name"]."班</button></a>";
        }
        echo View::call_view("Student",array("data"=>$table));
    }

    public function list_student($dataperpage,$nowpage = "",$id){
        if(!isset($id)||!in_array($id,$_SESSION["class"])){
            header("location:../");
            exit();
        }
        $model = new Student_Model;
        $table = "<table class=\"table table-striped\"><thead><td>姓名</td><td>登入ID</td><td>動作</td></thead>";
        $classname = $model->get_class($id);
        if($nowpage != null && $nowpage != "1"){
            $offset = ($nowpage-1)*$dataperpage;
            $offset = $offset.", " . $dataperpage;
        }else $offset="0, " . $dataperpage;
        $data = $model->list_student($dataperpage,$nowpage,$offset,$id);
        foreach($data[0] as $d){ 
            $table .= "<tr><td>".$d["name"]."</td>
            <td>".$d["login_name"]."</td>
            <td><a href='view_student.php?id=".$d["id"]."' class='btn btn-link'><button>檢視</button></a>
            <a href='modify_student.php?id=".$d["id"]."' class='btn btn-link'><button>變更</button></a></td>";
        }
        $table .= "</table>";
        $table .= $this->create_nav($dataperpage,$nowpage,$data[1],$id);
        echo View::call_view("Student_list",array("title"=>"<h2>".$classname["grade"]."年".$classname["name"]."班</h2>","data"=>$table));
    }

    public function list_info($id){
        $model = new Student_Model;
        $res = $model->get_info($id);
        if(!in_array($res["class"],$_SESSION["class"])){
            header("location:../");
            exit();
        }
        $classname = $model->get_class($res["class"]);
        $incentive=json_decode($res["incentive"]);
        $leave = $this->ger_leave($res["leave"]);
        echo View::call_view("View_student",array("class"=>$classname["grade"]."年".$classname["name"]."班","name"=>$res["name"],"login_name"=>$res["login_name"],"address"=>$res["address"],"phone"=>$res["phone"],"personalid"=>$res["personalid"],"academic_year"=>$res["academic_year"],"email"=>$res["email"],"firstleveldemerit"=>$incentive[0]->firstleveldemerit,"secondleveldemerit"=>$incentive[0]->secondleveldemerit,"warning"=>$incentive[0]->warning,"firstcredit"=>$incentive[0]->firstcredit,"secondcredit"=>$incentive[0]->secondcredit,"reward"=>$incentive[0]->reward,"leave"=>$leave));
    }

    public function modify_info_table($id){
        $model = new Student_Model;
        $res = $model->get_info($id);
        if(!in_array($res["class"],$_SESSION["class"])){
            header("location:../");
            exit();
        }
        $classname = $model->get_class($res["class"]);
        $incentive=json_decode($res["incentive"]);
        echo View::call_view("Modify_student",array("id"=>$id,"class_grade"=>$classname["grade"],"class_name"=>$classname["name"],"name"=>$res["name"],"login_name"=>$res["login_name"],"address"=>$res["address"],"phone"=>$res["phone"],"personalid"=>$res["personalid"],"academic_year"=>$res["academic_year"],"email"=>$res["email"],"academic_year"=>$res["academic_year"],"firstleveldemerit"=>$incentive[0]->firstleveldemerit,"secondleveldemerit"=>$incentive[0]->secondleveldemerit,"warning"=>$incentive[0]->warning,"firstcredit"=>$incentive[0]->firstcredit,"secondcredit"=>$incentive[0]->secondcredit,"reward"=>$incentive[0]->reward,"date"=>date("Y/m/d")));
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
        return false;
    }
    private function create_nav($dataperpage,$nowpage,$num,$class){
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