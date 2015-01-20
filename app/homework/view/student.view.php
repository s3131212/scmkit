<?php
class Homework_View {
    public function homework_list($array){
        $table = "";
        foreach($array as $d){
            $table .= "<tr>
                <td>". $d['name'] ."</td>
                <td>". $d['start_date'] ."</td>
                <td>". $d['end_date'] ."</td>
                <td><a href=\"view/?id=". $d['id'] ."\" class=\"btn link\"><button>詳細資料</button></a></td>
                </tr>";
        }
        echo Template::call_view(file_get_contents(dirname(dirname(__FILE__)).'/template/student/Homework.php'),array("data"=>$table));
    }

    public function homework_view_id($id,$name,$start_date,$end_date,$description,$tname,$data = ""){
        $table = "<table class='share_table'><thead><td>檔案名稱</td><td>上傳時間</td><td>下載</td></thead>";
        if(isset($data)){
            foreach($data as $d){
                $table .="<tr>
                <td>". $d['filename'] ."</td>
                <td>". $d['upload_time'] ."</td>
                <td><a href=\"../download/?id=". $d['id'] ."\" class=\"btn link\"><button>下載</button></a></td>
                </tr>";
            }
        }
        $table .= "</table>";
        echo Template::call_view(file_get_contents(dirname(dirname(__FILE__)).'/template/student/Homework_view.php'),array("id"=>$id,"name"=>$name,"start_date"=>$start_date,"end_date"=>$end_date,"description"=>$description,"teacher"=>$tname,"data"=>$table));
    }

    public function upload_form($id,$name){
        echo Template::call_view(file_get_contents(dirname(dirname(__FILE__)).'/template/student/Upload.php'),array("id"=>$id,"name"=>$name));
    }

    public function upload_file($table){
        $output = "";
        foreach ($table as $d) {
            if($d[5] == "success"){
                $output .= '<tr class="success">
                <td>'. $d[0] . '</td>
                <td>' . $d[1] . '</td>
                <td><a href="../download/?id='. $d[2] .'" class="link">下載連結</a></td>
                <td><a href="../view/?id='. $d[3] .'" class="link">'.$d[4].'</a></td>
                <td>上傳成功</td>
                </tr>';
            }else{
                $output.='
                <tr class="error">
                <td>未知</td>
                <td>未知</td>
                <td>未知</a></td>
                <td>未知</a></td>
                <td>發生未知錯誤</td>
                </tr>';
            }
        }
        echo Template::call_view(file_get_contents(dirname(dirname(__FILE__)).'/template/student/Uploadfile.php'),array("data"=>$output));
    }

}