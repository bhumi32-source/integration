<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class TimeRule implements Rule
{
    protected $minutesAhead;

    public function __construct($minutesAhead)
    {
        $this->minutesAhead = $minutesAhead;
    }

    public function passes($attribute, $value)
    {
        // Use Validator facade to access current date
        $validator = Validator::make([$attribute => $value], [$attribute => 'date']);
        $dateIsToday = $validator->passes() && $value->isToday();

        // Only apply the rule when the date is today
        if ($dateIsToday) {
            // Your validation logic goes here
            // Example: Check if the time is at least the specified minutes ahead of the current time
            
            // Here's a sample validation logic, you can adjust it as needed
            $currentDateTime = strtotime(date('Y-m-d H:i'));
            $inputDateTime = strtotime(date('Y-m-d', strtotime($value)) . ' ' . date('H:i', strtotime($value)));
            return ($inputDateTime - $currentDateTime) >= ($this->minutesAhead * 60); // Convert minutes to seconds
        }

        // Return true if the rule should be considered passed when the date is not today
        return true;
    }

    public function message()
    {
        return "The time must be at least {$this->minutesAhead} minutes ahead of the current time if the date is today.";
    }
}
