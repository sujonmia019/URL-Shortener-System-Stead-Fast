<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShortenRequest;
use App\Models\ShortURL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $getData = ShortURL::where('user_id',auth()->user()->id)->orderBy('id','desc');
            return DataTables::eloquent($getData)
                ->addIndexColumn()
                ->addColumn('short_url',function($row){
                    return '<a href="'.route('app.shorten.url-generate',$row->short_url).'" target="_blank">'.route('app.shorten.url-generate',$row->short_url).'</a>';
                })
                ->addColumn('long_url',function($row){
                    return '<a href="'.$row->long_url.'" target="_blank">'.$row->long_url.'</a>';
                })
                ->addColumn('action', function($row){
                    $action = '<button type="button" class="btn-style btn-style-danger delete_data" data-id="' . $row->id . '"><i class="fa fa-trash"></i></button>';
                    return $action;
                })
                ->rawColumns(['action','short_url','long_url'])
                ->make(true);
        }

        $data['breadcrumb'] = ['Dashboard'=>route('app.dashboard')];
        set_page_data('Dashboard','Dashboard');
        return view('home',$data);
    }

    public function shorten(ShortenRequest $request){
        if($request->ajax()){
            try {
                $collection = collect($request->validated());
                $short_url  = strtolower(Str::random(6));
                $collection = $collection->merge(with(['user_id'=>Auth::id(),'short_url'=>$short_url]));
                $result = ShortURL::create($collection->all());
                if($result){
                    return $this->response_json('success','Short URL Generate Successful.',['short_url'=>route('app.shorten.url-generate',$short_url)]);
                }else{
                    return $this->response_json('error','Short URL does not general!');
                }
            } catch (\Exception $e) {
                return $this->response_json('error',$e->getMessage());
            }
        }
    }

    public function shortenURL(string $url){
        $data = ShortURL::where('short_url',$url)->firstOrFail();
        if($data){
            $data->increment('clickable');
            return redirect($data->long_url);
        }else{
            return abort(404);
        }
    }


    public function delete(Request $request){
        if($request->ajax()){
            $data = ShortURL::where(['id'=>$request->id,'user_id'=>auth()->user()->id])->first();
            if($data){
                $data->delete();
                return $this->response_json('success','Short URL Deleted Successful.');
            }else{
                return $this->response_json('error','Short URL Not Deleted!');
            }
        }
    }



}
