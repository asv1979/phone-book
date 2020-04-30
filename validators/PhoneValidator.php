<?php
namespace app\validators;

use yii\validators\RegularExpressionValidator;

class PhoneValidator extends RegularExpressionValidator
{
    /**
     * @var string
     */
    public $pattern = '/^\+38\s0[0-9]{2}\s[0-9]{3}\s[0-9]{2}\s[0-9]{2}$/';
    /**
     * @var string
     */
    public $message = 'Phone number does not seem to be a valid phone number';
}