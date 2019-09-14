<html>

<head>
    <meta charset="utf8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Рубероид в Одессе</title>
</head>
<body>
<h3 align ="center"> Почем в Одессе рубероид?</h3>

<?php

date_default_timezone_set('Greenwich');
$date = strtotime('-1 day');
$json = file_get_contents('https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange?date=' . date('Ymd', $date) . '&json');
$courses = json_decode($json, true);


$eur = 0;
$usd = 0;
foreach($courses as $cours){
    if($cours['cc']=='USD'){
        $usd = $cours['rate'];
    }
    if($cours['cc']=='EUR'){
        $eur = $cours['rate'];
    }
}


if(isset($_POST['submit'])){
    if((is_numeric($_POST['zpraba'])
            && is_numeric($_POST['pplenka'])
            && is_numeric($_POST['bitum'])
            && is_numeric($_POST['kkarton'])
            && is_numeric($_POST['pesok'])) == true){
                $cenaraba = $_POST['zpraba'] / (22*8) / 3.5;
                $pplenka = $_POST['pplenka'] * $usd;
                $bitum = $_POST['bitum'] * $eur;
                $kkarton = $_POST['kkarton'] * $usd;
                $pesok = $_POST['pesok'];
    }
    else echo '<br><p align="center">Введите <font color="red"> числовые</font> значения. (Например: 42.42 )</p>';
}

$beznacenki = $cenaraba + $pplenka + $bitum + $kkarton + $pesok;
$result = round($beznacenki * 1.2, 2);

?>
<form align ="center" method="post" action="index.php">
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

    <input name="submit" type=submit value="Расчитать">
</form>

<h4 align ="center">
    Стоимость рубероида:
    <?php echo $result;?> грн.
</h4>

</body>
</html>