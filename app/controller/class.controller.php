<?php
class Class_Controller{
	public function list_class(){
		if(checkpermission(array("student","teacher"))){
            header("Location:index.php");
            exit();
        }
		$table = "";
        $model = new Class_Model;
		foreach ($model->list_class() as $d) {
            $table .=  "<tr><td>".$d["grade"]."年".$d["name"]."班"."</td><td><a href='class-modify.php?id=".$d["id"]."' class='btn'><button>管理</button></a></td></tr>";
        }
        echo Template::call_view("class",array("data"=>$table));
	}
    public function class_modify_form($id){
    	if(checkpermission(array("student","teacher"))){
            header("Location:index.php");
            exit();
        }
        $table = "";
        $model = new Class_Model;
        $res = $model->get_data($id);
        echo Template::call_view("class-modify",array("data"=>$this->list_student_in_class($id),"id"=>$id,"grade"=>$res["grade"],"name"=>$res["name"]));
    }
	public function list_student_in_class($id){
		if(checkpermission(array("student","teacher"))){
            header("Location:index.php");
            exit();
        }
		$table = "";
        $model = new Class_Model;
		foreach ($model->list_student_in_class($id) as $d) {
            $table .=  "<tr><td>".$d["name"]."</td><td><a href='student-modify.php?id=".$d["id"]."' class='btn'><button>管理</button></a></td></tr>";
        }
        return $table;
	}
	public function update_name($grade,$name,$id){
		if(checkpermission(array("student","teacher"))){
            header("Location:index.php");
            exit();
        }
		$model = new Class_Model;
        echo json_encode(array(array("status" => $model->update_name($grade,$name,$id))));
	}
	public function new_class($grade,$name){
		if(checkpermission(array("student","teacher"))){
            header("Location:index.php");
            exit();
        }
		$model = new Class_Model;
        $model->insert_class($grade,$name);
	}
	public function new_class_cross($grade,$name){
		if(checkpermission(array("student","teacher"))){
            header("Location:index.php");
            exit();
        }
        $model = new Class_Model;
		$grade = explode(",", $grade);
		$name = explode(",", $name);
		foreach ($grade as $g) {
			foreach ($name as $n) {
				$model->insert_class($g,$n);
			}
		}
	}
}