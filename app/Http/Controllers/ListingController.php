<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\List_;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    //show all listings
    public function index()
    {
        //   dd(request(['tag']));
        return view('listings.index', [
            // 'listings' => Listing::all()
            //  'listings' => Listing::latest()->filter(request(['tag', 'search']))->get() // will show latest listings
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }
    //show single listing
    public function show(Listing $listing)
    {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }
    // show create form
    public function create()
    {
        return view('listings.create');
    }
    // store form data
    public function store(Request $request)
    {

        $formField = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'email' => ['required', 'email', Rule::unique('listings', 'email')],
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required'

        ]);

        if ($request->hasFile('logo')) {
            // To upload a file into storage/app/public/logos
            $formField['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formField['user_id'] = auth()->id();

        Listing::create($formField);
        return redirect('/')->with('message', 'Job Listing Created Successfully');
    }
    // Show Edit Form
    public function edit(Listing $listing)
    {
        return view('listings.edit', [
            'listing' => $listing
        ]);
    }

    // Update Listing
    public function update(Request $request, Listing $listing)
    {
        //Make sure Logged in user is owner
        if ($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action.');
        }

        $formField = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'email' => ['required', 'email'],
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            // To upload a file into storage/app/public/logos
            $formField['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formField);
        return redirect('/listings/manage')->with('message', 'Job Listing Updated Successfully');
    }
    // Destroy Job Post
    public function destroy(Listing $listing)
    {
        //Make sure Logged in user is owner
        if ($listing->user_id != auth()->id) {
            abort(403, 'Unauthorized Action.');
        }

        $listing->delete();
        return redirect('/')->with('message', 'Listing Deleted Successfully');
    }

    // Show Manage Listing
    public function manage()
    {
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}
