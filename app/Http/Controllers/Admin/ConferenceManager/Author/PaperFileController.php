<?php

namespace App\Http\Controllers\Admin\ConferenceManager\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use App\Events\PaperEvent\SendFullPaper;
use App\ConferenceRepositories\PaperRepository;
use App\ConferenceRepositories\PaperFileRepository;
use App\ConferenceRepositories\AuthorRepository;
use App\Models\PaperFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;

class PaperFileController extends BaseConferenceController
{
    protected $papers;
    protected $authors;
    public function __construct(Request $request, PaperRepository $paperRepository, AuthorRepository $authorRepository, PaperFileRepository $paperFileRepository)
    {
        parent::__construct($request);
        $this->papers = $paperRepository;
        $this->authors = $authorRepository;
        $this->paperFile = $paperFileRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function savePaper(Request $request, $conferenceId, $paperId)
    {
        //save
        if ($request->hasFile('attach_file')){
            //set path
            $paper = $this->papers->find($paperId);
            $path = 'Conference_'.$conferenceId.'/Track_'.$paper->track->name.'/Paper_'.$paperId;

            //set file name
            $name = '';
            foreach($paper->authors as $author){
                $name = $name.$author->first_name.'_'.$author->middle_name.'_'.$author->last_name;
            }
            $fileName = $name.'-'.$request->file('attach_file')->getClientOriginalName();

            //Save attach file
            $path = Storage::disk('public')->putFileAs($path, $request->attach_file, $fileName);

            $data['paper_id'] = $paperId;
            $data['revision'] = null;
            $data['path'] = $path;
            $data['file_type'] = $request->file('attach_file')->getClientOriginalExtension();
            $data['file_size'] = $request->file('attach_file')->getSize();
            $data['original_file_name'] = $request->file('attach_file')->getClientOriginalName();
            $data['type'] = Config::get('constants.PAPER_FILE.FULL_PAPER');

            //Save paper_file
            $paperFile = $this->paperFile->create($data);

            //Save paper
            $dataPaperFile['file_id'] = $paperFile->id;
            $dataPaperFile['full_paper'] = $request->full_paper;
            $paper = $this->papers->updatePaperFile($paperId, $dataPaperFile);
            event(new SendFullPaper($paper));

            return redirect()->back()->with('success', 'File '.$paperFile->original_file_name.' had been uploaded successful !');
        }else{
            //Find paper and update full paper
            $data['full_paper'] = $request->full_paper;
            $data['file_id'] = null;
            $paper = $this->papers->updatePaperFile($paperId, $data);
            event(new SendFullPaper($paper));
            return redirect()->back()->with('success', $paper->title.' had been updated Full Paper successful !');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePaper(Request $request, $conferenceId, $paperId, $id)
    {
        //Get paperFile
        $paperFile = $this->paperFile->find($id);

        //update
        if ($request->hasFile('attach_file')){

            //set path
            $paper = $this->papers->find($paperId);
            $path = 'Conference_'.$conferenceId.'/Track_'.$paper->track->name.'/Paper_'.$paperId;

            //set file name
            $name = '';
            foreach($paper->authors as $author){
                $name = $name.$author->first_name.'_'.$author->middle_name.'_'.$author->last_name.'-';
            }
            $fileName = $name.$request->file('attach_file')->getClientOriginalName();

            //Save attach file new and Delete attach file old
            $path = Storage::disk('public')->putFileAs($path, $request->attach_file, $fileName);
            Storage::disk('public')->delete($paperFile->path);

            $data['paper_id'] = $paperId;
            $data['revision'] = null;
            $data['path'] = $path;
            $data['file_type'] = $request->file('attach_file')->getClientOriginalExtension();
            $data['file_size'] = $request->file('attach_file')->getSize();
            $data['original_file_name'] = $request->file('attach_file')->getClientOriginalName();
            $data['type'] = Config::get('constants.PAPER_FILE.FULL_PAPER');

            //Update paper_file
            $paperFile = $this->paperFile->update($id, $data);

            return redirect()->back()->with('success', 'File '.$paperFile->original_file_name.' had been updated successful !');
        }

        //Find paper and update full paper
        $data['full_paper'] = $request->full_paper;
        $data['file_id'] = $paperFile->id;
        $paper = $this->papers->updatePaperFile($paperId, $data);
        return redirect()->back()->with('success', $paper->title.' had been updated Full Paper successful !');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
