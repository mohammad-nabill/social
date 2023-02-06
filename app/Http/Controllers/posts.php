<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\post;
use App\Models\User;
use App\Models\comments;

use Hash;
use cache;

class posts extends Controller
{

function main(){
    $obj = new post;
    $posts = $obj->orderBy('created_at','desc')->withCount('comments')->get();

    $obj2 = new comments;
    $comments = $obj2->get();
    
    
    
return view('social/home',compact('posts','comments'));
    
}

//////////////////////////////////////////////////////

    function add(){

        $this->validate(request(),[
            'file'=>'image',
        ]);

        
        
        
        $data['author_id'] = auth()->user()->id;
        
        $data['subject']=request('subject');

        
        if(!$data['subject'] && !request('file') ){
            session()->flash('errore','post cannot be empty');
            return back();
        }
        
        if(request('file')){
        $pic=request()->file('file');
        $picName = time().".".$pic->extension();
        $data['pic'] = $picName;
        $pic->move('pics',$picName);
           
        }

        

        $obj = new post;
        $obj->create($data);
        return redirect('social/home');

        return $data;
        

    }


/////////////////////////////////////////////
function register(){

    $data = $this->validate(request(),[
        'name'=>'required | alpha',
        'email'=>'required | email |unique:users',
        'password'=>'required | confirmed | min:8',
        'pic'=>'required | image'

    ]);

    
    $obj = new User;
     $pic = request()->file('pic');
     $picName = time() . "." .$pic->extension();

     $data['pic'] = $picName;
     $data['password'] = Hash::make(request('password'));

     $tolog = $obj->create($data);
     
     $pic->move('pics',$picName);

     auth()->login($tolog);

     return redirect('social/home');
     
}
/////////////////////////////////////////////

function login(){

    $this->validate(request(),[
    'email'=>'required | email',
    'password'=>'required'
    ]);

    if(auth()->attempt(['email'=>request('email'),'password'=>request('password')])){
 
        \Cache::put('online-' . auth()->user()->id , 'yes' , 21600 );
        return redirect('social/home');

    }else{
        session()->flash('error','Wrong email or password');
        return back();
    }
}

//////////////////////////////////////////////////


function logout(){
\Cache::forget('online-'.auth()->user()->id);
auth()->logout();
return redirect('social/home');
}

///////////////////////////////////////////////////////////

function profile(){
    
    if(request('id')){
    $id = request('id');
    }else{
        $id=auth()->user()->id;
    }

    $obj = new post;
    $posts = $obj->where('author_id',$id)->orderBy('created_at','desc')->withCount('comments')->get();
    
    return view('social/userprofile',compact('posts'));
}



}