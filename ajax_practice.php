<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRACTICE</title>
    <script src="./js/jquery-3.6.0/jquery-3.6.0.js"></script>
    <script src="js/ajax_practice.js"></script>
</head>
<body>
    <header>
        <p><a href="../index.html">ホームメニューへ戻る</a></p>
    </header>
    <main>
        <p>検索ボックス<input type="text" id="search_text"><input type="button" value="検索" onclick="SearchData()"></p>
        <?php 
            for($i=1; $i<=5; $i++){
                echo '<div>';
                echo '<span>テキスト',$i,'</span>';
                echo '<span><input type="text" id="input',$i,'"></span>';
                echo '<label for="cb',$i,'"><span><input type="checkbox" id="cb',$i,'" class="cb_use">使用する</span></label>';
                echo '</div>';
            }
        ?>
        <div>
            <input type="button" value="登録" onclick="OutputData()">
            <input type="button" value="クリア" onclick="TextboxClear()">
        </div>
    </main>
    </body>
</html>