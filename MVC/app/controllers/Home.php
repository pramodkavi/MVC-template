<?php

class Home {

    use Controller;
    public function index ($a = '',$b = '',$c = ''){

        show($a);
        show($b);
        show($c);
        
    }
    public function edit ($a = '',$b = '',$c = ''){}

}

// $home = new Home;

//call_user_func_array([$home,'index'],['a'=>'fafadf']); // we can call function by changing parameter