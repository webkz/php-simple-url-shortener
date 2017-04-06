<?php
header('Content-Type: text/html; charset=utf-8'); ?>
<!DOCTYPE html>
<html>
<title>URL сокращатель</title>
<link rel="stylesheet" href="https://bootswatch.com/cosmo/bootstrap.min.css">
<meta name="robots" content="noindex, nofollow"> 
<body>
              <h1 id="containers" align="center">Сокращатель ссылок</h1>
             
<div class="row">  
            
              <div class="col-lg-12"  style="margin-top:5%;background-color:#366ED1"  align="center"><br>
             <div class="col-md-6">  <div class="form-group has-info">
                 <form method="post" action="shorten.php" id="shortener">
                    <input value="Вставьте длинную ссылку сюда" class="form-control input-lg" id="longurl" type="text">
                     </div></div> <div class="col-md-2"> 
                    <input class="btn btn-warning btn-lg" type="submit" value="Сгенерировать"></div>
                </form> <br>
              </div> 
        </div>
     <input class="form-control input-lg"   id="myurl" type="text">
    </div> 
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script>
$(function () {
	$('#shortener').submit(function () {
		$.ajax({data: {longurl: $('#longurl').val()}, url: 'shorten.php', complete: function (XMLHttpRequest, textStatus) {
			$('#myurl').val(XMLHttpRequest.responseText);
		}});
		return false;
	});
});
</script>
</body>
</html>