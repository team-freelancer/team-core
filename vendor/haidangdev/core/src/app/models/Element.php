<?php

namespace Haidangdev\Core\App\Models;

use Illuminate\Database\Eloquent\Model;
use \Form as Form;

class Element extends Model
{
    protected $table = 'team_elements';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        
    ];

    public static function createField($moduleID, $field = []){
        $data = [];
        foreach ($field as $key) {
            if(!isset($key['is_drop'])){
                array_push($data, [
                    'module_id' => $moduleID,
                    'element' => $key['formElement'],
                    'data_type' => $key['dataType'],
                    'default' => $key['default'],
                    'length' => $key['length'],
                    'field_title' => $key['title'],
                    'field_name' => $key['name'],
                    'is_hidden' => isset($key['hidden']) ? 1 : 0,
                    'is_filter' => isset($key['filter']) ? 1 : 0,
                    'is_search' => isset($key['search']) ? 1 : 0,
                    'is_manager' => isset($key['manager']) ? 1 : 0,
                    'is_required' => isset($key['required']) ? 1 : 0,
                    'is_unique' => isset($key['unique']) ? 1 : 0,
                    'link' => isset($key['link']) ? $key['link'] : '',
                ]);
            }
        }
        Element::insert($data);
        return 1;
    }

    public static function updateField($fields, $moduleID){
        foreach ($fields as $field) {
            if(isset($field['is_drop'])){
                Element::where('id', $field['id'])->delete();
            }else
            $data = [
                'element' => $field['formElement'],
                'data_type' => $field['dataType'],
                'default' => $field['default'],
                'length' => $field['length'],
                'field_title' => $field['title'],
                'field_name' => $field['name'],
                'is_hidden' => isset($field['hidden']) ? 1 : 0,
                'is_filter' => isset($field['filter']) ? 1 : 0,
                'is_search' => isset($field['search']) ? 1 : 0,
                'is_manager' => isset($field['manager']) ? 1 : 0,
                'is_required' => isset($field['required']) ? 1 : 0,
                'is_unique' => isset($field['unique']) ? 1 : 0,
                'link' => isset($field['link']) ? $field['link'] : '',
            ];
            if(isset($field['id'])){
                Element::where('id', $field['id'])->update($data);
            }else{
                $data['module_id'] = $moduleID;
                Element::insert($data);
            }
        }
        return 1;
    }

    public static function getByModule($moduleID){
        return Element::select('element', 'field_title', 'field_name')->where('module_id', $moduleID)->where('is_hidden', 0)->get();
    }

    public static function getForDataTable($moduleID){
        $columns = Element::select()->where('module_id', $moduleID)->get();
        $result = [
            'search' => [],
            'filter' => [],
            'dtColumns' => [],
            'dtElements' => [],
        ];
        foreach ($columns as $key) {
            if($key->is_search){
                $result['search'][] = (object)[
                    'field_name' => $key->field_name,
                    'field_title' => $key->field_title,
                ];
            }
            if($key->is_filter){
                
                $result['filter'][] = (object)[
                    'field_name' => $key->field_name,
                    'field_title' => $key->field_title,
                    'data' => Element::_mapSelect($key->data_type, $key->link)
                ];
            }
            if($key->is_manager){
                $result['dtColumns'][$key->field_name] = $key->field_title;
                $result['dtElements'][$key->field_name] = $key->element;
            }
        }
        return $result;
    }

    public static function forFetch($moduleID){
        $columns = Element::select('field_name', 'is_manager', 'is_filter', 'is_search')->where('module_id', $moduleID)->get();
        $result = [
            'select' => ['id'],
            'filter' => [],
            'search' => [],
        ];
        foreach ($columns as $key) {
            if($key->is_manager){
                $result['select'][] = $key->field_name;
            }
            if($key->is_filter){
                $result['filter'][] = $key->field_name;
            }
            if($key->is_search){
                $result['search'][] = $key->field_name;
            }
        }
        return $result;
    }

    public static function makeForm($elements = [], $data){
        $form = '';
        foreach ($elements as $key) {
            $form.= '<div class="form-group">';
            if($key->is_hidden == 0){
                if(!in_array((int)$key->element, [11, 12])){
                    $form.= '<label>'.$key->field_title.'</label>';
                }
                $field_name = $key->field_name;
                switch((int)$key->element){
                    case 0:
                        $form .= Form::text($field_name, old($field_name, isset($data) ? $data->$field_name : ''), ['class' => 'form-control', 'placeholder' => 'Nhập '.$key->field_title]);
                        break;
                    case 1:
                        $form .= Form::password($field_name, old($field_name, isset($data) ? $data->$field_name : ''), ['class' => 'form-control', 'placeholder' => 'Nhập '.$key->field_title]);
                        break;
                    case 2:
                        $form .= Form::email($field_name, old($field_name, isset($data) ? $data->$field_name : ''), ['class' => 'form-control', 'placeholder' => 'Nhập '.$key->field_title]);
                        break;
                    case 3:
                        $form .= Form::textarea($field_name, old($field_name, isset($data) ? $data->$field_name : ''), ['class' => 'form-control', 'placeholder' => 'Nhập '.$key->field_title]);
                        break;
                    case 4:
                        $form .= Form::textarea($field_name, old($field_name, isset($data) ? $data->$field_name : ''), ['class' => 'form-control team-use-ck', 'placeholder' => 'Nhập '.$key->field_title, 'id' => $field_name]);
                        break;
                    case 5:
                        $form .= Form::number($field_name, old($field_name, isset($data) ? $data->$field_name : ''), ['class' => 'form-control', 'placeholder' => 'Nhập '.$key->field_title]);
                        break;
                    case 6:
                        $checked = '';
                        if(isset($data)){
                            if($data->$field_name == 1){
                                $checked = 'checked';
                            }
                        }else{
                            if($key->default == 1){
                                $checked = 'checked';
                            }
                        }
                        $form.= '<div class="checkbox icheck"><label><input type="checkbox" name="'.$field_name.'" '.$checked.'> '.$key->field_title.'</label></div>';
                        break;
                    case 7:
                        
                        break;
                    case 8:
                        $form.= Form::text($field_name, old($field_name, isset($data) ? $data->$field_name : ''), ['class' => 'form-control team-datetimepicker', 'placeholder' => 'Nhập '.$key->field_title]);
                        break;
                    case 9:
                        $form.= Form::text($field_name, old($field_name, isset($data) ? $data->$field_name : ''), ['class' => 'form-control team-datetimepicker', 'placeholder' => 'Nhập '.$key->field_title, 'timepicker' => false]);
                        break;
                    case 10:
                        $form .= '<input name="team_files" type="file" class="file-loading team-file-upload" data='.(@$data->$field_name ? $data->$field_name : '""').' fieldName="'.$field_name.'">';
                        break;
                    case 11:
                        $form .= '<input name="team_files" type="file" multiple class="file-loading team-file-upload" data='.(@$data->$field_name ? $data->$field_name : '""').' fieldName="'.$field_name.'">';
                        break;
                    case 12:
                        $form .= Form::select($field_name, Element::_mapSelect($key->data_type, $key->link), old($field_name, isset($data) ? $data->$field_name : ''), ['class' => 'form-control', 'placeholder' => '---Chọn '.$key->field_title.'---']);
                        break;
                }
                $form.= '</div>';
            }
        }
        return $form;
    }

    protected static function _mapSelect($dataType, $link){
        if($link){
            $db = explode('.', $link);
            $data = \DB::table($db[0])->select($db[1], $db[2])->get();
            $dataFilter = [];
            foreach ($data as $k) {
                $dataFilter[$k->$db[1]] = $k->$db[2];
            }
        }
        else{
            switch($dataType){
                case 'boolean':
                    $dataFilter = [0 => 'Không kích hoạt', 1 => 'Kích hoạt'];
                    break;
                default:
                    $dataFilter = [];
                    break;
            }
        }
        return $dataFilter;
    }
}