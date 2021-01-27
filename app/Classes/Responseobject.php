<?php
namespace App\Classes;

class Responseobject
{
    const status_ok = true;
    const status_failed = false;
    const code_ok = 200;
    const code_failed = 400;
    const code_unauthorized = 403;
    const code_not_found = 404;
    const code_error = 500;
    public $status;
    public $code;
    public $msg = array();
}
class DataType {
    const single = 1;
    const list = 2;
    const compare = 3;
    const promote = 4;

}
