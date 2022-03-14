<?php

    //データベース接続用変数
    $host     = '*****';
    $username = '*****';
    $password = '*****';
    $dbname   = '*****'; 

    if($_POST['proc'] === 'setdata')
    {
        // データベースへ接続
        $mysqli = new mysqli($host, $username, $password, $dbname);

        // 接続チェック
        if($mysqli->connect_error)
        {
            echo $mysqli->connect_error;
            exit();
        }
        else
        {
            $mysqli->set_charset('utf8');
        }
        
        // SQL文の作成
        $sql = "INSERT INTO practice (id, number, text, flag, ref_num) VALUES ";
        foreach($_POST['data'] as $row)
        {
            $sql .= "('', 999,'".$row['text']."',".$row['flag'].",1)";

            if(next($_POST['data']))
            {
                $sql .= ",";
            }

        }
        $sql .= " ON DUPLICATE KEY UPDATE flag = VALUES(flag);";

        // クエリの実行とデータの取得
        $result = [];
        $result['result'] = $mysqli->query($sql);

            // javascript 側で登録数と更新数を計算するために設定しようとした
            // $result['count'] = $_POST['count'];   
            // $result['affected_rows'] = $mysqli->affected_rows;

        // jsonファイルを出力
        header('Content_type:application/json');
        echo json_encode($result);
        exit();
    }

?>