<?php

namespace Team\Core\App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
class AdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::guard('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $req)
    {
        $valid = [];
        if($req->isMethod('post')){
            $valid = [
                'name' => 'required',
                'email' => 'required|email|unique',
                'password' => 'required|min:6|max:20'
            ];
            if($req->id){
                $valid['email'] = 'required|email|unique:team_admins,id,'.$req->id;
                $valid['password'] = 'nullable|min:6|max:20';
            }
        }
        return $valid;
    }
}
