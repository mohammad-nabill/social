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
    
    @if(auth()->user())<a href="logout" class="logout" >  تسجيل الخروج  </a>@endif
    @if(auth()->user())<span class="showname"> ● {{ auth()->user()->name }}</span>@endif
    
   
</div>

<!------------------------------ end nav -------------------------------------->


<!--------------------------------------------table-------------------------------------->
<span style="position:fixed;top:100px;left:45%;color:blue;font-size:30px;" >{{session()->get('success')}}  </span>

<form action=""  class="form2" method="post">

  
<div class="dataf">
   <label  class="label3">  النوع  </label></br>
   
   <select class="select" required name="type">
    <option value="" disapled selected >اختر نوع</option>
    <option value="٥٣ جرام ساده">  ٥٣ جرام ساده  </option>
    <option value="٥٣ جرام ١ فتلة">   ٥٣ جرام ١ فتلة  </option>
    <option value="٥٣ جرام  ٣ فتلة">    ٥٣ جرام  ٣ فتلة </option>
    <option value="٥٣ جرام مخلوط">    ٥٣ جرام مخلوط    </option>
    <option value="٥٨ جرام ساده">   ٥٨ جرام ساده </option>
    <option value="٥٨ جرام ١ فتله">   ٥٨ جرام ١ فتله   </option>
    <option value="٦٥ جرام ساده">   ٦٥ جرام ساده </option>
    <option value="٦٥ جرام ١ فتله">    ٦٥ جرام ١ فتله </option>
   </select >
</div>
   


<div class="dataf">
   <label  class="label2">  الي البياض  </label></br><label  class="label2">   متر    </label>
   <input  type="text" placeholder="الي البياض" pattern="[1-9.0-9]{1,}"  required  name="to"  class="textbox" >
</div>

<div class="dataf">
   <label  class="label2">  رقم الاذن     </label></br>
   <input  type="text" placeholder="رقم الاذن"  pattern="[0-9no]{2,}" required  name="num1" class="textbox" >
</div>



<div class="dataf">
   <label  class="label2">  مستلم في البياض   </label></br><label  class="label2">   متر    </label>
   <input  type="text" placeholder="مستلم"  pattern="[1-9.0-9]{1,}" required  name="there" class="textbox" >
</div>

<div class="dataf">
   <label  class="label2">  رقم المستند   </label></br>
   <input  type="text" placeholder="رقم المستند"  pattern="[0-9no]{2,}" required  name="num2"  class="textbox" >
</div>


<div class="dataf">
   <label  class="label2">  التاريخ   </label></br>
   <input  type="date" placeholder="التاريخ"  required  name="date"  class="textbox" >
</div>

<input type="hidden" name="_token" value="{{ csrf_token() }}"> 



<div class="buttons">
<button type="reset" class="buttonadd"  >  تفريغ الخانات </button>
<button type="submit" class="buttonadd"  >  اضافة </button>
</div>

</form>








<!--------------------------------------------end of table-------------------------------------->





<script src="site.js" > </script>


</body>
</html>