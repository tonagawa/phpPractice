function OutputData()
{
    // ポスト用の連想配列を用意
    let postData = {};
    postData["proc"]       = "setdata";
    
    // 非同期処理の実行
    $.ajax({
        url : "db_connect.php",
        type: "POST",
        data: postData,
        dataType: "json",
    })
    
    // 通信成功時
    .done(function (data) {
        
        // データをJSON形式に変換
        let data_stringify = JSON.stringify(data);
        let data_json = JSON.parse(data_stringify);

        // HTMLに反映
        $('#input1').val(data_json['text']);
        $('#input2').val(data_json['text']);
        $('#input3').val(data_json['text']);
        $('#input4').val(data_json['text']);
        $('#input5').val(data_json['text']);
    })
    
    // 通信失敗時
    .fail(function (data) {
        alert("接続エラー");
    });
}

function SearchData()
{
    // ポスト用の連想配列を用意
    let postData = {};
    postData['proc'] = 'searchdata';
    postData['search_text'] = $('#search_text').val();
    
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

        // HTMLに反映
        $('#input1').val(data_json['text']);
        $('#input2').val(data_json['text']);
        $('#input3').val(data_json['text']);
        $('#input4').val(data_json['text']);
        $('#input5').val(data_json['text']);
    })
    
    // 通信失敗時
    .fail(function(data){
        alert("接続エラー");
    });
    
}

function TextboxClear()
{
    $('#search_text').val('');
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
