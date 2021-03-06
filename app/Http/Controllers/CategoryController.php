<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search=$request->search;
        $criteria=$request->criteria;
        if ($search=='') {
            $category=Category::orderBy('id','desc')->paginate(3);
        }else{
            $category=Category::where($criteria,'like','%'.$search.'%')->orderBy('id','desc')->paginate(3);
        }

        return[
            'pagination'=>[
                'total'=>$category->total(),
                'current_page'=>$category->currentPage(),
                'per_page'=>$category->perPage(),
                'last_page'=>$category->lastPage(),
                'from'=>$category->firstItem(),
                'to'=>$category->lastItem(),
            ],
            'category'=>$category
        ];
    }
    public function selectCategory(Request $request){
        $category=Category::where('active','=','1')
        ->select('id','name')->orderBy('name','asc')->get();

        return ['category'=>$category];
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStoreRequest $request)
    {
        
        $category =new Category();
        $category->code=$request->code;
        $category->name=$request->name;
        $category->description=$request->description;
        $category->active='1';
        $category->save();
    }

    

    public function update(CategoryUpdateRequest $request)
    {
        
        $category=Category::findOrFail($request->id);
        $category->code=$request->code;
        $category->name=$request->name;
        $category->description=$request->description;
        $category->active='1';
        $category->save();
    }

    
    public function disable(Request $request)
   {
       
        $category=Category::findOrFail($request->id);  
        $category->active='0';
        $category->save();
   }
   public function enable(Request $request)
   {
        $category=Category::findOrFail($request->id);
        $category->active='1';
        $category->save();
   }
}
