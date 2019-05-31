<?php


namespace App\Exports;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class UserExport implements FromCollection, WithHeadingRow
{

    public function collection()
    {
        $user = new User();
        $user->email = 'Email';
        $user->first_name = 'First Name';
        $user->last_name = 'Last Name';
        $user->country = 'Address';
        $user->phone = 'Phone Number';
        $collectionExport = collect([$user]);
        return $collectionExport->concat(User::all('email', 'first_name', 'last_name', 'country', 'phone'));
    }
}