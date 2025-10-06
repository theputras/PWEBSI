<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class ControllerData extends BaseController
{
    public function latihan01()
    {
        $x=10;
        $y="universitas dinamika";
        $z=array("Laravel",
        "codeigniter",
        "zend",
        "yii");
        $k=array("web"=>"laravel",
        "mobile"=>"flutter",
        "widows"=>"cshaph",
        "ios"=>"swift" );

        $l=array("web"=>$x,
        "mobile"=>$y,
        "widows"=>$y,
        "ios"=>$k );
        //tugas
        return view('tampil',
        ['isix'=>$x,'isiy'=>$y,
        'isiz'=>$z,'isik'=>$k]);
    }




}
