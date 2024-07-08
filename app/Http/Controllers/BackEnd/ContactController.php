<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     const PATH_VIEW = 'admin.contact.';
     const PATH_UPLOAD = 'contact';

    public function index()
    {
        $data = contact::all();
        return view(self::PATH_VIEW . __FUNCTION__, ['contact' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.contact.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //dữ liệu từ form trừ ảnh.
        $data = $request->all();
        contact::query()->create($data);
        return redirect()->route('admin.contact.index')->with('success', 'Image uploaded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contact = contact::query()->findOrFail($id);
        return view(self::PATH_VIEW . __FUNCTION__, ['contact' => $contact]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contact = contact::query()->findOrFail($id);
        return view(self::PATH_VIEW . __FUNCTION__, ['contact' => $contact]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $contact = contact::findOrFail($id);
        $data = $request->all();
        $contact->update($data);
        return redirect()->route('admin.contact.index')->with('success', 'Image updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact = contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('admin.contact.index')->with('success', 'Xóa danh mục và cover thành công.');    }
}
