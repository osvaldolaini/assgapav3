<?php

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

if (!function_exists('logging')) {
    //Log
    function logging($subject_id,$subject_type){
        if(Auth::user()->group->level <= 5){
            $logger = Activity::where('subject_id',$subject_id)
            ->where('subject_type',$subject_type)
            ->where('description','updated')->orderBy('id','desc')
            ->get(); //returns the last logged activity

            if($logger){
                $logs = '<div class="row">
                    <div class="col">
                        <ul class="list-group list-group-flush">';
                            foreach ($logger as $log){
                                $arr = array_merge(array_diff_assoc($log->properties['old'], $log->properties['attributes']), array_diff_assoc($log->properties['attributes'], $log->properties['old']));
                                $logs .='<li class="list-group-item">
                                    Modificado em '.date( 'd/m/Y H:i' , strtotime($log->updated_at)).
                                    ' por ' .loc_user($log->causer_id);
                                        if($arr){
                                            $logs .= '<br>Foram modificados : ';
                                            foreach ($arr as $key => $value){
                                                $logs .='<strong>['. $key .']</strong> para: '.$value.'; ' ;
                                            }
                                         }
                                         $logs .='</li>';
                            }
                            $logs .='</ul>
                    </div>
                </div>';
            }else{
                $logs = '';
            }
        }else{
            $logs = '';
        }
        return $logs;
    }
    function loc_user($id)
    {
        $user = User::select('name')->find($id);
        return $user->name;
    }
}

if (!function_exists('convertDate')) {
    function convertDate($date)
    {
        if ($date) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $date)
                ->format('d/m/Y H:i:s');
        } else {
            return '';
        }
    }
}
if (!function_exists('valueDB')) {
function valueDB($value)
    {
        if($value){
            str_replace(' ', '', $value);
            ltrim($value);
            $value = str_replace('.', '', $value);
            $value = str_replace(',', '.', $value);
            return str_replace(' ', '', $value);
        }
    }
}

