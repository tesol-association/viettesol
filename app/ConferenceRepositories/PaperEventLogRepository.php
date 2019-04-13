<?php
/**
 * Created by PhpStorm.
 * User: thangbk111
 * Date: 3/20/2019
 * Time: 2:54 PM
 */

namespace App\ConferenceRepositories;

use App\Models\PaperEventLog;
use Carbon\Carbon;

class PaperEventLogRepository
{

    /**
     * @return PaperEventLog[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return PaperEventLog::all();
    }

    public function find($id)
    {
        return PaperEventLog::find($id);
    }

    /**
     * @param null $filters
     * @return PaperEventLog[]|\Illuminate\Database\Eloquent\Collection
     */
    public function get($filters = null)
    {
        if (empty($filters)) {
            $paperEventLog = PaperEventLog::with('paper', 'user')->orderByDesc('created_at')->get();
        } else {
            $conditions = [];
            foreach ($filters as $key => $filter) {
                $conditions[] = [$key, '=', $filter];
            }
            $paperEventLog = PaperEventLog::with('paper', 'user')->where($conditions)->orderByDesc('created_at')->get();
        }
        return $paperEventLog;
    }


}
