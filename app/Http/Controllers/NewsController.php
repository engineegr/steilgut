<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\NewsIndexResource;
use App\Http\Resources\NewsShowResource;
use App\Http\Resources\CategoryResource;
use App\Models\News;
use App\Models\Category;
use App\Models\UserRole;
use Log;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cms.admin.dashboard')->with(
            [
                'categories' => CategoryResource::collection(Category::categoryDictItems()),
                'activeCategory' => new CategoryResource(Category::newsCategoryDictItem()),
                'items' => NewsIndexResource::collection(News::paginate(3)),
            ]
        );
    }

    public function create()
    {
        if (request()->user()->hasRole(UserRole::$USER_ROLE_DICT[0])) {
            Log::info('Info [NewsController.create] user is Admin Role');
            return view('cms.admin.news.news-create-form')->with(
                [
                    'categoryTitle' => 'NEWS',
                    'isReadOnly' => false,
                ]
            );
        } else {
            Log::info('Info [NewsController.create] For plain USER the news create view has not defined yet');
            return view('app');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (request()->user()->hasRole(UserRole::$USER_ROLE_DICT[0])) {
            Log::info('Info [NewsController.store] user is Admin__');
            Log::info('Info [NewsController.store] Posting Date ' . $request->input('postingDate'));
            Log::info('Info [NewsController.store] Request file ' . $request->input('itemImage'));
            Log::info('Info [NewsController.store] Thread ' . $request->input('newsEditorThread'));

            $validatedData = NewsController::__doStoreValidate($request);

            $newImage = null;
            if ($request->hasFile('itemImage') && $request->file('itemImage')->isValid()) {
                $relPath = $request->itemImage->store('images/cms/news-pg');
                $newImage = '/images/storage/' . $relPath;
            }

            $aNewsItem = News::make([
                'title' => $validatedData['title'],
                'posting_date' => $validatedData['postingDate'],
                'image' => $newImage,
            ]);
            $this->__doFillLocalizedFields($validatedData, $aNewsItem);
            $aNewsCategory = Category::newsCategoryDictItem();
            $aNewsCategory->news()->save($aNewsItem);

            return view('cms.admin.news.news-update-form')->with(
                [
                    'categoryTitle' => 'NEWS',
                    'item' => new NewsShowResource(News::findOrFail($aNewsItem->id)),
                    'isReadOnly' => false,
                    'messages' => [
                        'News was successfully stored'
                    ]
                ]
            );
        } else {
            Log::info('Info [NewsController.store] For a plain USER a news update is denied');
            return view('app');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        if (request()->user()->hasRole(UserRole::$USER_ROLE_DICT[0]) || request()->user()->hasRole(UserRole::$USER_ROLE_DICT[1])) {
            return view('cms.admin.news.news-update-form')->with(
                [
                    'categoryTitle' => 'NEWS',
                    'item' => News::findOrFail($id),
                    'isReadOnly' => true
                ]
            );
        } else {
            Log::info('Info [NewsController.show] For guest USER the news show view is denied to present');
            return view('app');
        }
    }

    public function edit($id)
    {
        if (request()->user()->hasRole(UserRole::$USER_ROLE_DICT[0])) {
            Log::info('Info [NewsController.edit] user is Admin Role');
            return view('cms.admin.news.news-update-form')->with(
                [
                    'categoryTitle' => 'NEWS',
                    'item' => new NewsShowResource(News::findOrFail($id)),
                    'isReadOnly' => false
                ]
            );
        } else {
            Log::info('Info [NewsController.edit] For plain USER the news show view has not defined yet');
            return view('app');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->method() === "GET") {
            return view('cms.admin.news.news-update-form')->with(
                [
                    'categoryTitle' => 'NEWS',
                    'item' => new NewsShowResource(News::findOrFail($id)),
                    'isReadOnly' => false,
                ],
            );
        }
        if (request()->user()->hasRole(UserRole::$USER_ROLE_DICT[0])) {
            $validatedData = $this->__doUpdateValidate($request);

            $newImage = null;
            if ($request->hasFile('itemImage') && $request->file('itemImage')->isValid()) {
                Log::info('Info [NewsController.update] User uploaded the file');
                $newImage = '/images/storage/' . $request->itemImage->store('images/cms/news-pg/');
                Log::info('Info [NewsController.update] User uploaded the file, file is stored ' . $newImage);
            }

            $anUpdateNews = News::findOrFail($id);
            $oldImage = $anUpdateNews->image;
            $anUpdateNews = News::findOrFail($id)->fill([
                'posting_date' => $validatedData['postingDate'],
                'image' => $newImage ? $newImage : $oldImage,
            ]);
            $this->__doFillLocalizedFields($validatedData, $anUpdateNews);

            $anUpdateNews->save();
            return view('cms.admin.news.news-update-form')->with(
                [
                    'categoryTitle' => 'NEWS',
                    'item' => new NewsShowResource(News::findOrFail($anUpdateNews->id)),
                    'isReadOnly' => false,
                    'messages' => [
                        'News was successfully stored'
                    ]
                ],
            );
        } else {
            Log::info('Info [NewsController.update] For a plain USER a news update is denied');
            return view('app');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        News::destroy($id);
        Log::info('INFO [NewsController::destroy] News id ' . $id);
        return redirect()->route(
            'admin.dashboard.news'
        )->with(
            [
                'categories' => CategoryResource::collection(Category::categoryDictItems()),
                'activeCategory' => new CategoryResource(Category::newsCategoryDictItem()),
                'items' => NewsIndexResource::collection(News::paginate(3)),
            ]
        );
    }

    private static function __doStoreValidate(Request $request)
    {
        return $request->validate([
            'title' => 'required|max:96',
            'postingDate' => 'required|before_or_equal:now',
            'itemImage' => 'image|max:10128|required',
            'ckeditor4Thread' => 'required|string',
            'langInputField' => 'required|string|exists:languages,lang'
        ]);
    }

    private static function __doUpdateValidate(Request $request)
    {
        return $request->validate([
            'title' => 'required|max:96',
            'postingDate' => 'required|before_or_equal:now',
            'oldItemImagePath' => 'required|string',
            'ckeditor4Thread' => 'required|string',
            'langInputField' => 'required|string|exists:languages,lang'
        ]);
    }

    private static function __doFillLocalizedFields(array $validatedData, News &$aNewsItem)
    {
        $selectedLang = $validatedData['langInputField'];
        $aNewsItem->title = [
            $selectedLang => $validatedData['title'],
        ];
        $aNewsItem->thread = [
            $selectedLang => $validatedData['ckeditor4Thread'],
        ];
    }
}
