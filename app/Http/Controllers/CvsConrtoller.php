<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Support\Facades\Request;

class CvsConrtoller extends Controller
{
    protected $data = [];

    /**
     * @return mixed
     */
    public function index()
    {

        $this->data["sort"] = (Request::filled("sort")) ? Request::get("sort") : "created_at";
        $this->data["order"] = (Request::filled("order")) ? Request::get("order") : "desc";
        $this->data['per_page'] = (Request::filled("per_page")) ? Request::get("per_page") : 20;

        $query = Media::where('user_id', fauth()->id())->orderBy($this->data["sort"], $this->data["order"]);

        if (Request::filled("q")) {
            $q = urldecode(Request::get("q"));
            $query->search($q);
        }

        if (Request::filled("per_page")) {
            $this->data["per_page"] = $per_page = Request::get("per_page");
        } else {
            $this->data["per_page"] = $per_page = 200;
        }

        $this->data["cvs"] = $users = $query->paginate($per_page);
        return view("show-cvs", $this->data);
    }


    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        Media::where('id', $id)->delete();
        return redirect()->back()->with(['status'=>'Your Cv Deleted ']);
    }
}
