// 登録内容をクリアボタンで復元するために、一番外側のスコープで宣言している
let data = [];

function SetData()
{
    // POST用の連想配列を用意
    let postData = {};
    postData["proc"] = "setdata";

    // テキストボックスの入力値とチェックボックスの状態をPOSTデータに設定
    data = [];
    let input_text = null;
    let input_flag = null;
    let c = 0;
    for(let i = 1; i <= 5; i++){

        if($(`#input${i}`).val() !== ''){
            
            input_text = $(`#input${i}`).val();

            if($(`#cb${i}`).prop('checked'))
            {
                input_flag = 1;
            }
            else
            {
                input_flag = 0;
            }

            data.push({'text' : input_text, 'flag' : input_flag});

            c++;
        }
    }

    postData['data'] = {};
    postData['data'] = data;
    //postData['count'] = c;

    // 非同期処理の実行
    $.ajax({

        url : "db_connect.php",
        type: "POST",
        data: postData,
        dataType: "json",

    })

    // 通信成功時
    .done(function(data){

        // データをJSON形式に変換
        let data_stringify = JSON.stringify(data);
        let data_json = JSON.parse(data_stringify);

            // 登録・更新件数をそれぞれ計算しようとしたが断念。affected_rows の値だけでは無理だった。
            // let inserted = 0;
            // let updated = 0;
            // if(data_json['rows'] % 2 == 1){
            //     inserted = data_json['count'] * 2 - data_json['affected_rows'];
            //     updated = (data_json['affected_rows'] - inserted) / 2;
            // }
            // alert('入力：' + data_json['count'] + ' 結果：' + data_json['affected_rows']);
            // alert('【登録：'+ inserted + ' 件】　【更新：'+ updated +' 件】');

        // HTMLに反映
        if($('#btnADD').val() === '登録')
        {
            $('#btnADD').val('更新');
            alert('登録が完了しました');
        }
        else if($('#btnADD').val() === '更新')
        {
            alert('更新が完了しました');
        }

    })

    // 通信失敗時
    .fail(function(data){

        alert("接続エラー");
    
    });
}

function TextboxClear()
{
    // 検索欄は空欄にする
    $('#search_text').val('');

    
    if(data.length) // ページを開いてから登録・更新を１回でもしていたら、最後に更新した時の状態にする
    {

        $('#search_text').val('');

        let k = 1;
        data.forEach(function(rows){    // function とか使ってるけどjsでの書き方はこうらしい。一般的な foreach(data as rows){～} とやってることは一緒

            $(`#input${k}`).val(rows['text']);

            if(rows['flag'] == 1)
            {
                $(`#cb${k}`).prop('checked', true);
            }
            else if(rows['flag'] == 0)
            {
                $(`#cb${k}`).prop('checked', false);
            }

            k++;
        });
    }
    else    // ページを開いてから登録・更新を１回もしていなかったら（検索しかしていないなど）、全ての欄をクリアする
    {
        $('#input1').val('');
        $('#input2').val('');
        $('#input3').val('');
        $('#input4').val('');
        $('#input5').val('');
        $('#cb1').prop('checked', false);
        $('#cb2').prop('checked', false);
        $('#cb3').prop('checked', false);
        $('#cb4').prop('checked', false);
        $('#cb5').prop('checked', false);
    }
}