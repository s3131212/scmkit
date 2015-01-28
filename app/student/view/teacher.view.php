<?php
//equire_once (dirname(__FILE__).'/excelreader/reader.php');
class Student_View {
    public function list_class(){
        $model = new Student_Model;
        $table = "";
        foreach ($_SESSION["class"] as $d) {
            $classname = $model->get_class($d);
            $table .= "<a href='list/?class=".$classname["id"]."'><button>".$classname["grade"]."年".$classname["name"]."班</button></a>";
        }
        echo Template::call_view(array("appname"=>"student","file"=>"Student"),array("data"=>$table));
    }

    public function list_student($dataperpage,$nowpage = "",$id){
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
            <td><a href='../view?id=".$d["id"]."' class='btn btn-link'><button>檢視</button></a>
            <a href='../modify?id=".$d["id"]."' class='btn btn-link'><button>變更</button></a></td>";
        }
        $table .= "</table>";
        $table .= Student_Controller::create_nav($dataperpage,$nowpage,$data[1],$id);
        echo Template::call_view(array("appname"=>"student","file"=>"Student_list"),array("title"=>"<h2>".$classname["grade"]."年".$classname["name"]."班</h2>","data"=>$table));
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
        echo Template::call_view(array("appname"=>"student","file"=>"View_student"),array("class"=>$classname["grade"]."年".$classname["name"]."班","name"=>$res["name"],"login_name"=>$res["login_name"],"address"=>$res["address"],"phone"=>$res["phone"],"personalid"=>$res["personalid"],"academic_year"=>$res["academic_year"],"email"=>$res["email"],"firstleveldemerit"=>$incentive[0]->firstleveldemerit,"secondleveldemerit"=>$incentive[0]->secondleveldemerit,"warning"=>$incentive[0]->warning,"firstcredit"=>$incentive[0]->firstcredit,"secondcredit"=>$incentive[0]->secondcredit,"reward"=>$incentive[0]->reward,"leave"=>$leave));
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
        echo Template::call_view(array("appname"=>"student","file"=>"Modify_student"),array("id"=>$id,"class_grade"=>$classname["grade"],"class_name"=>$classname["name"],"name"=>$res["name"],"login_name"=>$res["login_name"],"address"=>$res["address"],"phone"=>$res["phone"],"personalid"=>$res["personalid"],"academic_year"=>$res["academic_year"],"email"=>$res["email"],"academic_year"=>$res["academic_year"],"firstleveldemerit"=>$incentive[0]->firstleveldemerit,"secondleveldemerit"=>$incentive[0]->secondleveldemerit,"warning"=>$incentive[0]->warning,"firstcredit"=>$incentive[0]->firstcredit,"secondcredit"=>$incentive[0]->secondcredit,"reward"=>$incentive[0]->reward,"date"=>date("Y/m/d")));
    }
}