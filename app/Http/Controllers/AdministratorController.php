<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Http\Resources\CategoryResource;
use App\Models\UserRole;
use Log;

class AdministratorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $anActiveCategory = new CategoryResource(Category::newsCategoryDictItem());
        return redirect()->route('admin.dashboard.' . $anActiveCategory->url);
    }
}
