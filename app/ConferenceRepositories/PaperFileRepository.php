<?php

namespace App\ConferenceRepositories;
use App\Models\PaperFile;

class PaperFileRepository
{
     public function all()
    {
        return PaperFile::all();
    }

    public function find($id)
    {
        return PaperFile::find($id);
    }

    public function get($filters = null)
    {
        if (empty($filters)) {
            $paperFile = PaperFile::all();
        } else {
            $conditions = [];
            foreach ($filters as $key => $filter) {
                $conditions[] = [$key, '=', $filter];
            }
            $paperFile = PaperFile::where($conditions)->get();
        }
        return $paperFile;
    }

    public function create($data)
    {
        $paperFile = new PaperFile();
        $paperFile->paper_id = $data['paper_id'];
        $paperFile->revision = $data['revision'];
        $paperFile->path = $data['path'];
        $paperFile->file_type = $data['file_type'];
        $paperFile->file_size = $data['file_size'];
        $paperFile->original_file_name = $data['original_file_name'];
        $paperFile->type = $data['type'];
        $paperFile->save();
        return $paperFile;
    }

    public function update($id, $data)
    {
        $paperFile = PaperFile::find($id);
        $paperFile->paper_id = $data['paper_id'];
        $paperFile->revision = $data['revision'];
        $paperFile->path = $data['path'];
        $paperFile->file_type = $data['file_type'];
        $paperFile->file_size = $data['file_size'];
        $paperFile->original_file_name = $data['original_file_name'];
        $paperFile->type = $data['type'];
        $paperFile->save();
        return $paperFile;
    }
}
