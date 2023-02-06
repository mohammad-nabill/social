<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\project;
use App\Models\users;
use App\Models\User;
use DB;
class testm extends Controller
{

    function login(){


    return view('new/login');


    }

    //////////////////////////////////////////////////////////////////

    function home(){

        $obj = new project;
        $c = $obj->get();

        return view('new/home',compact('c'));
        
    
    
        }

    ///////////////////////////////////////////////////////////////////////////////////


    function sign(){

      
        $this->validate(request(),[
             'email' => 'required | email',
             'password' => 'required'

        ]);

        
        if(auth()->attempt(['email'=>request('email') , 'password'=>request('password')],request('remember'))){

        return redirect('home');
        

        }else{
            session()->flash('err','wrong user or password');
            return back();
        }
        
       


    }

///////////////////////////////////////////////////////////////////////////////////


function signout(){

        //auth()->logout();
        session()->flush();
    
        return redirect('login');


}
///////////////////////////////////////////////////////////////////////////////////


function delete(){

    $obj= new project;

    $data = $obj->find(request('name'));

    $obj->destroy($data);

    return redirect('home');

    
}
///////////////////////////////////////////////////////////////////////////////////


function add(){

    

    $obj= new project;
    $data=['type'=>request('type'),'to_white'=>request('to'),'num1'=>request('num1'),'there'=>request('there'),
    'num2'=>request('num2'),'date1'=>request('date'),];
    $obj->create($data);
    session()->flash('success','  تم الاضافة بنجاح  ');
    return redirect('add');
    
}

///////////////////////////////////////////////////////////////////////////////////////////

function register(){

    

    

    $data = $this->validate(request(),[
        'name'=>'required | alpha ',
        'email'=>' required | email | unique:users',
        'password'=>'required | min:8 | confirmed',
    ]);

    
    $data['password']=Hash::make(request('password'));
    
    $obj= new User;
    
    $reg = $obj->create($data);
    session()->flash('success','  تم التسجيل بنجاح  ');
    auth()->login($reg);
    return redirect('home');
    
}

////////////////////////////////////////////////////////////////////////////////////////
function test(){
    return request();
}

}
