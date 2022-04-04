<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        return view('admin.contacts.index', ['contacts' => Contact::all()]);
    }

    public function create()
    {
        return view('support-form');
    }

    public function store(Request $request)
    {
        $con = new Contact();
        $con->name = $request->input('name');
        $con->email = $request->input('email');
        $con->message = $request->input('message');
        $con->save();

        return view('support-form', ['message' => 'Письмо было отправлено. Наши специалисты скоро свяжутся с вами.']);
    }

    public function show($id)
    {
        return view('admin.contacts.show', ['record' => Contact::find($id)]);
    }

    public function update(Request $request, $id)
    {
        $con = Contact::findOrFail($id);
        $con->active = $request->boolean('active');

        $con->save();

        return view('admin.contacts.index', [
            'contacts' => Contact::all(),
            'message' => 'Изменено'
        ]);
    }
}
