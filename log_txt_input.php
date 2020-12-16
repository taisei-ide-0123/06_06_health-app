<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>体重管理アプリ</title>
</head>

<body>
  <form action="log_txt_create.php" method="post">
    <div class="legend">
      <div class="date">
        日付 <input type="date" name="deadline">
      </div>
      <div class="weight">
        体重 <input type="text" name="log">
      </div>
      <div class="log">
        <button>記録する</button>
      </div>
      <div class="graph">
        <a href="log_txt_read.php">毎日の記録を見る</a>
      </div>
    </div>
  </form>
  <style>
    body {
      display: flex;
      justify-content: center;
    }

    .legend {
      height: 300px;
      width: 250px;
      margin: 0;
      border: solid;
      border-color: gray;
      border-radius: 8px;
    }

    .graph,
    .date,
    .weight,
    .log {
      height: 25%;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .weight,
    .log,
    .graph {
      border-top: 1px solid;
      border-color: lightgray;
    }

    input {
      height: 30px;
      width: 170px;
    }

    button {
      cursor: pointer;
      font-weight: bold;
      padding: 10px 30px;
      background-color: #ff0461;
      color: #fff;
      border-style: none;
      box-shadow: 0 5px 0 rgba(0, 0, 0, 0.2);
    }
  </style>
</body>

</html>