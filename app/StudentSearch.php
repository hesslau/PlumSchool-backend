<?php
/**
 * Created by IntelliJ IDEA.
 * User: hesslau
 * Date: 8/25/18
 * Time: 9:39 PM
 */

namespace App;

use App\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StudentSearch
{
    public static function apply(Request $filters)
    {
        $user = (new Student)->newQuery();

        // Search for a user based on their name.
        if ($filters->has('gender')) {
            $user->where('gender', $filters->input('gender'));
        }

        if ($filters->has('min_age')) {
            $user->where('date_of_birth','<', Carbon::now()->subYears($filters->input('min_age')));
        }

        if ($filters->has('max_age')) {
            $user->where('date_of_birth','>', Carbon::now()->subYears($filters->input('max_age')));
        }

        // Get the results and return them.
        return $user->get();
    }
}