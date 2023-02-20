<!DOCTYPE html>

<html lang="en" >

<head>

<title>البدوي ميديكال</title>

<meta charset="UTF-8" >


<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="{{ asset('../resources/css/site.css') }}" rel="stylesheet">



<style>



</style>

</head>

<body class="bo" >

  
    <!-----------------------------Nav bar----------------------------------->

<div class="nav">

<span class="font">Welcome</span>
<span style="margin-left:10px;font-size:25px;color:blue;user-select:none;"> Today is : {{ \Carbon\Carbon::now()->format('d/m/Y') }}</span>  
   
</div>

<!------------------------------ end nav -------------------------------------->






{!! Form::open(['url' => 'social/register' , 'class'=>'form1' , 'files'=>true]) !!}

{!! Form::label('first name : ' , '',['class'=>'label']) !!}<br>

{!! Form::text('fname',old('fname'),['class'=>'input']) !!} <span style='color:red;'>{!! $errors->first('fname') !!}
{{ session()->get('err') }}</span><br>

{!! Form::label('last name : ' , '',['class'=>'label']) !!}<br>

{!! Form::text('lname',old('lname'),['class'=>'input']) !!} <span style='color:red;'>{!! $errors->first('lname') !!}
{{ session()->get('err') }}</span><br>

{!! Form::label('birth date : ' , '',['class'=>'label']) !!}<br>

{!! Form::date('birthDate',old('birthDate'),['class'=>'input']) !!} <span style='color:red;'>{!! $errors->first('birthDate') !!}
{{ session()->get('err') }}</span><br>

{!! Form::label('email : ', '',['class'=>'label']) !!}<br>

{!! Form::text('email',old('email'),['class'=>'input']) !!} <span style='color:red;'>{!! $errors->first('email') !!}
{{ session()->get('err') }}</span><br>

{!! Form::label('password : ', '',['class'=>'label']) !!}<br>

{!! Form::password('password',['class'=>'input']) !!} <span style='color:red'>{!! $errors->first('password') !!}</span><br> 

{!! Form::label('confirm passoword : ', '',['class'=>'label']) !!}<br>

{!! Form::password('password_confirmation',['class'=>'input']) !!} <span style='color:red'>{!! $errors->first('password_confirmation') !!}</span><br><br>


{!! Form::label('select photo : ', '',['class'=>'label']) !!}
{!! Form::file('pic',['class'=>'input']) !!} <span style='color:red'>{!! $errors->first('pic','choose an image') !!}</span><br><br>

{!! Form::submit('confirm',['class'=>'submit']) !!} <a href="login"> already have an email </a> 

{!! Form::close() !!}







<script src="site.js" ></script>


</body>
</html>
