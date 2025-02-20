<?php

namespace App\Http\Controllers;

use App\Models\ContactForm;
use Illuminate\Http\Request;

class ContactFormController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $contacts = ContactForm::select("id", "name", "title", "created_at")
      ->get();
    return view("contacts.index", compact("contacts"));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view("contacts.create");
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {

    ContactForm::create([
      'name' => $request->name,
      'title' => $request->title,
      'email' => $request->email,
      'url' => $request->url,
      'gender' => $request->gender,
      'age' => $request->age,
      'contact' => $request->contact,
    ]);

    return to_route("contacts.index");
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    $contact = ContactForm::find($id);

    if($contact->gender === 0) {
      $gender = "男性";
    } else {
      $gender = "女性";
    }

    if($contact->age === 1) {
      $age = "~19歳";
    }
    if($contact->age === 2) {
      $age = "20~29歳";
    }
    if($contact->age === 3) {
      $age = "30~39歳";
    }
    if($contact->age === 4) {
      $age = "40~49歳";
    }
    if($contact->age === 5) {
      $age = "50~59歳";
    }
    if($contact->age === 6) {
      $age = "60歳~";
    }

    return view("contacts.show", compact("contact", "gender", "age"));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $contact = ContactForm::find($id);

    return view("contacts.edit", compact("contact"));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $contact = ContactForm::find($id);

    $contact->name = $request->name;
    $contact->title = $request->title;
    $contact->email = $request->email;
    $contact->url = $request->url;
    $contact->gender = $request->gender;
    $contact->age = $request->age;
    $contact->contact = $request->contact;
    $contact->save();

    return to_route("contacts.index");
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $contact = ContactForm::find($id);

    $contact->delete();

    return to_route("contacts.index");
  }
}
