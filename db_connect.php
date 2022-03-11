<?php
    //データベース接続用変数
    //$host     = '';
    $host     = '';
    $username = '';
    $password = '';
    $dbname   = '';

    // データベースへ接続
    $mysqli = new mysqli($host, $username, $password, $dbname);
    
    // 接続チェック
    if($mysqli->connect_error){
        echo $mysqli->connect_error;
        exit();
    }else{
        $mysqli->set_charset('utf8');
    }

    if($_REQUEST['proc'] === 'searchdata'){
        $sql = ' SELECT * FROM practice WHERE text LIKE "%'.$_REQUEST['search_text'].'%" ';
    }else if($_REQUEST['proc'] === 'setdata'){
        // SQL文の作成
        $sql = " SELECT * FROM practice WHERE number = 999 ";
    }
    // クエリの実行とデータの取得
    $db_list = array();
    if($result = $mysqli->query($sql)){
        
        // テーブルのカラム名をキーに設定（FETCH_ASSOC）して、連想列を1行取得する
        while($row = $result->fetch_assoc()){
            $db_list = array(
                'text' => $row['text']
            );
        }

        // 結果セットの解放
        $result->close();
    }

    // データベースから切断
    $mysqli->close();

    // jsonファイルを出力
    header('Content_type:application/json');
    echo json_encode($db_list);
?>