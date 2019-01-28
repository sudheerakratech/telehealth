<?php
/**
 * Created by PhpStorm.
 * User: hasan
 * Date: 1/27/2019
 * Time: 2:52 PM
 */


function rsql($sql){
	return \DB::raw($sql);
}
