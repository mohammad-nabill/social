<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
   
    <title>Home</title>

    
    <link href="{{ asset('../resources/css/site.css') }}" rel="stylesheet">
<style>

  </style>
   
</head>
<body>
  <!-----------------------------Nav bar----------------------------------->

<div class="nav">

<span class="font" >Welcome</span>
<span style="margin-left:10px;font-size:25px;color:blue;user-select:none;"> Today is : {{ \Carbon\Carbon::now()->format('D d/m/Y') }}</span>  

<a href="logout" style="float:left;text-decoration:none;font-size:30px;margin-left:20px;">logout</a>
<a href="home" style="float:left;text-decoration:none;font-size:30px;margin-left:20px;">Home</a>
<a href="myinfo"><span style="color:#86ff01;float:left;font-size:30px;margin-left:20px;"> ● {{ auth()->user()->name }}</span></a>

</div>



<!----------------------------------------------------------------------------------->

@foreach($posts as $v)


<hr style="height:5px;background-color:gray;margin-top:40px;">

<form action="myinfo">
<button class="prof_button">
  
<div style="">
<input hidden name="id" value="{{  $v->author->id }}">

<img src="../pics/{{ $v->author->pic }}" style="width: 50px;height:50px;border-radius:60%;">
<span style="font-size:20px;font-weight:bold;position:absolute;">{{ $v->author->name }}</span>



<!-- to echo date of post -->

@if($v->created_at->isToday() )               

@if( \Carbon\Carbon::now()->format('H') - $v->created_at->format('H') == 0 )
<span style="font-size:15px;"> {{ \Carbon\Carbon::now()->format('i') - $v->created_at->format('i') }} mins ago</span><br>
@else
<span style="font-size:15px;"> {{ \Carbon\Carbon::now()->format('H') - $v->created_at->format('H') }} hours ago</span><br>
@endif

@elseif( $v->created_at->isYesterday() )
<span style="font-size:15px;"> yesterday at {{ $v->created_at->format('h A') }}</span><br>
@else
<span style="font-size:15px;">  {{ $v->created_at->format('d-M h A') }} </span><br>
@endif

<!-- to echo date of post -->

</div></button></form>

<div style="margin-top:10px">

<div style="font-size:40px;width:50%;color:red">
  {{ $v->subject }}
  </div> <br>
  
  

</div>
@if($v->pic)
<img src="../pics/{{ $v->pic }}" style="width:50%;"><br>
@endif

<span>-----------------------------------------------------------------------------</span><br>

<button class='comment_button' onclick="show({{$v->id}})">{{ $v->comments_count }} comments</button><br>

<span>-----------------------------------------------------------------------------</span><br>
<!--<a id='position{{ $v->id }}'></a>-->

<div id='comment_container{{$v->id}}' style="display:none">
@foreach($v->comments as $comment)

<form action="myinfo" style="display:inline">
<button class="prof_button">
  <img src="../pics/{{$comment->author_name->pic}}" style="width: 30px;height:30px;border-radius:60%;">
</button>
<input hidden name="id" value="{{  $comment->author_name->id }}">
</form>

<div style="background-color:gray;width:20%;border-radius:5px;display:inline-table;padding-left:10px;">

<span style="font-size:20px;font-weight:bold;">{{$comment->author_name->name}}</span><br>
{{$comment->comment}} <br>

@if($comment->pic)
<img src="../pics/{{$comment->pic}}" style="width: 150px;height:200px;border-radius:10%;">
@endif

</div> {{$comment->created_at->format('d-M  h A')}} <br><br>

@endforeach
</div>


<img src="../pics/{{ auth()->user()->pic }}" style="width: 30px;height:30px;border-radius:60%;">
<span style="font-size:15px;font-weight:bold;">{{ auth()->user()->name }} : </span>



<form action='add_comment' style='display:inline-block' onsubmit='return check( {{ $v->id }} )'  enctype="multipart/form-data" method='post'>
<input name='comment' id='comment{{$v->id}}' >
<input type='file' name='pic' id='pic{{$v->id}}' >
<input hidden name='post_id' value={{ $v->id }} >
<input hidden name='author_id' value={{ auth()->user()->id }} >
<input type='submit' value='add'>
<input hidden name="_token" value="{{ csrf_token() }}">
@if( session('post') == $v->id  ) <span style="color:red">{{ $errors->first('comment','write something or upload photo') }}</span>  @endif

</form>



@endforeach


<!----------------------------- side bar ------------------------------------->

<div style="position:fixed;top:35px;right:0px; width:25%;height:100%;background-color:gray; ">

@foreach (auth()->user()->all() as $user) 
<form action="myinfo">
  <input hidden name="id" value="{{ $user->id }}">
 @if (Cache::has('online-'.$user->id) )

<div style="">
<button class="prof_button"><img src="../pics/{{ $user->pic }}" style="width: 50px;height:50px;border-radius:60%;">
<span style="font-size:20px;font-weight:bold;position:absolute;">{{ $user->name }} 
<span style="color:#86ff01;">●</span></span></button>
</div> 
<hr>

@else
<button class="prof_button"><img src="../pics/{{ $user->pic }}" style="width: 50px;height:50px;border-radius:60%;">
<span style="font-size:20px;font-weight:bold;position:absolute;">{{ $user->name }} </span></button>
<hr>

  
@endif
</form>
@endforeach

</div>

<!---------------------------------------------------------------->



<div id="alert" style="height: 100%;width: 100%;position:fixed;top:0;left: 0;display:none;">
<p style="background-color:#ff0000bd;text-align:center;margin-left:35%;
margin-top:15%;width:20%;height:10%;padding-top:5%;user-select:none;">
Comment cannot be embty</p>
</div>

<!---------------------------------------------------------------->

<script>
   
function check($id){
  
  var v = document.getElementById('comment'+$id).value;
  var v2 = document.getElementById("pic"+$id).value;
  var v3 = document.getElementById("alert");
  var position = $id ;
if( !v && !v2 ){
  
  
 
  
  v3.style.display="block";

  setTimeout(() => {
  v3.style.display="none";
  }, 3000);
  
  return false;
  
  
 
}else{
  
  
 localStorage.setItem('id', position );
       
}

}

///////////////////////////////////////////////////////////

function show($id){
  document.getElementById('comment_container'+$id).style.display='block';
}

///////////////////////////////////////////////////////////

function test(){
  
  document.getElementById('test').scrollIntoView({
            behavior: 'auto',
            block: 'center',
            inline: 'center'
        });
}

///////////////////////////////////////////////////////////

document.addEventListener("DOMContentLoaded", function(event) { 
            var id = localStorage.getItem('id');
            var scrollpos = 'comment'+id;
            if (id) {
              
              show(id);

            document.getElementById(scrollpos).scrollIntoView({
            behavior: 'auto',
            block: 'center',
            inline: 'center'
            });

        
              localStorage.setItem('id','');
              
            }
        });





</script>


</body>
</html>