<!DOCTYPE html>

<html lang="en" >

<head>

<title>البدوي ميديكال</title>

<meta charset="UTF-8" >


<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="http://localhost/laravel-system/resources/css/site.css" rel="stylesheet">

<style>



</style>

</head>

<body class="bo">

  
    <!-----------------------------Nav bar----------------------------------->

<div class="nav">

    <a href="home" class="p">الــرئــيـسـيـــة</a>
    <a href="add" class="p" >  اضــــافـــة  </a>

    <span style="margin-left:25%;font-size:25px;color:blue;user-select:none;">{{ \Carbon\Carbon::now()->format('d/m/Y') }}</span>
    
    @if(auth()->user())<a href="logout" class="logout" >  تسجيل الخروج  </a>@endif
    @if(auth()->user())<span class="showname"> ● {{ auth()->user()->name }}</span>@endif
    
   
</div>

<!------------------------------ end nav -------------------------------------->


<!--------------------------------------------table-------------------------------------->


<table>
<tr><th>  التاريخ  </th><th>  الفرق  </th><th>  رقم المستند  </th><th>  في البياض  </th><th>  رقم الاذن  </th>
<th>  الي البياض  </th><th>  النوع  </th><th>  مسلسل  </th></tr>


{!! Form::open(['url'=>'delete']) !!} 
@foreach($c as $v)

<tr>
<td>{{ $v->date1 }}</td><td>{{ $v->sub1 }}</td><td>{{ $v->num2 }}</td><td>{{ $v->there }}</td>
<td>{{ $v->num1 }}</td><td>{{ $v->to_white }}</td><td>{{ $v->type }}</td><td>{{ $v->id }}</td>

<td> {!! Form::checkbox('name[]' ,$v->id) !!} </td>

</tr>

@endforeach

</table>
{!! Form::submit('delete selected items',['class'=>'delete']) !!}
 
{!! Form::close() !!}










<!--------------------------------------------end of table-------------------------------------->





<script src="site.js" > </script>


</body>
</html>