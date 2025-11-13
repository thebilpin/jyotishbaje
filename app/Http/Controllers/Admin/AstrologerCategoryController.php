<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AstrologerCategory;
use App\Models\CourseCategory;
use App\Models\PujaCategory;
use App\Models\PujaSubCategory;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Helpers\StorageHelper;

class AstrologerCategoryController extends Controller
{
    public $limit = 15;
    public $paginationStart;
    public $path;
    public function addAstrolgerCategory()
    {
        return view('pages.astrologer-category-list');
    }


public function addAstrolgerCategoryApi(Request $req)
{
    try {
        // Validate input
        $validator = Validator::make($req->all(), [
            'name' => 'required|unique:astrologer_categories',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->getMessageBag()->toArray(),
            ]);
        }

        // Check if user is logged in
        if (!Auth::guard('web')->check()) {
            return redirect('/admin/login');
        }

        // Create category first (to get the ID)
        $astrologerCategory = AstrologerCategory::create([
            'name' => $req->name,
            'image' => '',
            'displayOrder' => null,
            'createdBy' => Auth()->user()->id,
            'modifiedBy' => Auth()->user()->id,
        ]);

        $path = null;

        // If image uploaded, handle upload via StorageHelper
        if ($req->hasFile('image')) {
            $file = $req->file('image');
            $extension = $file->getClientOriginalExtension();
            $time = Carbon::now()->timestamp;
            $fileName = "astrologerCategory_{$astrologerCategory->id}_{$time}." . $extension;

            //  Upload to active storage (DigitalOcean / S3 / Local)
            $uploadedPath = StorageHelper::uploadToActiveStorage($file, "astrologer_categories/{$fileName}");
            $path = $uploadedPath;
        }

        // Save final image path
        $astrologerCategory->image = $path;
        $astrologerCategory->update();

        return redirect()->route('astrologerCategories')->with('message', 'Data added Successfully');
    } catch (Exception $e) {
        return back()->with('error', 'Something went wrong: ' . $e->getMessage());
    }
}


    public function getAstrolgerCategory(Request $request)
    {
        try {
            if (Auth::guard('web')->check()) {
                $page = $request->page ? $request->page : 1;
                $paginationStart = ($page - 1) * $this->limit;
                $categories = AstrologerCategory::query();
                $categoryCount = $categories->count();
                $categories->orderBy('id', 'DESC');
                $categories->skip($paginationStart);
                $categories->take($this->limit);
                $categories = $categories->get();
                $totalPages = ceil($categoryCount / $this->limit);
                $totalRecords = $categoryCount;
                $start = ($this->limit * ($page - 1)) + 1;
                $end = ($this->limit * ($page - 1)) + $this->limit < $totalRecords
                ? ($this->limit * ($page - 1)) + $this->limit : $totalRecords;
                return view(
                    'pages.astrologer-category-list',
                    compact('categories', 'totalPages', 'totalRecords', 'start', 'end', 'page'));
            } else {
                return redirect('/admin/login');
            }
        } catch (Exception $e) {
            return dd($e->getMessage());
        }
    }

    public function editAstrolgerCategory()
    {
        return view('pages.astrologer-category-list');
    }



