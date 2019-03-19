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

}
