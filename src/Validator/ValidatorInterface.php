<?php
/**
 * Created by PhpStorm.
 * User: piotr.bialek
 * Date: 22.08.2018
 * Time: 10:55
 */

namespace ToDo\Validator;


interface ValidatorInterface
{
    public function checkLength($name);

    public function isRealDate($date);

    public function checkIfPast($date);

    public function checkNamePattern($name);
}