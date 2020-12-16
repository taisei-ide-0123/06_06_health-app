<?php
// 出力用の空の文字列
$str = '';
// ファイルを開く(読み取り専用)
$file = fopen('data/log.csv', 'r');
// ファイルをロック
flock($file, LOCK_EX);
// fgets()で1行ずつ取得→$lineに格納
if ($file) {
  while ($line = fgets($file)) {
    $str .= "<tr><td>{$line}</td></tr>"; // 取得したデータを$strに入れる
  }
}
// ロック解除
flock($file, LOCK_UN);
// ファイル閉じる
fclose($file);

// ($strに全部の情報が入る!)
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.min.js"></script>
  <title>体重管理アプリ</title>
</head>

<body>
  <fieldset>
    <legend>体重記録</legend>
    <a href="log_txt_input.php">入力画面</a>
    <table>
      <thead>
        <tr>
          <th><?= $str ?></th>
        </tr>
      </thead>
      <tbody>
        <div style="width: 100%; height: 100%;">
          <canvas id="myChart" style="width: 100%; height: auto;"></canvas>
        </div>
      </tbody>
    </table>
  </fieldset>
  <script>
    // CSVから２次元配列に変換
    function csv2Array(str) {
      var csvData = [];
      var lines = str.split("\n");
      for (var i = 0; i < lines.length; ++i) {
        var cells = lines[i].split(",");
        csvData.push(cells);
      }
      return csvData;
    }

    function drawLineChart(data) {
      // chart.jsのdataset用の配列を用意
      var tmpLabels = [],
        tmpData1 = [],
        tmpData2 = [];
      for (var row in data) {
        tmpLabels.push(data[row][0])
        tmpData1.push(data[row][1])
        tmpData2.push(data[row][2])
      };

      // chart.jsで描画
      var ctx = document.getElementById("myChart").getContext("2d");
      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: tmpLabels,
          datasets: [{
            label: "体重",
            data: tmpData1,
            backgroundColor: "rgba(255,0,0,0.4)"
          }]
        }
      });
    }

    function main() {
      // ajaxでCSVファイルをロード
      var req = new XMLHttpRequest();
      var filePath = 'data/log.csv';
      req.open("GET", filePath, true);
      req.onload = function() {
        // CSVデータ変換の呼び出し
        data = csv2Array(req.responseText);
        // chart.jsデータ準備、chart.js描画の呼び出し
        drawLineChart(data);
      }
      req.send(null);
    }

    main();
  </script>
</body>

</html>