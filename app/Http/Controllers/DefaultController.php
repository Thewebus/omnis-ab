<?php

namespace App\Http\Controllers;

use App\Models\AnneeAcademique;
use Illuminate\Http\Request;

class DefaultController extends Controller
{
    public function test() {
        return view('personnels.sample-page');
    }

    public function home() {
        return view('welcome');
    }

    public function setAnneeAcademique(Request $request, $id) {
        $previous = url()->previous();
        $firstSegment = $request->create($previous)->segment(1);
        $anneeAcademique = AnneeAcademique::findOrFail($id);
        setSelectedAnneeAcademique($anneeAcademique);

        return redirect("/{$firstSegment}");
        // return back();
    }

}
