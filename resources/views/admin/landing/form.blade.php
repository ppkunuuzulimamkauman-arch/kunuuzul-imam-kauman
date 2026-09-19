@extends('layouts.app')
@section('title', ($content->exists ? 'Edit' : 'Tambah').' Landing Content')
@section('breadcrumb','Landing Page')
@section('content')
<div class="card-form" style="max-width:720px;margin:0 auto">
  <div class="card-form-header">{{ $content->exists ? 'Edit' : 'Tambah' }} Konten Landing</div>
  <form method="POST" action="{{ $content->exists ? route('landing-contents.update',$content) : route('landing-contents.store') }}" class="p-4">
    @csrf @if($content->exists) @method('PUT') @endif
    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Section *</label>
        <select name="section" class="form-select" required><option value="">-- Pilih --</option><option value="hero" @selected($content->section=='hero')>hero — Hero Landing Publik</option><option value="informasi" @selected($content->section=='informasi')>informasi — Kartu Informasi (landing /)</option><option value="pengumuman" @selected($content->section=='pengumuman')>pengumuman — Kartu Pengumuman (landing /)</option><option value="panduan" @selected($content->section=='panduan')>panduan — Kartu Panduan (landing /)</option><option value="alur" @selected($content->section=='alur')>alur — Langkah Alur (landing /)</option><option value="info_umum" @selected($content->section=='info_umum')>info_umum — Tab Informasi Umum (Dashboard GT/PJGT)</option><option value="info_pjgt" @selected($content->section=='info_pjgt')>info_pjgt — Tab Informasi PJGT (Dashboard PJGT)</option><option value="info_gt" @selected($content->section=='info_gt')>info_gt — Tab Informasi Guru Tugas (Dashboard GT)</option></select>
      </div>
      <div class="col-md-6">
        <label class="form-label">Kategori</label>
        <input name="category" value="{{ old('category',$content->category) }}" class="form-control" placeholder="INFORMASI / PENGUMUMAN">
      </div>
      <div class="col-12">
        <label class="form-label">Judul *</label>
        <input name="title" value="{{ old('title',$content->title) }}" class="form-control" required placeholder="Pendaftaran TMTB & DAI 1448/1449 H Dibuka">
      </div>
      <div class="col-md-6">
        <label class="form-label">Subtitle</label>
        <input name="subtitle" value="{{ old('subtitle',$content->subtitle) }}" class="form-control" placeholder="Gelombang 1 dibuka 10 Sep - 30 Nov 2026">
      </div>
      <div class="col-md-6">
        <label class="form-label">Label Tanggal</label>
        <input name="date_label" value="{{ old('date_label',$content->date_label) }}" class="form-control" placeholder="10 Sep 2026">
      </div>
      <div class="col-12">
        <label class="form-label">Isi Konten</label>
        <textarea name="content" rows="4" class="form-control" placeholder="Lengkapi formulir 4 tahap...">{{ old('content',$content->content) }}</textarea>
      </div>
      <div class="col-md-6">
        <label class="form-label">Link Text</label>
        <input name="link_text" value="{{ old('link_text',$content->link_text) }}" class="form-control" placeholder="Baca Selengkapnya">
      </div>
      <div class="col-md-6">
        <label class="form-label">Link URL</label>
        <input name="link_url" value="{{ old('link_url',$content->link_url) }}" class="form-control" placeholder="# atau /register">
      </div>
      <div class="col-md-6">
        <label class="form-label">Urutan</label>
        <input type="number" name="sort_order" value="{{ old('sort_order',$content->sort_order ?? 0) }}" class="form-control">
      </div>
      <div class="col-md-6 d-flex align-items-end">
        <label class="d-flex align-items-center gap-2" style="cursor:pointer"><input type="checkbox" name="is_active" value="1" @checked(old('is_active',$content->is_active ?? true))> Aktif tampil di landing</label>
      </div>
    </div>
    <div class="d-flex gap-2 mt-4">
      <button class="btn-green flex-fill"><i class="bi bi-check-circle"></i> Simpan</button>
      <a href="{{ route('landing-contents.index') }}" class="btn-yellow flex-fill" style="justify-content:center">Batal</a>
    </div>
  </form>
</div>
@endsection
