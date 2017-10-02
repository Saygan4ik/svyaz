<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentRequest;
use App\Repositories\CommentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class CommentController extends Controller
{
    protected $commentRepository;

    public function __construct(CommentRepository $commentRepository) {
        $this->commentRepository = $commentRepository;
        $this->middleware('auth');
        $this->middleware('admin')->only(['index', 'changeSeen']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $route = Route::current();
        $comments = $this->commentRepository->getAllComments($route->new);
        return view('comment/index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        $this->authorize('create', Comment::class);
        $inputs = $request->except('_token');
        $user = Auth::user();
        $inputs = array_add($inputs, 'user_id', $user->id);
        $this->commentRepository->store($inputs);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CommentRequest $request, $id)
    {
        $this->authorize('update', Comment::class);
        $inputs = $request->except('_token');
        $user = Auth::user();
        $inputs = array_add($inputs, 'user_id', $user->id);
        $this->commentRepository->update($id, $inputs);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = $this->commentRepository->getById($id);
        $this->authorize('update', $comment);
        $this->commentRepository->delete($id);
        return back();
    }

    public function changeSeen(Request $request) {
        $this->commentRepository->changeCommentSeen($request['id']);
        return \response()->json($request['id']);
    }
}
