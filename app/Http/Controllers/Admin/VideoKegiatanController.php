<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoKegiatan;
use Illuminate\Http\Request;

class VideoKegiatanController extends Controller
{
    public function index()
    {
        $videos = VideoKegiatan::with('pembuat')
            ->latest()
            ->paginate(10);

        return view('admin.konten.video.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.konten.video.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'url_video' => 'required|url|max:255',
            'is_published' => 'nullable|boolean',
        ]);

        $validated['is_published'] = $request->boolean('is_published');
        $validated['user_id'] = auth()->id();

        VideoKegiatan::create($validated);

        return redirect()
            ->route('admin.konten.video.index')
            ->with('success', 'Video kegiatan berhasil ditambahkan.');
    }

    public function show(VideoKegiatan $video)
    {
        return view('admin.konten.video.show', compact('video'));
    }

    public function edit(VideoKegiatan $video)
    {
        return view('admin.konten.video.edit', compact('video'));
    }

    public function update(Request $request, VideoKegiatan $video)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'url_video' => 'required|url|max:255',
            'is_published' => 'nullable|boolean',
        ]);

        $validated['is_published'] = $request->boolean('is_published');

        $video->update($validated);

        return redirect()
            ->route('admin.konten.video.index')
            ->with('success', 'Video kegiatan berhasil diperbarui.');
    }

    public function destroy(VideoKegiatan $video)
    {
        $video->delete();

        return redirect()
            ->route('admin.konten.video.index')
            ->with('success', 'Video kegiatan berhasil dihapus.');
    }
}