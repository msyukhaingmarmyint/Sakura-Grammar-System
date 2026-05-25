<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Lesson;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function toggle(Request $request,$lesson_id)
    {
        $user_id = auth()->id();
        $lesson = Lesson::findOrFail($lesson_id);
        $bookmark = Bookmark::where('user_id', $user_id)
            ->where('lesson_id', $lesson_id)
            ->first();

        if ($bookmark) {
            $bookmark->delete();
        } else {
            Bookmark::create([
                'user_id' => $user_id,
                'lesson_id' => $lesson_id,
                'level_id' => $lesson->level_id,
            ]);
        }
        $scrollTo = $request->scroll_to;
        return redirect()->to(url()->previous() . '#' . $scrollTo)->with('success','Bookmark added successfully.');
    }

    public function showBookmarks($user_id)
    {
        $bookmarks = Bookmark::with(['lesson.level'])
                            ->where('user_id', $user_id)
                            ->get();
        return view('user.bookmarks', compact('bookmarks'));
    }

    public function destroy($id)
    {
        $bookmark = Bookmark::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();
        $bookmark->delete();
        return back()->with('success','Bookmark removed successfully.');
    }
}
