<?php

namespace Team\Core\App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
class ModuleRequest extends FormRequest
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
                'name' => 'required|unique:team_modules',
                'table_name' => 'required|unique:team_modules',
                'field.*.name' => 'required|unique:team_elements,module_id,'.$req->id,
                'field.*.dataType' => 'required',
                'field.*.formElement' => 'required',
            ];
            if($req->id){
                $valid['name'] = 'required|unique:team_modules,name,'.$req->id;
                unset($valid['field.*.name']);
                unset($valid['table_name']);
            }
        }
        return $valid;
    }
}
