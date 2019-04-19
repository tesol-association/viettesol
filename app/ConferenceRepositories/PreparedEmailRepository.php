<?php
/**
 * Created by PhpStorm.
 * User: thangbk111
 * Date: 3/19/2019
 * Time: 10:16 AM
 */

namespace App\ConferenceRepositories;
use App\Models\PreparedEmail;

class PreparedEmailRepository
{
    public function create(array $data)
    {
    }

    public function all()
    {
    }

    public function find($id)
    {
    }

    public function findEmailKey($emailKey)
    {
        return PreparedEmail::where('email_key', $emailKey)->first();
    }

    public function get($filters = null)
    {
        if (empty($filters)) {
            $author = PreparedEmail::all();
        } else {
            $conditions = [];
            foreach ($filters as $key => $filter) {
                $conditions[] = [$key, '=', $filter];
            }
            $author = PreparedEmail::where($conditions)->get();
        }
        return $author;
    }

    public function update($id, $data)
    {
    }

    public function destroy($id)
    {
    }
}
