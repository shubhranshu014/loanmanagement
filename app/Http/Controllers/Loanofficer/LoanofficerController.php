<?php

namespace App\Http\Controllers\Loanofficer;
use App\Models\Loan;
use App\Models\Member;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;

class LoanofficerController extends Controller
{
    public function dashboard()
    {
        return view("loanofficer.dashboard");
    }

    public function members()
    {
        $branchs = Branch::all();
        $members = Member::all();
        return view("loanofficer.members")->with(compact("branchs", "members"));
    }

    public function storemembers(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'memberid' => 'required|string|max:50',
            'groupname' => 'required|string|max:255',
            'branchid' => 'required',
            'email' => 'required|email|max:255',
            'countryCode' => 'required',
            'mobile' => 'required|digits_between:10,15',
            'gender' => 'required|in:Male,Female',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'pincode' => 'required|digits:6',
            'profession' => 'required|string|in:Student,Self-Employed,salaried,Other',
            'maritalStatus' => 'required|string|in:Single,Married',
            'creditSource' => 'required|string|max:255',
            'address' => 'required|string',
            'photo' => 'required|image|max:2048',
        ]);

        $users = new User();
        $users->name = $validated["name"];
        $users->email = $validated["email"];
        $users->password = hash::make("12345678");
        $users->role = "user";
        $users->save();

        $members = new Member();
        $members->userid = $users->id;
        $members->name = $validated["name"];
        $members->memberid = $validated["memberid"];
        $members->groupname = $validated["groupname"];
        $members->branchid = $validated["branchid"];
        $members->email = $validated["email"];
        $members->countrycode = $validated["countryCode"];
        $members->mobile = $validated["mobile"];
        $members->gender = $validated["gender"];
        $members->city = $validated["city"];
        $members->state = $validated["state"];
        $members->pincode = $validated["pincode"];
        $members->profession = $validated["profession"];
        $members->maritalStatus = $validated["maritalStatus"];
        $members->creditSource = $validated["creditSource"];
        $members->address = $validated["address"];

        $photo = time() . rand(1, 99) . 'meb.' . $request['photo']->extension();
        $request['photo']->storeAs('uplodes', $photo);
        $members->photo = $photo;

        $members->save();

        return redirect()->back()->with('success', 'Member registered successfully.');
    }

    public function loandetails()
    {
        $loans = Loan::with(['loanProduct', 'borrower'])->get();
        return view("loanofficer.loandetails")->with(compact("loans"));
    }
}
