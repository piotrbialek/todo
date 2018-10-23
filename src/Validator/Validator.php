<?php
/**
 * Created by PhpStorm.
 * User: piotr.bialek
 * Date: 22.08.2018
 * Time: 10:54
 */

namespace ToDo\Validator;

use DateTime;

class Validator implements ValidatorInterface
{

    public function isValid(string $name)
    {
        return $this->checkLength($name) && $this->checkNamePattern($name);
    }

    public function checkLength($name)
    {
        $range = ((strlen($name) > 2) && (strlen($name) < 30));
        return $range;
    }

    public function isRealDate($date)
    {
        if (false === strtotime($date)) {
            return false;
        }
        list($year, $month, $day) = explode('-', $date);
        return checkdate($month, $day, $year);
    }

    public function checkIfPast($date)
    {
        $now = new DateTime("now");
        $toCheck = new DateTime($date);
        return ($now > $toCheck);
    }

    public function checkNamePattern($name)
    {
        return (preg_match('/^[a-z0-9 ]+$/i', $name));
    }
}