<?php

use Illuminate\Support\Facades\Auth;

function permission($permission){
    return Auth::guard('admin')->user()->hasPermissionTo($permission) ? true : false ;
}

?>