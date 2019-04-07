<?php
/**
 * Created by PhpStorm.
 * User: thangbk111
 * Date: 3/19/2019
 * Time: 10:16 AM
 */

namespace App\ConferenceRepositories;
use App\Models\Author;

class AuthorRepository
{
    public function create(array $data)
    {
        $author = new Author();
        $author->first_name = $data["first_name"];
        $author->middle_name = $data["middle_name"];
        $author->last_name = $data["last_name"];
        $author->affiliation = $data["affiliation"];
        $author->site_url = $data["site_url"];
        $author->email = $data["email"];
        $author->country = $data["country"];
        $author->save();
        return $author;
    }

    public function all()
    {
        return Author::all();
    }

    public function find($id)
    {
        return Author::find($id);
    }

    public function get($filters = null)
    {
        if (empty($filters)) {
            $author = Author::all();
        } else {
            $conditions = [];
            foreach ($filters as $key => $filter) {
                $conditions[] = [$key, '=', $filter];
            }
            $author = Author::where($conditions)->get();
        }
        return $author;
    }

    public function update($id, $data)
    {
        $author = Author::find($id);
        $author->first_name = $data["first_name"];
        $author->middle_name = $data["middle_name"];
        $author->last_name = $data["last_name"];
        $author->affiliation = $data["affiliation"];
        $author->site_url = $data["site_url"];
        $author->email = $data["email"];
        $author->country = $data["country"];
        $author->save();
        return $author;
    }

    public function destroy($id)
    {
        $author = Author::find($id);
        $author->delete();
        return $author;
    }
}
