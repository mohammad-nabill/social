<!DOCTYPE html>

<html lang="en" >

<head>

<title>البدوي ميديكال</title>

<meta charset="UTF-8" >



<link href="{{ asset('../resources/css/site.css') }}" rel="stylesheet">



<style>
html{height:100%}


</style>

</head>

<body class="bo" >

  
    <!-----------------------------Nav bar----------------------------------->

<div class="nav">

<span class="font">Welcome</span>
<span style="margin-left:10px;font-size:25px;color:blue;user-select:none;"> Today is : {{ \Carbon\Carbon::now()->format('d/m/Y') }}</span>  
   
</div>

<!------------------------------ end nav -------------------------------------->






{!! Form::open(['url' => 'social/login' , 'class'=>'form1']) !!}

<div>{!! Form::label('email : ','',['class'=>'label']) !!}<br>

{!! Form::text('email',old('email'),['class'=>'input']) !!} <span style='color:red;'>{!! $errors->first('email') !!}
{{ session()->get('error') }}</span></div><br>

<div>{!! Form::label('password : ','',['class'=>'label']) !!}<br>

{!! Form::password('password',['class'=>'input']) !!} <span style='color:red'>{!! $errors->first('password') !!}</span></div><br> 

<div class="div"><input type="checkbox" name="remember" value="1">
 {!! Form::label('remember me') !!}</div><br>
 
 
 
{!! Form::submit('confirm',['class'=>'submit']) !!} <a href="forgot_password">forgot password ?</a><br><br>
Dont have an email ? <a href="register">Register Now</a>

{!! Form::close() !!}







<script src="site.js" ></script>


</body>
</html>
