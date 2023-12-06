<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

<style>
body
{
    margin:0;
    padding:0;
    font-family:sans-serif;
}
.card
{
    width:250px;
    margin: 20px auto;
    border: 3px solid green; // #e84444;
    position: relative;
    padding-top: 10px;
    padding-bottom: 10px;
    border-radius: 10px;
    opacity: 0.7;
    transition: all 0.5s linear;
}
.card h3
{
    text-align: center;
    margin-top: 0;
    margin-bottom: 10px;
    color: #e84444;
}
.card img
{
    width: 100%;
}
.card p
{
    text-align: center;
    padding-left: 1px;
    padding-right: 1px;
    line-height: 0px;
    color: #666;
    transition: all 0.5s linear;
    font-size:120px;
}

.card:hover p
{
    color: black;
}
.button
{
    width:250px;
    margin: 20px auto;
    text-align: center;
}
.button a
{
    font-size: 16px;
    border-radius: 10px;
    background: #e84444;
    color: white;
    padding: 5px;
    border: 2px solid #e84444;
    outline: 0;
}
</style>
</head>
<body>

<script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

<?php
$filePath = "qDat.txt"; 
$lines = count(file($filePath));  
$fileServe = "qServe.txt";
$slines = count(file($fileServe));
$wait = $lines - $slines;
?>

<!SHOW THE QUEUE CARD>
<div class="card">

<!SHOW THE MNRE LOGO ON THE TOP LEFT CORNER>
<img src="mnre.png" style='width:50px;height:55px;padding-left: 10px'></img>
  <h3>คิวที่</h3>
	
<!SHOW THE QUEUE NUMBER, EQUAL TO THE NUMBER OF LINES IN THE QUEUE DATA FILE>	
  <p id='q'><?php echo $lines ?>

</p>

<center>

<!SHOW THE WAITING QUEUE>
<p id='w'
style='text-align:center;
    padding-left: 1px;
    padding-right: 1px;
    line-height: 2px;
    color: #666;
    transition: all 0.5s linear;
    font-size:20px;'
>รออีก <?php echo $wait ?> คิว</p>


<br>ศูนย์ราชการสะดวก สป.ทส.<br>
<p id='date'
style='text-align:center;
    padding-left: 1px;
    padding-right: 1px;
    line-height: 2px;
    color: #666;
    transition: all 0.5s linear;
    font-size:14px;'

></p>
</center>
</div>
<div class="button">
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<!--
  	<input type="submit" name="update" value="สร้างบัตรคิว" 
		style="width:100px;
			background-color:DodgerBlue;	
			cursor: pointer;
			border:none;
 			color: white;
			padding: 12px 16px;
			font-size: 16px;"
	><br><br>
	-->
	<a id="download" href="#">บันทึกบัตรคิว</a>

</form>
</div>

</body>
<script>

const d = new Date();
const day = d.getDate();
const m = d.getMonth();
const hh = d.getHours();
const mm = d.getMinutes();
const sec = d.getSeconds();
var min = '';
if(mm < 10){min = '0'+ mm;}
else{min = mm;};

const month = ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม','พฤศจิกายน','ธันวาคม'];
 
const y = d.getFullYear() + 543;
document.getElementById('date').innerHTML=day + ' ' + month[m] + ' ' + y + ' ' + hh + ':' + min + ' น.';



function download(canvas, filename) {
  const data = canvas.toDataURL("image/png;base64");
  const donwloadLink = document.querySelector("#download");
  donwloadLink.download = filename;
  donwloadLink.href = data;
}

html2canvas(document.querySelector(".card")).then((canvas) => {
  // document.body.appendChild(canvas);
  download(canvas, "queqe"+<?php echo $lines ?>);
});
</script>

<!UPDATE THE DATABASE>
<?php
$data='1'.PHP_EOL;
	$filecontent=file_get_contents('qDat.txt');
	$pos=strpos($filecontent, $data) -0;
	$filecontent=substr($filecontent, 0, $pos)."\r\n".$data;
	file_put_contents("qDat.txt", $filecontent);	
?>

</html>
