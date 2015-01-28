<?php
class Homework_View {

    public function homework_list(){
        $table = "";
        $model = new Homework_Model;
        foreach($model->homework_list() as $d){
            $res = $model->get_handed_student_num($d["id"]);
            $table .="<tr>
            <td>". $d['name'] ."</td>
            <td>". $d['start_date'] ."</td>
            <td>". $d['end_date'] ."</td>";
            if(!Homework_Controller::date_check("20".date("y/m/d"),$d["start_date"],">") || !Homework_Controller::date_check("20".date("y/m/d"),$d["end_date"],"<")){
                $table .= "<td>作業尚未開始或已經過期</td>";
            }else{
                $table .= "<td>作業進行中</td>";
            }
            $table .= "<td>".$res[1]." / ".$res[0]."</td>
            <td><a href=\"view/?id=". $d['id'] ."\" class=\"btn link\"><button>詳細資料</button></a></td>
            </tr>";
        }
        echo Template::call_view(array("appname"=>"homework","file"=>"Homework"),array("data"=>$table));
    }

    public function homework_view_by_id($id){
        $model = new Homework_Model;
        $temp = false;
        foreach ($model->homework_list() as $val) {
            if ($val['id'] == $id) {
                $temp = true;
                break;
            }
        }
        if(!$temp){
            header("Location:/");
            exit();
        }
        $res = $model->get_data($id);
        $num = $model->get_handed_student_num($id);
        if(!empty($model->homework_user_upload($id))){
            $table = "<table class='share_table'><thead><td>上傳學生</td><td>檔案名稱</td><td>上傳時間</td><td>下載</td></thead>";
            foreach($model->homework_user_upload($id) as $d){
                $stu = $model->get_student($d["upload_student"]);
                $table .="<tr><td>".$stu["name"]."</td>
                <td>". $d['filename'] ."</td>
                <td>". $d['upload_time'] ."</td>
                <td><a href=\"../download/?id=". $d['id'] ."\" class=\"btn link\"><button>下載</button></a></td>
                </tr>";
            }
            echo Template::call_view(array("appname"=>"homework","file"=>"Homework_view"),array("id"=>$id,"name"=>$res["name"],"start_date"=>$res["start_date"],"end_date"=>$res["end_date"],"description"=>$res["description"],"data"=>$table,"num"=>$num[1]." / ".$num[0]));
        }else{
            echo Template::call_view(array("appname"=>"homework","file"=>"Homework_view"),array("id"=>$id,"name"=>$res["name"],"start_date"=>$res["start_date"],"end_date"=>$res["end_date"],"description"=>$res["description"],"data"=>"","num"=>$num[1]." / ".$num[0]));
        }
    }

    public function new_homework_form(){
        $model = new Homework_Model;
        $option = "";
        foreach($_SESSION["class"] as $value) {
            $classname = $model->get_class_id($value);
            $option .= "<option value='".$value."'>".$classname["grade"]."年".$classname["name"]."班</option>";
        }
        echo Template::call_view(array("appname"=>"homework","file"=>"New_homework"),array("option"=>$option,"date"=>"20".date("y/m/d")));
    }

    public function modify_homework_form($id){
        $model = new Homework_Model;
        $option = "";
        $res = $model->get_data($id);
        $class = explode(",",$res["class"]);
        foreach($_SESSION["class"] as $value) {
            $classname = $model->get_class_id($value);
            if(in_array($value,$class)) $h="selected"; else $h="";
            $option .= "<option value='".$value."' ".$h." >".$classname["grade"]."年".$classname["name"]."班</option>";
        }
        echo Template::call_view(array("appname"=>"homework","file"=>"Modify_homework"),array("option"=>$option,"start_date"=>$res["start_date"],"end_date"=>$res["end_date"],"name"=>$res["name"],"description"=>$res["description"],"id"=>$id));
    }
}