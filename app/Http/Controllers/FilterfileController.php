<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Models\filterfile;
use Illuminate\Http\Request;

class FilterfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('file.filter');
    }

    /**
     * Store a newly created resource in storage.
     */
 public function store(Request $request)
{
    $filterName = $request->FilterName;

    // Check if the filter name already exists
    if (filterfile::where('FilterName', $filterName)->exists()) {
        return redirect()->back()->withErrors(['error' => 'Sorry, filter name already exists.']);
    }

    // If the filter name doesn't exist, proceed with creating a new filter
    $filter = new filterfile();
    $randomCode = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
    $fileName = $filterName;
    $filteredFileName = $fileName . '-' . $randomCode;

    $alphabeticPart = Str::random(3);
    $numericPart = str_pad(mt_rand(0, 999), 3, '0', STR_PAD_LEFT);
    $randomCsvCode = $alphabeticPart . $numericPart;
    $filteredCsvName = $fileName . $randomCsvCode . ".csv";

    $filter->csvName = $filteredCsvName;
    $filter->Guest = $filteredFileName;
    $filter->FilterName = $fileName;
    $filter->save();
    $filterId = $filter->id;

    return redirect()->route('filterClassfication', ['id' => $filterId]);
}


    public function filterClassfication($id){
        $filter = filterfile::find($id);
        return view('file.Classfication',compact('filter'));
    }
    public function ClassficationStore(Request $request,$id){
        $filter = filterfile::find($id);
        $randomCode = str_pad(rand(0,99999),5,'0',STR_PAD_LEFT);
        $filteredClassifiation =  $randomCode;
        $ClassfiationOne = $request->ClassifyTypeOne;
        $ClassfiationTwo = $request->ClassifyTypeTwo;
        $FileOne = $ClassfiationOne . '-' . $randomCode;
        $FileTwo = $ClassfiationTwo.'-'.$randomCode;
        $filter->ClassifyTypeOne = $ClassfiationOne;
        $filter->ClassifyTypeTwo = $ClassfiationTwo;
        $filter->FolderNameOne = $FileOne;
        $filter->FolderNameTwo = $FileTwo;
        $filter->save();
        $filterId = $filter->id;
        return redirect()->route('file.index', ['id' => $filterId]);
        
    }
    /**
     * Display the specified resource.
     */
    public function show(filterfile $filterfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(filterfile $filterfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, filterfile $filterfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(filterfile $filterfile)
    {
        //
    }
}
