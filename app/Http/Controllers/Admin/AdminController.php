<?php

namespace App\Http\Controllers\Admin;
use App\Models\Loan;
use App\Models\Loanofficer;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view("admin.dashboard");
    }
    public function addbranch()
    {
        $branchs = Branch::all();
        return view("admin.addbranch")->with(compact("branchs"));
    }
    public function storebranch(Request $request)
    {
        $validatedData = $request->validate([
            'branchname' => 'required|string|max:255',
            'branchid' => 'required|string|unique:branches,branchid|max:255',
            'location' => 'required|string|max:1000',
        ]);

        Branch::create($validatedData);

        return redirect()->back()->with('success', 'Branch added successfully!');
    }

    public function bupdate(Request $request, $id)
    {
        $branch = Branch::findOrFail($id);
        $request->validate([
            'branchname' => 'required',
            'branchid' => 'required|unique:branches,branchid,'.$id,
            'location' => 'required',
        ]);

        $branch->update($request->all());
        return back()->with('success', 'Branch updated successfully!');
    }

    public function bdestroy($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();
        return back()->with('success', 'Branch deleted successfully!');
    }

    public function addloanofficer()
    {
        $branches = Branch::all();
        $lofficer = Loanofficer::all();
        return view("admin.addloanofficer")->with(compact("branches","lofficer"));
    }
    public function storeloanofficer(Request $request)
    {
        $validated = $request->validate([
            'branchname' => 'required|exists:branches,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:loanofficers,email',
            'aadhar' => 'required|string|unique:loanofficers,aadhar',
            'pan' => 'required|string|unique:loanofficers,pan',
            'address' => 'required|string',
        ]);

        $users = new User();
        $users->name = $request["name"];
        $users->email = $request["email"];
        $users->password = hash::make("12345678");
        $users->role = "loanofficer";
        $users->save();

        $olanofficers = new Loanofficer();
        $olanofficers->branch_id = $validated["branchname"];
        $olanofficers->user_id = $users->id;
        $olanofficers->name = $validated["name"];
        $olanofficers->email = $validated["email"];
        $olanofficers->aadhar = $validated["aadhar"];
        $olanofficers->pan = $validated["pan"];
        $olanofficers->address = $validated["address"];
        $olanofficers->save();

        return redirect()->back()->with('success', 'Loan Officer added successfully!');
    }

    public function loandetails()
    {
        $loans = Loan::with(['loanProduct', 'borrower'])->get();
        return view("admin.loandetails")->with(compact("loans"));
    }

    public function changeStatus($id)
    {
        $loans = Loan::findOrFail($id);
        $loans->status = 1; // Set status to 1 (Approved)
        $loans->save();

        return redirect()->back()->with('success', 'Loan status updated to Approved!');
    }

    public function oupdate(Request $request, $id)
    {
        $officer = Loanofficer::findOrFail($id);
        $request->validate([
            'branchname' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:loanofficers,email,' . $id,
            'aadhar' => 'required|unique:loanofficers,aadhar,' . $id,
            'pan' => 'required|unique:loanofficers,pan,' . $id,
            'address' => 'required',
        ]);

        $officer->update([
            'branch_id' => $request->branchname,
            'name' => $request->name,
            'email' => $request->email,
            'aadhar' => $request->aadhar,
            'pan' => $request->pan,
            'address' => $request->address,
        ]);

        return redirect()->route('admin.add.loanofficer')->with('success', 'Loan Officer updated successfully!');
    }
    public function odestroy($id)
    {
        Loanofficer::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Loan Officer deleted successfully!');
    }
}