public function editAstrolgerCategoryApi(Request $request)
{
    try {
        // Check login
        if (!Auth::guard('web')->check()) {
            return redirect('/admin/login');
        }

        // Find the category
        $astrologerCategory = AstrologerCategory::find($request->filed_id);
        if (!$astrologerCategory) {
            return back()->with('error', 'Astrologer category not found!');
        }

        $path = $astrologerCategory->image; // default old image

        // Handle new image upload
        if ($request->hasFile('image')) {
            // Delete old image from external storage (if exists)
            if ($astrologerCategory->image) {
                StorageHelper::deleteFromActiveStorage($astrologerCategory->image);
            }

            // Prepare new file name
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $time = Carbon::now()->timestamp;
            $fileName = "astrologerCategory_{$astrologerCategory->id}_{$time}." . $extension;

            // Upload to external storage (Spaces / S3 / Local)
            $path = StorageHelper::uploadToActiveStorage($file, "astrologer_categories/{$fileName}");
        }

        // Update data
        $astrologerCategory->update([
            'name' => $request->name,
            'image' => $path,
            'displayOrder' => null,
            'modifiedBy' => Auth()->user()->id,
        ]);

        return redirect()->route('astrologerCategories')->with('message', 'Category updated successfully');
    } catch (Exception $e) {
        return back()->with('error', 'Something went wrong: ' . $e->getMessage());
    }
}


    public function astrologyCategoryStatus(Request $request)
    {
        return view('pages.astrologer-category-list');
    }

    public function astrologyCategoryStatusApi(Request $request)
    {
        try {
            $astrologerCategory = AstrologerCategory::find($request->status_id);
            if (Auth::guard('web')->check()) {
                $astrologerCategory->isActive = !$astrologerCategory->isActive;
                $astrologerCategory->update();
                return redirect()->route('astrologerCategories');
            } else {
                return redirect('/admin/login');
            }
        } catch (Exception $e) {
            return dd($e->getMessage());
        }
    }

    #--------------------------------------------------------------------------------------------------------------------------------

    public function pujaCategoryList(Request $request)
    {


        try {
            if (Auth::guard('web')->check()) {
                $page = $request->page ? $request->page : 1;
                $paginationStart = ($page - 1) * $this->limit;
                $categories = PujaCategory::query();
                $categoryCount = $categories->count();
                $categories->orderBy('id', 'DESC');
                $categories->skip($paginationStart);
                $categories->take($this->limit);
                $categories = $categories->get();
                $totalPages = ceil($categoryCount / $this->limit);
                $totalRecords = $categoryCount;
                $start = ($this->limit * ($page - 1)) + 1;
                $end = ($this->limit * ($page - 1)) + $this->limit < $totalRecords
                ? ($this->limit * ($page - 1)) + $this->limit : $totalRecords;
                return view(
                    'pages.puja-category',
                    compact('categories', 'totalPages', 'totalRecords', 'start', 'end', 'page'));
            } else {
                return redirect('/admin/login');
            }
        } catch (Exception $e) {
            return dd($e->getMessage());
        }

    }

    #-------------------------------------------------------------------------------------------------------------------------
    public function addPujaCategory(Request $req)
    {
        try {

            $validator = Validator::make($req->all(), [
                'name' => 'required|unique:puja_categories',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->getMessageBag()->toArray(),
                ]);
            }
            if (Auth::guard('web')->check()) {
                if (request('image')) {
                    $image = base64_encode(file_get_contents($req->file('image')));
                } else {
                    $image = null;
                }
                $pujaCategory = PujaCategory::create([
                    'name' => $req->name,
                    'image' => '',
                    'displayOrder' => null,
                    'createdBy' => Auth()->user()->id,
                    'modifiedBy' => Auth()->user()->id,
                ]);
                if ($image) {
                    if (Str::contains($image, 'storage')) {
                        $path = $image;
                    } else {
                        $time = Carbon::now()->timestamp;
                        $destinationpath = 'public/storage/images/';
                        $imageName = 'pujaCategory_' . $pujaCategory->id;
                        $path = $destinationpath . $imageName . $time . '.png';
                        File::delete($path);
                        file_put_contents($path, base64_decode($image));
                    }
                } else {
                    $path = null;
                }
                $pujaCategory->image = $path;
                $pujaCategory->update();
                return redirect()->route('puja-categories-list')->with('message', 'Data added Successfully');
            } else {
                return redirect('/admin/login');
            }
        } catch (Exception $e) {
            return dd($e->getMessage());
        }
    }

    #----------------------------------------------------------------------------------------------------------------------------------
    public function editPujaCategory(Request $request)
    {
        try {
            // return back()->with('error', 'This Option is disabled for Demo!');
            if (Auth::guard('web')->check()) {

                $pujaCategory = PujaCategory::find($request->filed_id);
                if (request('image')) {
                    $image = base64_encode(file_get_contents($request->file('image')));
                } elseif ($pujaCategory->image) {
                    $image = $pujaCategory->image;
                } else {
                    $image = null;
                }

                if ($pujaCategory) {
                    if ($image) {
                        if (Str::contains($image, 'storage')) {
                            $path = $image;
                        } else {
                            $time = Carbon::now()->timestamp;
                            $destinationpath = 'public/storage/images/';
                            $imageName = 'pujaCategory_' . $request->filed_id;
                            $path = $destinationpath . $imageName . $time . '.png';
                            File::delete($pujaCategory->image);
                            file_put_contents($path, base64_decode($image));
                        }
                    } else {
                        $path = null;
                    }
                    $pujaCategory->name = $request->name;
                    $pujaCategory->image = $path;
                    $pujaCategory->update();
                    return redirect()->route('puja-categories-list');
                }
            } else {
                return redirect('/admin/login');
            }

        } catch (Exception $e) {
            return dd($e->getMessage());
        }
    }

    #-----------------------------------------------------------------------------------------------------------------------------------
    public function PujaCategoryStatus(Request $request)
    {
        try {
            $astrologerCategory = PujaCategory::find($request->status_id);
            if (Auth::guard('web')->check()) {
                $astrologerCategory->isActive = !$astrologerCategory->isActive;
                $astrologerCategory->update();
                return redirect()->route('puja-categories-list');
            } else {
                return redirect('/admin/login');
            }
        } catch (Exception $e) {
          return back()->with('error',$e->getMessage());
        }
    }

    #------------------------------------------------------------------------------------------------------------------------------------
    public function pujaSubCategories(Request $request)
    {
        try {
            if (Auth::guard('web')->check()) {
                $page = $request->page ? $request->page : 1;
                $paginationStart = ($page - 1) * $this->limit;


                $AllCategories= PujaCategory::all();

                // Query to join partnerCategory with partnerSubCategory
                $categories = PujaSubCategory::query()
                ->join('puja_categories', 'puja_categories.id', '=', 'puja_subcategories.category_id')
                ->select('puja_categories.name as category_name', 'puja_subcategories.*')
                ->orderBy('puja_categories.id', 'DESC')
                ->skip($paginationStart)
                ->take($this->limit)
                ->get();

                $categoryCount = PujaSubCategory::count();
                $totalPages = ceil($categoryCount / $this->limit);
                $totalRecords = $categoryCount;
                $start = ($this->limit * ($page - 1)) + 1;
                $end = min(($this->limit * ($page - 1)) + $this->limit, $totalRecords);

                return view('pages.puja-subcategory', compact('AllCategories','categories', 'totalPages', 'totalRecords', 'start', 'end', 'page'));
            } else {
                return redirect('/admin/login');
            }
        } catch (Exception $e) {
           return back()->with('error',$e->getMessage());
        }
    }
    #------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    public function addPujaSubCategory(Request $req)
    {

        try {
            $validator = Validator::make($req->all(), [
                'categoriesId' => 'required',
                'name' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->getMessageBag()->toArray(),
                ]);
            }
            if (Auth::guard('web')->check()) {
                if (request('image')) {
                    $image = base64_encode(file_get_contents($req->file('image')));
                } else {
                    $image = null;
                }
                $pujaCategory = PujaSubCategory::create([
                    'category_id'=>$req->categoriesId,
                    'name' => $req->name,
                    'image' => '',
                ]);
                if ($image) {
                    if (Str::contains($image, 'storage')) {
                        $path = $image;
                    } else {
                        $time = Carbon::now()->timestamp;
                        $destinationpath = 'public/storage/images/';
                        $imageName = 'pujaSubCategory_' . $pujaCategory->id;
                        $path = $destinationpath . $imageName . $time . '.png';
                        File::delete($path);
                        file_put_contents($path, base64_decode($image));
                    }
                } else {
                    $path = null;
                }
                $pujaCategory->image = $path;
                $pujaCategory->update();
                return redirect()->route('puja-subcategories-list')->with('message', 'Data added Successfully');
            } else {
                return redirect('/admin/login');
            }
        } catch (Exception $e) {
           return back()->with('error',$e->getMessage());
        }
    }
    #--------------------------------------------------------------------------------------------------------------------------------------------------------

    public function editPujaSubCategory(Request $request)
    {
        try {
            if (Auth::guard('web')->check()) {
                $PujaSubCategory = PujaSubCategory::find($request->filed_id);
                if (request('image')) {
                    $image = base64_encode(file_get_contents($request->file('image')));
                } elseif ($PujaSubCategory->image) {
                    $image = $PujaSubCategory->image;
                } else {
                    $image = null;
                }

                if ($PujaSubCategory) {
                    if ($image) {
                        if (Str::contains($image, 'storage')) {
                            $path = $image;
                        } else {
                            $time = Carbon::now()->timestamp;
                            $destinationpath = 'public/storage/images/';
                            $imageName = 'PujaSubCategory_' . $request->filed_id;
                            $path = $destinationpath . $imageName . $time . '.png';
                            File::delete($PujaSubCategory->image);
                            file_put_contents($path, base64_decode($image));
                        }
                    } else {
                        $path = null;
                    }
                    // dd($request->categoriesId);
                    $PujaSubCategory->category_id = $request->categoriesId;
                    $PujaSubCategory->name = $request->name;
                    $PujaSubCategory->image = $path;
                    $PujaSubCategory->update();
                    return redirect()->route('puja-subcategories-list');
                }
            } else {
                return redirect('/admin/login');
            }

        } catch (Exception $e) {
           return back()->with('error',$e->getMessage());
        }
    }

    #----------------------------------------------------------------------------------------------------------------------------------------------------------
    public function PujaSubCategoryStatus(Request $request)
    {

        try {
            $PujaSubCategory = PujaSubCategory::find($request->status_id);
            if (Auth::guard('web')->check()) {
                $PujaSubCategory->isActive = !$PujaSubCategory->isActive;
                $PujaSubCategory->update();
                return redirect()->route('puja-subcategories-list');
            } else {
                return redirect('/admin/login');
            }
        } catch (Exception $e) {
            return back()->with('error',$e->getMessage());
        }
    }
    #-----------------------------------------------------------------------------------------------------------------------------------------

     #--------------------------------------------------------------------------------------------------------------------------------

     public function courseCategoryList(Request $request)
     {


         try {
             if (Auth::guard('web')->check()) {
                 $page = $request->page ? $request->page : 1;
                 $paginationStart = ($page - 1) * $this->limit;
                 $categories = CourseCategory::query();
                 $categoryCount = $categories->count();
                 $categories->orderBy('id', 'DESC');
                 $categories->skip($paginationStart);
                 $categories->take($this->limit);
                 $categories = $categories->get();
                 $totalPages = ceil($categoryCount / $this->limit);
                 $totalRecords = $categoryCount;
                 $start = ($this->limit * ($page - 1)) + 1;
                 $end = ($this->limit * ($page - 1)) + $this->limit < $totalRecords
                 ? ($this->limit * ($page - 1)) + $this->limit : $totalRecords;
                 return view(
                     'pages.course-category',
                     compact('categories', 'totalPages', 'totalRecords', 'start', 'end', 'page'));
             } else {
                 return redirect('/admin/login');
             }
         } catch (Exception $e) {
             return back()->with('error',$e->getMessage());
         }

     }

     #-------------------------------------------------------------------------------------------------------------------------
     public function addCourseCategory(Request $req)
     {
         try {

             $validator = Validator::make($req->all(), [
                 'name' => 'required|unique:course_categories',
             ]);
             if ($validator->fails()) {
                 return response()->json([
                     'error' => $validator->getMessageBag()->toArray(),
                 ]);
             }
             if (Auth::guard('web')->check()) {
                 if (request('image')) {
                     $image = base64_encode(file_get_contents($req->file('image')));
                 } else {
                     $image = null;
                 }
                 $courseCategory = CourseCategory::create([
                     'name' => $req->name,
                     'image' => '',
                     'created_at' => Carbon::now(),
                     'updated_at' => Carbon::now(),
                 ]);
                 if ($image) {
                     if (Str::contains($image, 'storage')) {
                         $path = $image;
                     } else {
                         $time = Carbon::now()->timestamp;
                         $destinationpath = 'public/storage/images/';
                         $imageName = 'courseCategory_' . $courseCategory->id;
                         $path = $destinationpath . $imageName . $time . '.png';
                         File::delete($path);
                         file_put_contents($path, base64_decode($image));
                     }
                 } else {
                     $path = null;
                 }
                 $courseCategory->image = $path;
                 $courseCategory->update();
                 return redirect()->route('course-categories-list')->with('message', 'Data added Successfully');
             } else {
                 return redirect('/admin/login');
             }
         } catch (Exception $e) {
             return back()->with('error',$e->getMessage());
         }
     }

     #----------------------------------------------------------------------------------------------------------------------------------

    public function editCourseCategory(Request $request)
    {
        try {
            // return back()->with('error', 'This Option is disabled for Demo!');
            if (Auth::guard('web')->check()) {

                $courseCategory = CourseCategory::find($request->filed_id);
                if (request('image')) {
                    $image = base64_encode(file_get_contents($request->file('image')));
                } elseif ($courseCategory->image) {
                    $image = $courseCategory->image;
                } else {
                    $image = null;
                }

                if ($courseCategory) {
                    if ($image) {
                        if (Str::contains($image, 'storage')) {
                            $path = $image;
                        } else {
                            $time = Carbon::now()->timestamp;
                            $destinationpath = 'public/storage/images/';
                            $imageName = 'courseCategory_' . $request->filed_id;
                            $path = $destinationpath . $imageName . $time . '.png';
                            File::delete($courseCategory->image);
                            file_put_contents($path, base64_decode($image));
                        }
                    } else {
                        $path = null;
                    }
                    $courseCategory->name = $request->name;
                    $courseCategory->image = $path;
                    $courseCategory->update();
                    return redirect()->route('course-categories-list');
                }
            } else {
                return redirect('/admin/login');
            }

        } catch (Exception $e) {
            return back()->with('error',$e->getMessage());
        }
    }

    #-----------------------------------------------------------------------------------------------------------------------------------
    public function CourseCategoryStatus(Request $request)
    {
        try {
            $astrologerCategory = CourseCategory::find($request->status_id);
            if (Auth::guard('web')->check()) {
                $astrologerCategory->isActive = !$astrologerCategory->isActive;
                $astrologerCategory->update();
                return redirect()->route('course-categories-list');
            } else {
                return redirect('/admin/login');
            }
        } catch (Exception $e) {
            return back()->with('error',$e->getMessage());
        }
    }

    #------------------------------------------------------------------------------------------------------------------------------------


}
