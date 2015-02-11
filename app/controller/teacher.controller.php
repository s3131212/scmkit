<?php
require_once (dirname(dirname(dirname(__FILE__))).'/core/excelreader/reader.php');
class Teacher_Controller {
    public function list_teacher($dataperpage,$nowpage = ""){
        if(!checkpermission(array("staff"))){
            header("Location:index.php");
            exit();
        }
        $model = new Teacher_Model;
        $table = "<table class=\"table table-striped\"><thead><td>姓名</td><td>登入ID</td><td>動作</td></thead>";
        if($nowpage != null && $nowpage != "1"){
            $offset = ($nowpage-1)*$dataperpage;
            $offset = $offset.", " . $dataperpage;
        }else $offset="0, " . $dataperpage;
        $data = $model->list_teacher($dataperpage,$nowpage,$offset);
        foreach($data[0] as $d){ 
            $table .= "<tr><td>".$d["name"]."</td>
            <td>".$d["login_name"]."</td>
            <td><a href='teacher-view.php?id=".$d["id"]."' class='btn btn-link'><button>檢視</button></a>
            <a href='teacher-modify.php?id=".$d["id"]."' class='btn btn-link'><button>變更</button></a></td>";
        }
        $table .= "</table>";
        $table .= $this->create_nav($dataperpage,$nowpage,$data[1]);
        echo Template::call_view("teacher-list",array("data"=>$table));
    }
    public function view_data($id){
        if(!checkpermission(array("staff"))){
            header("Location:index.php");
            exit();
        }
        $model = new Teacher_Model;
        $res = $model->get_teacher_data($id);
        $class=explode(",",$res["class"]);
        array_shift($class); array_pop($class);
        $h=count($class);
        $i=0;
        while($i<$h){
            $classname=$model->get_class($class[$i]);
            if($i==0){
                $classstring=$classname["grade"]."年".$classname["name"]."班";
            }else{
                $classstring.=$classname["grade"]."年".$classname["name"]."班";
            }
            if(($h-1)!=$i){$classstring.="與";}
            $i++;
        }
        echo Template::call_view("teacher-view",array("name"=>$res["name"],"login_name"=>$res["login_name"],"address"=>$res["address"],"email"=>$res["email"],"phone"=>$res["phone"],"personalid"=>$res["personalid"],"class"=>$classstring,"id"=>$id));
    }
    public function update_info_form($id){
        if(!checkpermission(array("staff"))){
            header("Location:index.php");
            exit();
        }
        $model = new Teacher_Model;
        $res = $model->get_teacher_data($id);
        echo Template::call_view("teacher-modify",array("name"=>$res["name"],"login_name"=>$res["login_name"],"address"=>$res["address"],"email"=>$res["email"],"phone"=>$res["phone"],"option"=>$this->create_class_options($res["class"]),"id"=>$id));
    }
    public function new_teacher_form(){
        if(!checkpermission(array("staff"))){
            header("Location:index.php");
            exit();
        }
        $model = new Teacher_Model;
        $res = $model->get_teacher_data($id);
        echo Template::call_view("teacher-new",array("option"=>$this->create_class_options()));
    }
	public function update_info($name,$login_name,$address,$phone,$email,$personalid,$class,$id){
        if(!checkpermission(array("staff"))){
            header("Location:index.php");
            exit();
        }
        $model = new Teacher_Model;
        $class_string = ",";
        foreach ($class as $value) {
            $class_string .= $value . ",";
        }
    	$model->update_info($name,$login_name,$address,$phone,$email,$class_string,$personalid,$id);
    	header("Location:teacher-modify.php?id=".$id."&s=1");
	}
	public function create_class_options($class_array = ""){
        if(!checkpermission(array("staff"))){
            header("Location:index.php");
            exit();
        }
        $model = new Teacher_Model;
		if($class_array != null) $class = explode(",", $class_array);
		$options = "";
        foreach($model->create_class_options() as $value) {
        	if($class_array != null){
            	if(in_array($value["id"],$class)) $h="selected"; else $h=""; 
               	$options .=  "<option value='".$value["id"]."' ".$h.">".$value["grade"]."年".$value["name"]."班</option>";
            }else{
            	$options .=  "<option value='".$value["id"]."' >".$value["grade"]."年".$value["name"]."班</option>";
            }
        }
        return $options;
	}
	public function new_teacher($name,$id,$login_name,$email,$class,$psd){
        if(!checkpermission(array("staff"))){
            header("Location:index.php");
            exit();
        }
    	$class_string = ",";
        foreach($class as $v){
            $class_string .= $v.",";
        }
        $model->new_teacher($name,$id,$login_name,$email,$class_string,$psd);
	}
	public function import_teacher($file){
        if(!checkpermission(array("staff"))){
            header("Location:index.php");
            exit();
        }
		$data = new Spreadsheet_Excel_Reader();
    	$data->setOutputEncoding('UTF-8');
    	$data->read($file["tmp_name"]);
    	for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
        	if($data->sheets[0]['cells'][$i][1]!=null&&$data->sheets[0]['cells'][$i][2]!=null&&$data->sheets[0]['cells'][$i][3]!=null){
        		$class = explode(",", $data->sheets[0]['cells'][$i][5]);
        		$class_string = ",";
                foreach($class as $v){
                    $class_string .= $v.",";
                }
                $model->new_teacher($data->sheets[0]['cells'][$i][1],$data->sheets[0]['cells'][$i][2],$data->sheets[0]['cells'][$i][3],"",$class_string,$data->sheets[0]['cells'][$i][4]);
   			}
		}
	}
    public function delete_teacher($id){
        if(!checkpermission(array("staff"))){
            header("Location:index.php");
            exit();
        }
        $model = new Teacher_Model;
        $model->delete_teacher($id);
    }
    private function create_nav($dataperpage,$nowpage,$num){
        if(!checkpermission(array("staff"))){
            header("Location:index.php");
            exit();
        }
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