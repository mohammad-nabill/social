<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\post;
use App\Models\User;
use App\Models\comments;
use File;

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

        
        

    }


/////////////////////////////////////////////
function register(){

    $data = $this->validate(request(),[
        'fname'=>'required | alpha',
        'lname'=>'required | alpha',
        'birthDate'=>'required ',
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

function editprofile(){

    $this->validate(request(),[
        'id'=>'required',
        'fname'=>'required | alpha',
        'lname'=>'required | alpha',
        'email'=>'required | email',
        'birthDate'=>'required',
        'pic'=>'image',
    ]);

    $obj = new User;
    $data = $obj->find(request('id'));

    if(request('pic')){
        $pic = request()->file('pic');
        $picName = time() . "." .$pic->extension();
        $pic->move('pics',$picName);

        $data->update(['fname'=>request('fname'),'lname'=>request('lname'),'email'=>request('email'),
        'birthDate'=>request('birthDate'),'pic'=>$picName]);

    }else{
    $data->update(['fname'=>request('fname'),'lname'=>request('lname'),'email'=>request('email'),
                  'birthDate'=>request('birthDate')]);
            }

     return redirect('social/setting');
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

///////////////////////////////////////////////////////////////

function editpost(){
    $obj = new post;
    $obj2= new comments;

    $post = $obj->where("id",request('id'))->get();

    $comments =  $obj2->where("post_id",request('id'))->get();


    
    if(request('action')=="delete"){

    foreach($comments as $v){
        if(!File::exists("pics/".$v->pic) || $v->pic == null ){
        
        }else{
            File::delete("pics/".$v->pic);
        }
        }

        if(File::exists("pics/".$post[0]->pic)){
            File::delete("pics/".$post[0]->pic);
        }

        $comments->each->delete();
        $post->each->delete();
       

        return back();
}else{
    
    return view('social/edit',compact('post'));
    
}

}

//////////////////////////////////////////////////////////////

function modify(){

    $this->validate(request(),[
        'file'=>'image',
    ]);

    $obj = new post;
    $data = $obj->find(request('id'));

    if(!request('subject') && !request('file') && !$data->pic ){
        session()->flash('errore','post cannot be empty');
        return back();
    }

    


    
    if(request('file')){
    $pic=request()->file('file');
    $picName = time().".".$pic->extension();
    $pic->move('pics',$picName);

    $data->update(['subject'=>request('subject'),'pic' => $picName ]);

    }else{
        if(request('deletePhoto')){
            $data->update(['subject'=>request('subject') , 'pic'=>'' ]);
        }else{
        $data->update(['subject'=>request('subject')]);
        }
    }


    return redirect("social/myinfo?id=".auth()->user()->id );

    
}

////////////////////////////////////////////////////////////////////////

function setting(){

    $obj = new User;
    $data = $obj->where('id',auth()->user()->id)->get();
    
    return view('social/setting',compact('data'));
}



}