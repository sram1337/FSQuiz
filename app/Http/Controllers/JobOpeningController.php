<?php
namespace App\Http\Controllers;
use View;
use App\JobOpening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
class JobOpeningController extends Controller {

    public function showTable()
    {
        /*
         * showtable view requires: db entries to show,
         *                        the columns to show,
         *                        the titles to display for those columns,
         *                        a list of columns that are foreign keys,
         *                        the set of ids and the values to display for each foreign key,
         *                        and a title for the table.
         */
        return View::make('showtable', ['entries' => JobOpening::all(),
                                        'cols' => ['title','is_available','created_at'],
                                        'colTitles' => ['Title', 'Available?', 'Date Posted'],
                                        'foreignKeys' => [],
                                        'foreignKeyToIdToValue' => [],
                                        'name' => 'job-openings',
                                        'title' => 'Job Openings']);
    }

    public function store(Request $request){
        $job = new JobOpening;
        $job->title = $request->get('title');
        $job->is_available = intval($request->get('is_available'));
        $job->save();
        return $this->showTable();
    }

    public function delete(Request $request){
        JobOpening::find($request->id)->delete();
    }

    public function update(Request $request){
        $job = JobOpening::find($request->id); 
        $job->title = $request->get('title');
        $job->is_available = intval($request->get('is_available'));
        $job->save();
    }
}
