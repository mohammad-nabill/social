<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\chat_m;

class chat extends Controller
{
    function main(){
        $obj = new chat_m;
        $data = $obj->where( 'from' , auth()->user()->id )
        ->where( 'to' , request('friend') )
        ->orwhere( 'from' , request('friend') )->where('to' , auth()->user()->id)->get();

        return view('social/chat' , compact('data'));
    }


    function send(){
        $data = $this->validate(request(),[
            'text' => 'required_without:pic',
            'pic' => 'required_without:text|image',
            'friend'=> 'required',
        ]);

        $data['from'] = auth()->user()->id ;
        $data['to'] = request('friend');

        if(request('pic')){
            
            $pic = request()->file('pic');
            $picName = time() . "." . $pic->extension();
            $data['pic'] = $picName;
            $pic->move('pics',$picName);
            
             }else{
                $data['pic'] = "";
             }

        $obj = new chat_m;
        $obj->create($data);

        return redirect('social/chat?friend='.request('friend'));

    }
}
