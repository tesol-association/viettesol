<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewCriteria extends Model
{
    protected $table = 'reviewer_criteria';

    /**
     * @param array $value
     */
    public function setKeywordsAttribute(array $value)
    {
        $this->attributes['keywords'] = json_encode($value);
    }

    /**
     * @param $values
     * @return array
     */
    public function getKeywordsAttribute($value)
    {
        return json_decode($value, true);
    }

    public function setScoreAttribute(int $value)
    {
        $this->attributes['score'] = $value;
    }

    public function getScoreAttribute($value)
    {
        return $value;
    }
}
