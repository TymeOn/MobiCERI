<?php

class mainController
{

	public static function helloWorld($request,$context)
	{
		$context->mavariable="hello world";
		return context::SUCCESS;
	}



	public static function index($request,$context){
		
		return context::SUCCESS;
	}


    public static function superTest($request,$context)
    {
        $context->param1=$request["param1"];
        $context->param2=$request["param2"];
        return context::SUCCESS;
    }

}
