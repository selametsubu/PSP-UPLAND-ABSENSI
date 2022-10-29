<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersonilController extends Controller
{
    public function index()
    {
        return view('pengaturan.personil.index');
    }

    public function create()
    {
        return view('pengaturan.personil.create');
    }

    public function edit($id)
    {
        return view('pengaturan.personil.edit', compact('id'));
    }
}
