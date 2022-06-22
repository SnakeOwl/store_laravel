<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::active()->get();
        return view('admin.contacts.index', compact('contacts') );
    }

    public function create()
    {
        return view('support-form');
    }

    public function store(CreateMessageRequest $request)
    {
        Contact::create($request->all());

        session()->flash('info', 'Спасибо! Письмо было отправлено.');

        return redirect()->route('support.create');
    }


    public function edit(Contact $contact)
    {
        return view('admin.contacts.edit', compact('contact') );
    }

    public function update(UpdateMessageRequest $request, Contact $contact)
    {
        $contact->update($request->all());

        session()->flash('info', 'Письмо было прочитано.');

        return redirect()->route('contacts.index');
    }
}
