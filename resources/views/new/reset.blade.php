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



<form action="../../reset/password"  style="" class="form1"  method="post">

<div  class="b"><label class="l">email </label><br>
<input class="a" type="text" name="email" value="{{ request('email') }}">{{ $errors->first('email') }}</div><br>


<div  class="b"><label class="l">password </label><br>
<input class="a" type="password" name="password" >
<span style="color:red">{{ $errors->first('password') }}</span></div><br>

<div  class="b"><label class="l">confirm password </label><br>
<input class="a" type="password" name="password confirmation">
<span style="color:red">{{ $errors->first('password confirmation') }}</span></div><br>

<input hidden name="token" value="{{ $token }}">

<input type="hidden" name="_token" value="{{ csrf_token() }}">

<button style="margin-left:40%;cursor:pointer;" type="submit">confirm</button>




</form>








<!---------------------------------------------------------------------------------->





<script src="site.js" > </script>


</body>
</html>