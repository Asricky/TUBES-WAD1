<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $topics = Topic::with('sessions')->latest()->paginate(9);
        return view('topics.index', compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('topics.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:topics',
            'description' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('topics.create')
                ->withErrors($validator)
                ->withInput();
        }

        Topic::create($request->all());

        return redirect()
            ->route('topics.index')
            ->with('success', 'Topik berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Topic $topic)
    {
        $topic->load('sessions.client');
        return view('topics.show', compact('topic'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Topic $topic)
    {
        return view('topics.edit', compact('topic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Topic $topic)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:topics,name,' . $topic->id,
            'description' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('topics.edit', $topic)
                ->withErrors($validator)
                ->withInput();
        }

        // Check if there were any actual changes to the topic
        $isUpdated = $topic->name !== $request->name || $topic->description !== $request->description;

        // Update topic
        $topic->update($request->all());

        if ($isUpdated) {
            return redirect()
                ->route('topics.index')
                ->with('success', 'Topik berhasil diperbarui.');
        } else {
            return redirect()
                ->route('topics.index')
                ->with('info', 'Tidak ada perubahan yang disimpan.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Topic $topic)
    {
        if ($topic->sessions()->exists()) {
            return redirect()
                ->route('topics.index')
                ->with('error', 'Tidak dapat menghapus topik yang memiliki sesi konsultasi terkait.');
        }

        $topic->delete();

        return redirect()
            ->route('topics.index')
            ->with('success', 'Topik berhasil dihapus.');
    }
}
