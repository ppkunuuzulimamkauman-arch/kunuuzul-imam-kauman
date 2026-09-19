<?php

namespace App\Http\Controllers;

use App\Models\LandingContent;
use Illuminate\Http\Request;

class LandingContentController extends Controller
{
    public function __construct(){ $this->middleware('role:admin'); }

    public function index()
    {
        $contents = LandingContent::orderBy('sort_order')->orderBy('created_at','desc')->get();
        return view('admin.landing.index', compact('contents'));
    }

    public function create(Request $request)
    {
        $allowed = ['hero','informasi','pengumuman','panduan','alur','info_umum','info_pjgt','info_gt'];
        $section = in_array($request->query('section'), $allowed) ? $request->query('section') : null;
        return view('admin.landing.form', ['content'=>new LandingContent(['section'=>$section])]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'section'=>'required|in:hero,informasi,pengumuman,panduan,alur,info_umum,info_pjgt,info_gt',
            'title'=>'required|string|max:255',
            'subtitle'=>'nullable|string|max:255',
            'category'=>'nullable|string|max:50',
            'content'=>'nullable|string|max:2000',
            'link_text'=>'nullable|string|max:50',
            'link_url'=>'nullable|string|max:255',
            'date_label'=>'nullable|string|max:50',
            'is_active'=>'nullable|boolean',
            'sort_order'=>'nullable|integer',
        ]);
        $data['is_active'] = $request->boolean('is_active', true);
        LandingContent::create($data);
        return redirect()->route('landing-contents.index')->with('success','Konten berhasil ditambah');
    }

    public function edit(LandingContent $landingContent)
    {
        return view('admin.landing.form', ['content'=>$landingContent]);
    }

    public function update(Request $request, LandingContent $landingContent)
    {
        $data = $request->validate([
            'section'=>'required|in:hero,informasi,pengumuman,panduan,alur,info_umum,info_pjgt,info_gt',
            'title'=>'required|string|max:255',
            'subtitle'=>'nullable|string|max:255',
            'category'=>'nullable|string|max:50',
            'content'=>'nullable|string|max:2000',
            'link_text'=>'nullable|string|max:50',
            'link_url'=>'nullable|string|max:255',
            'date_label'=>'nullable|string|max:50',
            'is_active'=>'nullable|boolean',
            'sort_order'=>'nullable|integer',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $landingContent->update($data);
        return redirect()->route('landing-contents.index')->with('success','Konten berhasil diupdate');
    }

    public function destroy(LandingContent $landingContent)
    {
        $landingContent->delete();
        return back()->with('success','Konten dihapus');
    }
}
