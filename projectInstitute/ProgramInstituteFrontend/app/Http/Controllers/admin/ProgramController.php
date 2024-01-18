<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class ProgramController extends Controller
{
    public function index()
    {
        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/show/program');
        $program = json_decode(json_encode($response->json()));

        return view('admin.program.AdminProgram', ['program' => $program]);
    }

    public function create()
    {
        return view('admin.program.CreateProgram');
    }

    public function edit($id)
    {
        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/program/'.$id);
        $program = json_decode(json_encode($response->json("data")));

        return view('admin.program.EditProgram', ['program' => $program]);
    }

    public function store(Request $request)
    {
        $validador = Validator::make($request->all(), [
            'program' => 'required|unique:program,name|regex:/^([A-Za-zÑñ\s]*)$/|between:5,200',
            'description' => 'required|regex:/^(\s*\S.*\s*)*$/|min:10',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2040',
        ]);

        if ($validador->fails()) {
            return redirect()->back()->withErrors($validador)->withInput();
        }

        $url = time() . '.' . $request->image->extension();
        $request->image->move(public_path('storage/program'), $url);


        $url = env('URL_SERVER_API');
        $response = Http::post($url . '/v1/program/', [
            'name' => $request->program,
            'description' => $request->description,
            'image' => $url,
        ]);
        $data = $response->json();

        return redirect()->route('program.index');
    }

    public function update(Request $request, $id)
    {
        $validador = Validator::make($request->all(), [
            'program' => 'required|regex:/^([A-Za-zÑñ\s]*)$/|between:5,200',
            'description' => 'required|regex:/^(\s*\S.*\s*)*$/|min:10',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2040',
        ]);

        if ($validador->fails()) {
            return redirect()->back()->withErrors($validador)->withInput();
        }

        $url = time() . '.' . $request->image->extension();
        $request->image->move(public_path('storage/program'), $url);

        $url = env('URL_SERVER_API');
        $response = Http::put($url . '/v1/program/'.$id, [
            'name' => $request->program,
            'description' => $request->description,
            'image' => $url,
        ]);
        $data = $response->json();

        return redirect()->route('program.index');
    }

    public function destroy($id)
    {
        $url = env('URL_SERVER_API');
        $response = Http::delete($url . '/v1/program/'.$id);
        $data = $response->json();

        return redirect()->route('program.index');
    }
}
