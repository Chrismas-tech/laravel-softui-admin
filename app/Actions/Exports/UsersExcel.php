<?php

namespace App\Actions\Exports;

use App\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExcel implements FromCollection
{
    use AsAction;

    public $users;

    public function __construct($users)
    {
        $this->users = $users;
    }

    public function collection()
    {
        return User::where('role', 'customer')
            ->whereIn('id', $this->users)
            ->get()
            ->map(function ($user) {
                return [
                    'firstname' => $user->firstname,
                    'lastname' => $user->lastname,
                    'email' => $user->email
                ];
            });
    }
}
