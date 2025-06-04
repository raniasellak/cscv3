<?php

namespace App\Http\Controllers;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          $members = Member::all();
    return view('members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
        'name' => 'required',
        'role' => 'required',
        'description' => 'required',
        'image' => 'nullable|image|max:2048',
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('members', 'public');
    }
     Member::create([
        'name' => $request->name,
        'role' => $request->role,
        'description' => $request->description,
        'image' => $imagePath,
    ]);

    return redirect()->route('members.index')->with('success', 'Membre ajouté !');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
         return view('members.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
       
    $request->validate([
        'name' => 'required',
        'role' => 'required',
        'description' => 'required',
        'image' => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('members', 'public');
        $member->image = $imagePath;
    }

    $member->update([
        'name' => $request->name,
        'role' => $request->role,
        'description' => $request->description,
    ]);

    $member->save();

    return redirect()->route('members.index')->with('success', 'Membre mis à jour!');
    }

    /**
     * Remove the specified resource from storage.
     */
   
public function destroy(Member $member)
{
    $member->delete();
    return redirect()->route('members.index')->with('success', 'Membre supprimé !');
}
}
