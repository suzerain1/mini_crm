<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Companies;
use Illuminate\Support\Str;

class CompanyController extends Controller
{

    public function getCompanies() {

        return response()->json(Companies::paginate(10));

    }

    public function addCompany(Request $request) {

        request()->validate([
            'name'      => 'required',
            'email'     => 'required',
            'file'      => 'image',
            'website'   => 'required'
        ]);

        $image      = request()->file('file');
        $imageName  = $image->getClientOriginalName();
        $filename   = time().$imageName;

        $image->move(storage_path('/app/public'), $filename);

        $company = Companies::create([
            'name'      => request('name'),
            'email'     => request('email'),
            'logo'      => $filename,
            'website'   => request('website')
        ]);

        return response($company, 201);

    }

    public function getCompanyById($id) {

        $company = Companies::find($id);
        if(is_null($company)) {
            return response()->json(['msg' => 'Companies not found'], 404);
        }
        return response()->json($company, 200);
    }

    public function updateCompany(Request $request, $id) {

        $company = Companies::find($id);
        if(is_null($company)) {
            return response()->json(['msg' => 'Companies not found'], 404);
        }
        $company->update($request->all());
        return response($company, 200);

    }

    public function deleteCompany(Request $request, $id) {

        $company = Companies::find($id);
        if(is_null($company)) {

            return response()->json(['msg' => 'Company not found'], 404);

        }

        $company->delete();
        return response()->json(null, 204);

    }
}
