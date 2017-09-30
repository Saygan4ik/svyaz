<?php

namespace App\Http\Controllers;

use App\Repositories\GroupRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $groupRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(GroupRepository $groupRepository) {
        $this->groupRepository = $groupRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = $this->groupRepository->all();
        return view('home', compact('groups'));
    }
}
