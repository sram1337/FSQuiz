<?php
namespace App\Http\Controllers;
use View;
use App\Applicant;
use App\JobOpening;
use Illuminate\Http\Request;
class ApplicantController extends Controller {

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
        return View::make('showtable', ['entries' => Applicant::all(),
                                        'cols' => ['name','email','phone','github_id','position_id','invitation_date','submission_date'],
                                        'colTitles' => ['Name','Email','Phone','GitHub','Position','Invited','Submitted'],
                                        'foreignKeys' => ['position_id'],
                                        'foreignKeyToIdToValue' => ['position_id' => JobOpening::lists('title','id')->all()],
                                        'name' => 'applicants',
                                        'title' => 'Applicants']);
    }

    public function store(Request $request){
        $app = new Applicant;
        $app->name = $request->get('name');
        $app->email = $request->get('email');
        $app->phone = $request->get('phone');
        $app->github_id = $request->get('github_id');
        $app->position_id = $request->get('position_id');
        $app->invitation_date = str_replace("T", " ", $request->get('invitation_date'));
        $app->submission_date = str_replace("T", " ", $request->get('submission_date'));
        $app->save();
        return $this->showTable();
    }

    public function delete(Request $request){
        Applicant::find($request->id)->delete();
    }

    public function update(Request $request){
        $app = Applicant::find($request->get('id')); 
        $app->name = $request->get('name');
        $app->email = $request->get('email');
        $app->phone = $request->get('phone');
        $app->github_id = $request->get('github_id');
        $app->position_id = $request->get('position_id');
        $app->invitation_date = str_replace("T", " ", $request->get('invitation_date'));
        $app->submission_date = str_replace("T", " ", $request->get('submission_date'));
        $app->save();
    }
}
