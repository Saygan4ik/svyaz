<?php

namespace App\Http\Controllers;

use App\Repositories\CommentRepository;
use App\Repositories\GroupRepository;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $groupRepository;
    protected $productRepository;
    protected $userRepository;
    protected $commentRepository;

    public function __construct(GroupRepository $groupRepository,
                                ProductRepository $productRepository,
                                UserRepository $userRepository,
                                CommentRepository $commentRepository) {
        $this->groupRepository = $groupRepository;
        $this->productRepository = $productRepository;
        $this->userRepository = $userRepository;
        $this->commentRepository = $commentRepository;
        $this->middleware('admin');
    }

    public function index() {
        $groups = $this->groupRepository->all();
        $products = $this->productRepository->counts();
        $users = $this->userRepository->counts();
        $comments = $this->commentRepository->counts();
        return view('admin/index', compact('groups', 'products', 'users', 'comments'));
    }
}
