<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
   
    <title>edit post</title>

    
    <link href="{{ asset('../resources/css/site.css') }}" rel="stylesheet">
    

<style>

  </style>
   
</head>
<body>
  <!-----------------------------Nav bar----------------------------------->


  <div class="nav">
  
  <a href="logout" class="link" >logout</a>
  <a href="home" class="home">Home</a>
  <a href="myinfo"><span style="color:#86ff01;float:left;font-size:30px;margin-left:20px;"> ● {{ auth()->user()->fname }}</span></a>
  
  </div>



<!----------------------------------------------------------------------------------->

<div style="margin-top:5%;" >
@foreach( $data as $v )

<img src="../pics/{{ $v->pic }}" class="setting_img" > <br><br>
first name : <span class="user_info"> {{ $v->fname }} </span>  <br><br>
last name : <span class="user_info"> {{ $v->lname }}  </span> <br><br>
email : <span class="user_info"> {{ $v->email }} </span> <br><br>
birth date : <span class="user_info"> {{ $v->birthDate }} </span> <br><br>
joined : <span class="user_info"> {{ $v->created_at->format('d-m-Y') }} </span> <br><br>

<button onclick="show('form')" class="sub_button">Edit</button>

<!-----------------------------form to edit ----------------------------------------->

{!! Form::open(['url' => 'social/editprofile' , 'class'=>'editProfileForm' , 'files'=>true , 'id'=>'form']) !!}

{!! Form::label('first name : ' , '',['class'=>'label']) !!}<br>

{!! Form::text('fname',$v->fname,['class'=>'input']) !!} <span style='color:red;'>{!! $errors->first('fname') !!}
</span><br><br>

{!! Form::label('last name : ' , '',['class'=>'label']) !!}<br>

{!! Form::text('lname',$v->lname,['class'=>'input']) !!} <span style='color:red;'>{!! $errors->first('lname') !!}
</span><br><br>

{!! Form::label('birth date : ' , '',['class'=>'label']) !!}<br>

{!! Form::date('birthDate',$v->birthDate,['class'=>'input']) !!} <span style='color:red;'>{!! $errors->first('birthDate') !!}
</span><br><br>

{!! Form::label('email : ', '',['class'=>'label']) !!}<br>

{!! Form::text('email',$v->email,['class'=>'input']) !!} <span style='color:red;'>{!! $errors->first('email') !!}
</span><br><br>

{!! Form::hidden('id',$v->id,['class'=>'input']) !!}

{!! Form::label('change profile photo : ', '',['class'=>'label']) !!}
{!! Form::file('pic',['class'=>'input']) !!} <span style='color:red'>{!! $errors->first('pic','choose an image') !!}</span><br><br>


{!! Form::submit('Confirm',['class'=>'sub_button']) !!}

<button class="sub_button2" type="button" onclick="hide('form')">Cancel</button>

{!! Form::close() !!}

<!---------------------------------------------------------------------------------------------->

@endforeach


</div>


<script>

function show($id){
var e = document.getElementById($id);
e.style.display = 'block' ;
 }

 function hide($id){
var e = document.getElementById($id);
e.style.display = 'none' ;
 }

 var e = document.getElementById('form');

 @if( $errors->any() )
 e.style.display = 'block' ;
 @else
 e.style.display = 'none' ;
 @endif

</script>

</body>
</html>