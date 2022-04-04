<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Directory;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\DirectoryRequest;


class DirectoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.directories.index', ['directories' => Directory::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.directories.form', ['directories' => Directory::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DirectoryRequest $request)
    {
        $res = Directory::create($request->all());
        return redirect()->route('directories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Directory  $directory
     * @return \Illuminate\Http\Response
     */
    public function show(Directory $directory)
    {
        return redirect()->route('directories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Directory  $directory
     * @return \Illuminate\Http\Response
     */
    public function edit(Directory $directory)
    {
        return view('admin.directories.form', [
            'directory' => $directory,
            'directories' => Directory::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Directory  $directory
     * @return \Illuminate\Http\Response
     */
    public function update(DirectoryRequest $request, Directory $directory)
    {
        $directory->update($request->all());
        return redirect()->route('directories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Directory  $directory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Directory $directory)
    {
        $directory->delete();
        return redirect()->route('directories.index');
    }
}
