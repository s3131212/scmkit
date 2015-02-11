<?php
require_once (dirname(dirname(dirname(__FILE__))).'/core/excelreader/reader.php');
class Student_Controller {

    public function list_class(){
        if(checkpermission(array("student"))){
            header("Location:index.php");
            exit();
        }
        $model = new Student_Model;
        $table = "";
        if(checkpermission(array("student"))){
            header("Location: index.php");
            exit();
        }elseif(checkpermission(array("teacher"))){
            foreach ($_SESSION["class"] as $d) {
                $classname = $model->get_class($d);
                $table .= "<a href='student-list.php?class=".$classname["id"]."'><button>".$classname["grade"]."年".$classname["name"]."班</button></a>";
            }
        }elseif(checkpermission(array("staff"))){
            foreach ($model->get_class_list() as $d) {
                $classname = $model->get_class($d["id"]);
                $table .= "<a href='student-list.php?class=".$classname["id"]."'><button>".$classname["grade"]."年".$classname["name"]."班</button></a>";
            }
        }

        echo Template::call_view("student",array("data"=>$table));
    }

    public function list_student($dataperpage,$nowpage = "",$id){
        if(checkpermission(array("student"))){
            header("Location:index.php");
            exit();
        }elseif(checkpermission(array("teacher"))){
            if(!in_array($id,$_SESSION["class"])){
                header("Location:index.php");
                exit();
            }
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
            <td><a href='student-view.php?id=".$d["id"]."' class='btn btn-link'><button>檢視</button></a>
            <a href='student-modify.php?id=".$d["id"]."' class='btn btn-link'><button>變更</button></a></td>";
        }
        $table .= "</table>";
        $table .= $this->create_nav($dataperpage,$nowpage,$data[1],$id);
        echo Template::call_view("student-list",array("title"=>"<h2>".$classname["grade"]."年".$classname["name"]."班</h2>","data"=>$table));
    }

    public function list_info($id){
        if(checkpermission(array("student"))){
            header("Location:index.php");
            exit();
        }elseif(checkpermission(array("teacher"))){
            if(!in_array($id,$_SESSION["class"])){
                header("Location:index.php");
                exit();
            }
        }
        $model = new Student_Model;
        $res = $model->get_info($id);
        $classname = $model->get_class($res["class"]);
        $incentive=json_decode($res["incentive"]);
        $leave = $this->ger_leave($res["leave"]);
        echo Template::call_view("student-view",array("class"=>$classname["grade"]."年".$classname["name"]."班","name"=>$res["name"],"login_name"=>$res["login_name"],"address"=>$res["address"],"phone"=>$res["phone"],"personalid"=>$res["personalid"],"academic_year"=>$res["academic_year"],"email"=>$res["email"],"firstleveldemerit"=>$incentive[0]->firstleveldemerit,"secondleveldemerit"=>$incentive[0]->secondleveldemerit,"warning"=>$incentive[0]->warning,"firstcredit"=>$incentive[0]->firstcredit,"secondcredit"=>$incentive[0]->secondcredit,"reward"=>$incentive[0]->reward,"leave"=>$leave));
    }

    public function modify_info_table($id){
        if(checkpermission(array("student"))){
            header("Location:index.php");
            exit();
        }elseif(checkpermission(array("teacher"))){
            if(!in_array($id,$_SESSION["class"])){
                header("Location:index.php");
                exit();
            }
        }
        $model = new Student_Model;
        $res = $model->get_info($id);
        $classname = $model->get_class($res["class"]);
        $incentive=json_decode($res["incentive"]);
        echo Template::call_view("student-modify",array("id"=>$id,"class_grade"=>$classname["grade"],"class_name"=>$classname["name"],"name"=>$res["name"],"login_name"=>$res["login_name"],"address"=>$res["address"],"phone"=>$res["phone"],"personalid"=>$res["personalid"],"academic_year"=>$res["academic_year"],"email"=>$res["email"],"academic_year"=>$res["academic_year"],"firstleveldemerit"=>$incentive[0]->firstleveldemerit,"secondleveldemerit"=>$incentive[0]->secondleveldemerit,"warning"=>$incentive[0]->warning,"firstcredit"=>$incentive[0]->firstcredit,"secondcredit"=>$incentive[0]->secondcredit,"reward"=>$incentive[0]->reward,"date"=>date("Y/m/d")));
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
        if(checkpermission(array("student"))){
            header("Location:index.php");
            exit();
        }elseif(checkpermission(array("teacher"))){
            if(!in_array($id,$_SESSION["class"])){
                header("Location:index.php");
                exit();
            }
        }
        $model = new Student_Model;
        $res = $model->get_info($id);
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
        if(checkpermission(array("student"))){
            header("Location:index.php");
            exit();
        }elseif(checkpermission(array("teacher"))){
            if(!in_array($id,$_SESSION["class"])){
                header("Location:index.php");
                exit();
            }
        }
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

    public function delete_student($id){
        if(checkpermission(array("student","teacher"))){
            header("Location:index.php");
            exit();
        }
        $model = new Student_Model;
        $model->delete_student($id);
    }
    public function import_student($file){
        if(checkpermission(array("student","teacher"))){
            header("Location:index.php");
            exit();
        }
        $model = new Student_Model;
        $data = new Spreadsheet_Excel_Reader();
        $data->setOutputEncoding('UTF-8');
        $data->read($file["tmp_name"]);
        for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
            if($data->sheets[0]['cells'][$i][1]!=null&&$data->sheets[0]['cells'][$i][2]!=null&&$data->sheets[0]['cells'][$i][3]!=null){
                $model->new_student($data->sheets[0]['cells'][$i][1],$data->sheets[0]['cells'][$i][2],$data->sheets[0]['cells'][$i][3],$data->sheets[0]['cells'][$i][4],$data->sheets[0]['cells'][$i][5],$data->sheets[0]['cells'][$i][6],$data->sheets[0]['cells'][$i][7],$data->sheets[0]['cells'][$i][8],$data->sheets[0]['cells'][$i][9],$data->sheets[0]['cells'][$i][10]);
            }
        }
    }
    public function new_student($name,$id,$login_name,$academic_year,$password,$class_grade,$class_name,$address="",$phone="",$personalid=""){
        if(checkpermission(array("student","teacher"))){
            header("Location:index.php");
            exit();
        }
        $model = new Student_Model;
        $model->new_student($name,$id,$login_name,$academic_year,$password,$class_grade,$class_name,$address,$phone,$personalid);
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