<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
   
    <title>chat</title>

    
    <link href="{{ asset('../resources/css/site.css') }}" rel="stylesheet">
    

<style>

  </style>
   
</head>
<body>


<!-----------------------------Nav bar----------------------------------->

<div class="nav">


<a href="logout" class="link" >logout</a>
<a href="setting" class="link2" > &#9881; setting</a>
<a href="home" class="home">Home</a>
<a href="myinfo"><span style="color:#86ff01;float:left;font-size:30px;margin-left:20px;"> ● {{ auth()->user()->fname }}</span></a>


</div>
<!---------------------------------------------------------------------------->


@foreach($data as $v)


@if( auth()->user()->id == $v->user_info->id )
<div style="background-color:blue;width:20%;border-radius:5px;display:inline-table;padding-left:10px;color:white;margin-top:5%;">
@else
 <img src="../pics/{{ $v->user_info->pic }}" style="width: 30px;height:30px;border-radius:60%;">
<div style="background-color:gray;width:20%;border-radius:5px;display:inline-table;padding-left:10px;margin-top:5%;">
@endif
 {{ $v->text }}

</div><br>
@if($v->pic)
<img src="../pics/{{$v->pic}}" style="width: 150px;height:200px;border-radius:10%;"><br>
@endif

@endforeach

<form action='send' style='display:inline-block;margin-top:5%;'  enctype="multipart/form-data" method='post'>
<input name='text'  > 
<input type='file' name='pic'  > 
<input type='submit' value='send'>
{{ $errors->first('comment') }}
{{ $errors->first('pic' ) }}
<input hidden name="_token" value="{{ csrf_token() }}">
<input hidden name="friend" value="{{ request('friend') }}">

</form>

</body>
</html>