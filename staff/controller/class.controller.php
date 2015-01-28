<?php
class Class_Controller{
	public function list_class(){
		$table = "";
        $model = new Class_Model;
		foreach ($model->list_class() as $d) {
            $table .=  "<tr><td>".$d["grade"]."年".$d["name"]."班"."</td><td><a href='class_modify.php?id=".$d["id"]."' class='btn'><button>管理</button></a></td></tr>";
        }
        echo View::call_view("Class",array("data"=>$table));
	}
    public function class_modify_form($id){
        $table = "";
        $model = new Class_Model;
        $res = $model->get_data($id);
        echo View::call_view("Class_modify",array("data"=>$this->list_student_in_class($id),"id"=>$id,"grade"=>$res["grade"],"name"=>$res["name"]));
    }
	public function list_student_in_class($id){
		$table = "";
        $model = new Class_Model;
		foreach ($model->list_student_in_class($id) as $d) {
            $table .=  "<tr><td>".$d["name"]."</td><td><a href='modify_student.php?id=".$d["id"]."' class='btn'><button>管理</button></a></td></tr>";
        }
        return $table;
	}
	public function update_name($grade,$name,$id){
		$model = new Class_Model;
        echo json_encode(array(array("status" => $model->update_name($grade,$name,$id))));
	}
	public function new_class($grade,$name){
		$model = new Class_Model;
        $model->insert_class($grade,$name);
	}
	public function new_class_cross($grade,$name){
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