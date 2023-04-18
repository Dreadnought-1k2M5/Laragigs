<?php

namespace App\Http\Controllers;

use App\Models\Listings;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    //
    public function index(){
        return view('Listings.index', [
            'listings' => Listings::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }
    public function show(Listings $listing){
        return view('Listings.show', ['listing' => $listing]);
    }
    public function create(){
        return view('Listings.create');
    }

    //store listing data
    public function store(Request $request){
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required',],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email', Rule::unique('listings', 'company')],
            'tags' => 'required',
            'description' => 'required'
        ]);
        
        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logoFolder', 'public');
        }

        $formFields['user_id'] = auth()->id();

        Listings::create($formFields);

        return redirect('/')->with('message', 'Listing created successfully');
    }

    //show edit form
    public function edit(Listings $listing){
        //make sure the logged in user is the owner of current given listing
        if($listing->user_id !== auth()->id()){
            abort("403", "Unauthorized Action");
        }
        return view('listings.edit', ['listing' => $listing]);
    }
     //store listing data
     public function update(Request $request, Listings $listing){
        //make sure the logged in user is the owner of current given listing
        if($listing->user_id !== auth()->id()){
            abort("403", "Unauthorized Action");
        }

        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);
        
        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logoFolder', 'public');
        }

        $listing->update($formFields);

        return back()->with('message', 'Listing updated successfully');
    }

    public function destroy(Listings $listing){
        //make sure the logged in user is the owner of current given listing
        if($listing->user_id !== auth()->id()){
            abort("403", "Unauthorized Action");
        }
        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully');
    }

    public function manage(){
        return view('Listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}
