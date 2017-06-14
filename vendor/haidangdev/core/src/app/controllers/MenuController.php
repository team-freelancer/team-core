<?php
namespace Haidangdev\Core\App\Controllers;

use Illuminate\Http\Request;
use Haidangdev\Core\App\Controllers\AdminController;
use Haidangdev\Core\App\Models\Menu;

class MenuController extends AdminController
{
    public function index(Request $req){
        return view('admin::menu.index');
    }

    public function create(Request $req, $id = null){
        
        if($req->isMethod('get')){
            if($id){
                $action = 'Sửa';
                $menu = Menu::find($id);
            }
            return view('admin::menu.create', compact('menu', 'action'));
        }
        if($req->isMethod('post')){
            if($id){
                $menu = Menu::find($id);
            }else{
                $menu = new Menu;
            }
            $menu->title = $req->title;
            $menu->icon = $req->icon;
            $menu->style = $req->style;
            $menu->type = $req->type;
            $menu->link_to = $req->link_to;
            $lastMenu = Menu::select('sort')->orderBy('id', 'desc')->first();
            if($lastMenu){
                $menu->sort = $lastMenu->sort + 1;
            }else{
                $menu->sort = 1;
            }
            $menu->save();
            return redirect(url('admin/menu'));
        }
    }
}
