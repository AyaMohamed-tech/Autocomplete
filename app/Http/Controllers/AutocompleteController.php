<?php
 
namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
 
class AutocompleteController extends Controller
{
    function index()
    {
        return view('autocomplete');
    }
 
    function fetch(Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');
            $data = DB::table('countries')
                ->where('country_name', 'LIKE', "%{$query}%")
                ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative;width:100%;">';
            foreach($data as $row)
            {
                $output .= '
                <li><a class="dropdown-item" href="#">'.$row->country_name.'</a></li>
                ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    public function store(Request $request){

        Country::create([
            'country_name' => $request->country_name,
        ]);

        return redirect()->to('datatable')->with('success','Country created successfully');
    }

    public function datatable(){
        $countries = Country::all();
        return view('datatable.index',compact('countries'));
    }
}
