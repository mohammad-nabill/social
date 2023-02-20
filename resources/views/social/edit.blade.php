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
  <a href="setting" class="link2" > &#9881; setting</a>
  <a href="home" class="home">Home</a>
  <a href="myinfo"><span style="color:#86ff01;float:left;font-size:30px;margin-left:20px;"> ● {{ auth()->user()->fname }} </span></a>
  
  </div>



<!----------------------------------------------------------------------------------->

@foreach($post as $v)


<hr style="height:5px;background-color:gray;margin-top:40px;">

<form action="myinfo" style="display:inline">
<button class="prof_button">
  
<div style="">
<input hidden name="id" value="{{  $v->author->id }}">

<img src="../pics/{{ $v->author->pic }}" style="width: 50px;height:50px;border-radius:60%;">
<span style="font-size:20px;font-weight:bold;position:absolute;">{{ auth()->user()->fname }} {{ auth()->user()->lname }}</span>



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

<form action="editpost" method="post" enctype="multipart/form-data" >
<div style="width:50%;">
  <textarea style="width: 50%;height:100px;overflow:auto;" name="subject" >{{ $v->subject }}</textarea><br>
  </div> <br>
  
 
  

</div>
@if($v->pic)
<img src="../pics/{{ $v->pic }}" style="width:50%;"><br>
@endif

uplaod/change post photo : <input type="file" name="file" > 

@if($v->pic)
or <input type="checkbox" name="deletePhoto"> delete current photo  
@endif

<br><br>

<input type="submit" value="modify" style="margin-left:10%;" > <span style="color:red"> {{session()->get('errore') }} </span>
<input hidden name="_token" value="{{ csrf_token() }}">
<input hidden name="id" value="{{ $v->id }}"> 
</form>

@endforeach
</div>



<!----------------------------- side bar ------------------------------------->

<div style="position:fixed;top:35px;right:0px; width:25%;height:100%;background-color:gray; ">

@foreach (auth()->user()->all() as $user) 
<form action="myinfo">
  <input hidden name="id" value="{{ $user->id }}">
 @if (Cache::has('online-'.$user->id) )

<div style="">
<button class="prof_button"><img src="../pics/{{ $user->pic }}" style="width: 50px;height:50px;border-radius:60%;">
<span style="font-size:20px;font-weight:bold;position:absolute;">{{ $user->fname }} {{ $user->lname }} 
<span style="color:#86ff01;">●</span></span></button>
</div> 
<hr>

@else
<button class="prof_button"><img src="../pics/{{ $user->pic }}" style="width: 50px;height:50px;border-radius:60%;">
<span style="font-size:20px;font-weight:bold;position:absolute;">{{ $user->fname }} {{ $user->lname }}</span></button>
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