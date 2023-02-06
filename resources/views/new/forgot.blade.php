<!DOCTYPE html>

<html lang="en" >

<head>

<title>البدوي ميديكال</title>

<meta charset="UTF-8" >


<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="http://localhost/laravel-system/resources/css/site.css" rel="stylesheet">

<style>

.b{margin-left:20px;}
.l{margin-left:5px;}


</style>

</head>

<body class="bo">

  
    <!-----------------------------Nav bar----------------------------------->

<div class="nav">

    <a href="home" class="p">الــرئــيـسـيـــة</a>
    <a href="add" class="p" >  اضــــافـــة  </a>
   
   
</div>

<!------------------------------ end nav -------------------------------------->


<!--------------------------------------------table-------------------------------------->

<form action="forgot_password"  style="" class="form1"  method="post">

<div  class="b"><label class="l">email </label><br><input class="a" type="text" name="email">{{ $errors->first() }}</div><br>
{{session('status')}}<br>
<input type="hidden" name="_token" value="{{ csrf_token() }}">

<button type="submit">send verification code</button>

</form>








<!--------------------------------------------end of table-------------------------------------->





<script src="site.js" > </script>


</body>
</html>