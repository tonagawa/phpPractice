<?php

    //データベース接続用変数
    $host     = '*****';
    $username = '*****';
    $password = '*****';
    $dbname   = '*****'; 

    if(isset($_GET['search_text']) && $_GET['search_text'] !== '')   // GETメソッドを受け取った場合（＝検索が実行された場合）
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
        $sql = ' SELECT * FROM practice WHERE text LIKE "%'.$_GET['search_text'].'%" ';

        // クエリの実行とデータの取得
        $result = $mysqli->query($sql);
        
        // 連想配列を取得する
        $data = $result->fetch_all();
            
        // 結果セットの解放とデータベースからの切断
        $result->close();
        $mysqli->close();

        // 検索用テキストボックスと検索ボタンを表示
        echo '<form action="" method="get">';
        echo '<p>検索ボックス<input type="text" id="search_text" name="search_text" value="' , h($_GET['search_text']) ,'"><input type="submit" value="検索"></p>';
        echo '</form>';

        // 登録用テキストボックスと、チェックボックスの表示
        for($i = 1; $i <= 5; $i++){
            echo '<div>';
            echo '<span>テキスト',$i,'</span>';
            echo '<span><input type="text" id="input',$i,'"';

            // 'text' の値を value属性 に設定
            if(isset($data[$i-1][2]))
            {
                echo 'value="',h($data[$i-1][2]),'"';
            }

            echo '></span>';
            echo '<label for="cb',$i,'"><span><input type="checkbox" id="cb',$i,'" class="cb_use"';

            // 'flag' が 1 であればチェックボックスにチェックを入れる
            if(isset($data[$i-1][3]) && $data[$i-1][3] == '1')
            {
                echo 'checked';
            }

            echo '>使用する</span></label>';
            echo '</div>';
        }

        // 「更新」ボタンと「クリア」ボタン
        echo '<div>';
        if(isset($data[0])){
            echo '<input type="button" id="btnADD" value="更新" onclick="SetData()">';
        }else{
            echo '<input type="button" id="btnADD" value="登録" onclick="SetData()">';
        }
        echo '<input type="button" id="btnClear" value="クリア" onclick="TextboxClear()">';
        echo '</div>';
        
    }
    else    // GETメソッドを受け取らなかった場合（＝ただの画面表示）
    {
        // 検索用テキストボックスと検索ボタンを表示
        echo '<form action="" method="get">';
        echo '<p>検索ボックス<input type="text" id="search_text" name="search_text" value=""><input type="submit" value="検索"></p>';
        echo '</form>';

        // 登録用テキストボックスと、チェックボックスの表示
        for($i = 1; $i <= 5; $i++){
            echo '<div>';
            echo '<span>テキスト',$i,'</span>';
            echo '<span><input type="text" id="input',$i,'"></span>';
            echo '<label for="cb',$i,'"><span><input type="checkbox" id="cb',$i,'" class="cb_use">使用する</span></label>';
            echo '</div>';
        }

        // 「登録」ボタンと「クリア」ボタン
        echo '<div>';
        echo '<input type="button" id="btnADD" value="登録" onclick="SetData()">';
        echo '<input type="button" id="btnClear" value="クリア" onclick="TextboxClear()">';
        echo '</div>';

    }
    
    // エスケープ処理をメソッド化
    function h($str)
    {
        return htmlspecialchars($str);
    }

?>