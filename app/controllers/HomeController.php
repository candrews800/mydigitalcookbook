<?php

class HomeController extends BaseController {

    public function displayIndex(){
        return View::make('index');
    }

}
