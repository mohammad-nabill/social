<?php

namespace App\Http\Controllers;
use App\Models\comments;
use Validator;

use Illuminate\Http\Request;

class comment extends Controller
{
    function add(){
        $data = Validator::make(request()->all(),[
            'comment'=>'required_without:pic',
            'pic'=>'required_without:comment',
            'post_id'=>'required',
            'author_id'=>'required',
        ]);
        
        
        //$position='#comment'.request('post_id');

        if ($data->fails()) {

         $post = request('post_id');
        
         //return back()->with('post',$post)->withErrors($data);
         return redirect(url()->previous())->with('post',$post)->withErrors($data);

         }else{

           if(request('pic')){
          $store = request()->all();
          $pic = request('pic');
          $picName = time() . "." . $pic->extension();
          $store['pic'] = $picName;
          $pic->move('pics',$picName);
          
           }else{
           $store = request()->all();
           }
           
         }
        

        $obj = new comments ;
        $obj->create($store);
        return redirect(url()->previous());
        
    }


}
