<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Repositories;
use App\Repositories\UserRepository;
use App\Http\Requests;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct (UserRepository $userRepository) {
        $this->userRepository = $userRepository;
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $route = Route::current();
        if($route->role) {
            $users = $this->userRepository->getUsersSortBy($route->role);
            }
        else {
            $users = $this->userRepository->getUsersSortBy();
        }
        return view('user/index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $this->userRepository->store($request->all());
        return redirect('/user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userRepository->getById($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->getById($id);
        return view('user/edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $this->userRepository->update($id, $request->all());
        return redirect('user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->id != $id)
            $this->userRepository->delete($id);
        return back();
    }

    public function changeSeen(Request $request) {
        $this->userRepository->changeUserSeen($request['id']);
        return \response()->json($request['id']);
    }

    public function changeAdmin(Request $request) {
        $this->userRepository->changeUserAdmin($request['id']);
        return \response()->json($request['id']);
    }

    public function getUserComments($id) {
        $user = $this->userRepository->getById($id);
        $comments = $user->comments;
        return view('comment/show', compact('comments'));
    }
}
