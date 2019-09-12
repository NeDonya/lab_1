<html>

<head>
    <meta charset="utf8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Рубероид в Одессе</title>
</head>
<body>
<h1> Почем в Одессе рубероид?</h1>
<form method="post" action="index.php"><br><br>
    Введите зарплату рабочего:<br>
    <input name="zpraba" type="text" maxlength="10" size="5" value="" /> UAH
    <br><br>
    Введите цену полимерной плёнки:<br>
    <input name="pplenka" type="text" maxlength="10" size="5" value="" /> USD
    <br><br>
    Введите цену битума:<br>
    <input name="bitum" type="text" maxlength="10" size="5" value="" /> EUR
    <br><br>
    Введите цену кровельного картона:<br>
    <input name="kkarton" type="text" maxlength="10" size="5" value="" /> USD
    <br><br>
    Введите цену песка:<br>
    <input name="pesok" type="text" maxlength="10" size="5" value="" /> UAH
    <br><br>

    <input type=submit value="Расчитать">
</form>

<?php

$date = date('Ymd') - 1;
$json = file_get_contents('https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange?date='.$date.'&json');
$courses = json_decode($json, true);
$eur = 0;
$usd = 0;
foreach($courses as $cours){
    if($cours['cc']=='EUR') {
        $eur = $cours['rate'];
    }
}
foreach($courses as $coursusd){
    if($coursusd['cc']=='USD') {
        $usd = $coursusd['rate'];
    }
}

$cenaraba = $_POST['zpraba'] / (22*8) / 3.5;
$pplenka = $_POST['pplenka'] * $usd;
$bitum = $_POST['bitum'] * $eur;
$kkarton = $_POST['kkarton'] * $usd;
$pesok = $_POST['pesok'];

$beznacenki = $cenaraba + $pplenka + $bitum + $kkarton + $pesok;

$result = ($beznacenki) + ($beznacenki * 0.2);

echo round($result, 2) . ' грн.';


?>



</body>
</html>

