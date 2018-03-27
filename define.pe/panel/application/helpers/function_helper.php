<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


if (!function_exists('_build_json')) {

    function _build_json($_status = FALSE, $_data = FALSE, $_controller = TRUE) {

        $CI = &get_instance();

        if (!(boolean) $_status) {
            if (isset($_data['message_identifier'])) {
                if ((boolean) $_controller)
                    $_data['message'] = $CI->lang->line($CI->data['controller'] . $_data['message_identifier']);
                else
                    $_data['message'] = $CI->lang->line($_data['message_identifier']);
            } else
                $_data['message'] = $CI->lang->line('_cannot_complete');
        }

        $_data['status'] = $_status;

        exit(json_encode($_data));
    }

}

if (!function_exists('_verify_csrf')) {

    function _verify_csrf($_token) {

        $CI = &get_instance();

        if (trim($_token) === '')
            _build_json(FALSE, array('message_identifier' => '_invalid_format_token'), FALSE);

        if (!$CI->basicauth->verify_csrf($_token))
            _build_json(FALSE, array('message_identifier' => '_invalid_token'), FALSE);
    }

}

if (!function_exists('_is_ajax_request')) {

    function _is_ajax_request() {

        $CI = &get_instance();

        if (!$CI->input->is_ajax_request())
            _build_json();
    }

}

if (!function_exists('_is_post')) {

    function _is_post() {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST')
            _build_json();
    }

}


if (!function_exists('_validate_empty')) {

    function _validate_empty($_str, $_id_field, $_message_identifier) {

        $CI = &get_instance();

        $_str = trim($_str);
        if (empty($_str))
            _build_json(FALSE, array('id' => $_id_field, 'message_identifier' => $_message_identifier));

        return strtoupper($_str);
    }

}

if (!function_exists('_validate_length')) {

    function _validate_length($_str, $_length, $_id_field, $_message_identifier) {

        $CI = &get_instance();

        $_str = _validate_empty($_str, $_id_field, $_message_identifier);

        if (strlen($_str) !== $_length)
            _build_json(FALSE, array('id' => $_id_field, 'message_identifier' => $_message_identifier));

        return $_str;
    }

}

if (!function_exists('_validate_numeric')) {

    function _validate_numeric($_str, $_id_field, $_message_identifier) {

        $CI = &get_instance();

        $_str = _validate_empty($_str, $_id_field, $_message_identifier);

        if (!is_numeric(($_str)))
            _build_json(FALSE, array('id' => $_id_field, 'message_identifier' => $_message_identifier));

        return $_str;
    }

}

if (!function_exists('_validate_email')) {

    function _validate_email($_str, $_id_field, $_message_identifier) {

        $CI = &get_instance();

        $_str = _validate_empty($_str, $_id_field, $_message_identifier);

        if (!filter_var($_str, FILTER_VALIDATE_EMAIL))
            _build_json(FALSE, array('id' => $_id_field, 'message_identifier' => $_message_identifier));

        return strtoupper($_str);
    }

}

if (!function_exists('_validate_if_exists')) {

    function _validate_if_exists($_object, $_id, $_id_field, $_message_identifier) {

        $CI = &get_instance();

        if ($_id) {
            if ($_object && (int) $_id !== (int) $_object->id)
                _build_json(FALSE, array('id' => $_id_field, 'message_identifier' => $_message_identifier));
        }
        else {
            if ($_object)
                _build_json(FALSE, array('id' => $_id_field, 'message_identifier' => $_message_identifier));
        }
    }

}




if (!function_exists('_validate_date')) {

    function _validate_date($_str, $_id_field, $_message_identifier, $_format) {

        $CI = &get_instance();

        $_str = _validate_empty($_str, $_id_field, $_message_identifier);

        $_date = DateTime::createFromFormat($_format, $_str);

        if (!$_date)
            _build_json(FALSE, array('id' => $_id_field, 'message_identifier' => $_message_identifier));

        return $_date->format('Y-m-d');
    }

}
 




if (!function_exists('_validate_decimal')) {

    function _validate_decimal($_str, $_id_field, $_message_identifier) {

        $CI = &get_instance();

        $_str = trim($_str);

        $_str = _validate_empty($_str, $_id_field, $_message_identifier);

        $_str = _validate_numeric($_str, $_id_field, $_message_identifier);

        if (!is_float((float) $_str + 0))
            _build_json(FALSE, array('id' => $_id_field, 'message_identifier' => $_message_identifier));

        return $_str;
    }

}

if (!function_exists('_validate_ruc')) {

    function _validate_ruc($_str, $_id_field, $_message_identifier) {

        $CI = &get_instance();

        $_str = _validate_empty($_str, $_id_field, $_message_identifier);

        if (!(substr($_str, 0, 2) === '20' || substr($_str, 0, 2) === '10'))
            _build_json(FALSE, array('id' => $_id_field, 'message_identifier' => $_message_identifier));

        return $_str;
    }

}

if (!function_exists('_format_date')) {

    function _format_date($_str, $_pattern) {

        $_str = trim($_str);
        if (empty($_str))
            return null;

        return date($_pattern, strtotime($_str));
    }

}


if (!function_exists('_format_decimal')) {

    function _format_decimal($_str, $_number_dec = 2) {

        return number_format($_str, $_number_dec, '.', '');
    }

}

if (!function_exists('_format_strpad')) {

    function _format_strpad($_count, $_size = 5) {
        if ((int) $_count === 0)
            $_count = 1;
        return str_pad($_count, $_size, "0", STR_PAD_LEFT);
    }

}


if (!function_exists('_diff_date')) {

    function _diff_date($_date_1, $_date_2) {

        $datetime1 = new DateTime($_date_1);
        $datetime2 = new DateTime($_date_2);
        $interval = $datetime1->diff($datetime2);
        if ($_date_1 <= $_date_2) {
            return $interval->days;
        } else {
            return '-' . $interval->days;
        }
    }

}






if (!function_exists('_build_pagination')) {

    function _build_pagination($_url, $_count, $_segment, $_limit = 10) {

        $CI = &get_instance();

        $CI->load->library('pagination');

        $config['base_url'] = $_url;
        $config['total_rows'] = $_count;
        $config['per_page'] = $_limit;
        $config['uri_segment'] = $_segment;

        $CI->pagination->initialize($config);
        return $CI->pagination->create_links();
    }

}

if (!function_exists('build_select')) {

    function _build_select_options($_data = array(), $_value_key, $_name_key, $_selected = FALSE) {

        if (empty($_value_key))
            return '';

        if (empty($_name_key))
            return '';


        $_html = '<option value="">-- Seleccione --</option>';

        if ($_data) {
            $_count_data = count($_data);
            for ($_i = 0; $_i < $_count_data; $_i++) {
                $_data_item = $_data[$_i];


                $_selected_value = '';
                if ($_selected) {
                    if ($_selected == $_data_item->$_value_key)
                        $_selected_value = 'selected=""';
                }


                $_html .= '<option ' . $_selected_value . ' value="' . $_data_item->$_value_key . '">' . $_data_item->$_name_key . '</option>';
            }
        }
        return $_html;
    }

}

if (!function_exists('_compare_select')) {

    function _compare_select($c_to, $c_end) {

        if ($c_to !== $c_end)
            return '';
        else
            return 'selected';
    }

}


if (!function_exists('_geCountMonthDays')) {

    function _geCountMonthDays($Month, $Year) {

        if (is_callable("cal_days_in_month"))
            return cal_days_in_month(CAL_GREGORIAN, $Month, $Year);

        return date("d", mktime(0, 0, 0, $Month + 1, 0, $Year));
    }

}

if (!function_exists('_getNameDay')) {

    function _getNameDay($_date) {



        $d = strtotime($_date);


        switch (date('w', $d)) {
            case 0: return "Do";
                break;
            case 1: return "Lu";
                break;
            case 2: return "Ma";
                break;
            case 3: return "Mi";
                break;
            case 4: return "Ju";
                break;
            case 5: return "Vi";
                break;
            case 6: return "Sa";
                break;
        }
    }

}
if (!function_exists('_getNameMonth')) {

    function _getNameMonth($_m) {
        $_r = '';
        if ($_m == '01')
            $_r = 'ENERO';
        elseif ($_m == '02')
            $_r = 'FEBRERO';
        elseif ($_m == '03')
            $_r = 'MARZO';
        elseif ($_m == '04')
            $_r = 'ABRIL';
        elseif ($_m == '05')
            $_r = 'MAYO';
        elseif ($_m == '06')
            $_r = 'JUNIO';
        elseif ($_m == '07')
            $_r = 'JULIO';
        elseif ($_m == '08')
            $_r = 'AGOSTRO';
        elseif ($_m == '09')
            $_r = 'SEPTIEMBRE';
        elseif ($_m == '10')
            $_r = 'OCTUBRE';
        elseif ($_m == '11')
            $_r = 'NOVIEMBRE';
        else
            $_r = 'DICIEMBRE';

        return $_r;
    }

}
if (!function_exists('_getCalendar')) {

    function _getCalendar($_mes, $_year) {
        $_numDay = _geCountMonthDays($_mes, $_year);
        $data = array();

        for ($x = 1; $x <= $_numDay; $x++) {
            $_format_date = $x . '-' . $_mes . '-' . $_year;

            $data[] = _getNameDay($_format_date);
        }
        return $data;
    }

}
 


if (!function_exists('_getCalendarCurrent')) {

    function _getCalendarCurrent() {
        $_format_date = date('d-m-Y');

        return (object) array('name' => _getNameDay($_format_date), 'day' => (date("d", strtotime($_format_date))));
    }

}




if (!function_exists('_get_date_first_last_month')) {

    function _get_date_first_last_month($month, $year) {
        if (empty($month))
            return false;

        if (empty($year))
            return false;

        $day = date("d", mktime(0, 0, 0, $month + 1, 0, $year));

        return (object) array(
                    'date_ini' => date('Y-m-d', mktime(0, 0, 0, $month, 1, $year)),
                    'date_end' => date('Y-m-d', mktime(0, 0, 0, $month, $day, $year))
        );
    }

}


if (!function_exists('_get_number_date_first_last_month')) {

    function _get_number_date_first_last_month($month, $year) {
        if (empty($month))
            return false;

        if (empty($year))
            return false;
        $day = date("d", mktime(0, 0, 0, $month + 1, 0, $year));
        return (object) array(
                    'day_ini' => date('d', mktime(0, 0, 0, $month, 1, $year)),
                    'day_end' => date('d', mktime(0, 0, 0, $month, $day, $year))
        );
    }

}



if (!function_exists('_isToupper')) {

    function _isToupper($_str) {

        return strtoupper(trim($_str));
    }

}

if (!function_exists('_format_d')) {
     function _format_d($_format,$_str) {
        
        $_date = DateTime::createFromFormat($_format, $_str);
        return $_date->format('Y-m-d');
    }
}

if (!function_exists('_getPrivileges')) {

    function _getPrivileges() {
        $CI = get_instance();

      
        $CI->load->model('master/users_model');
        $_user_group_id = $CI->data['logged_user_info']->user_group_id;
        return $CI->users_model->get_user_groups_by_id($_user_group_id);

}

}
        
if (!function_exists('_diffDays')) {
    function _diffDays($date_ini,$date_end)
    {
        
        $days   = (strtotime($date_ini)-strtotime($date_end))/86400;
        $days   = abs($days); $days = floor($days);     
        return $days;
    }
}

if (!function_exists('_SpanishDate')) {
    function _SpanishDate($raw_date)
    {   
            if (empty($raw_date))
                return FALSE;
            

            $year = date('Y',strtotime($raw_date));
            $month = date('m',strtotime($raw_date));
            $day = date('d',strtotime($raw_date));
            switch ($month){
                case "01"; $l_mes = "Enero"; break;
                case "02"; $l_mes = "Febrero"; break;
                case "03"; $l_mes = "Marzo"; break;
                case "04"; $l_mes = "Abril"; break;
                case "05"; $l_mes = "Mayo"; break;
                case "06"; $l_mes = "Junio"; break;
                case "07"; $l_mes = "Julio"; break;
                case "08"; $l_mes = "Agosto"; break;
                case "09"; $l_mes = "Septiembre"; break;
                case "10"; $l_mes = "Octubre"; break;
                case "11"; $l_mes = "Noviembre"; break;
                case "12"; $l_mes = "Diciembre"; break;
            }
            $l_emp = $day." de ".$l_mes." del ".$year;
            return $l_emp;

    }
}


if (!function_exists('_diffDateText')) {
    function _diffDateText($date_ini,$date_end)
    {
        
            $fecha1 = new DateTime($date_ini);
            $fecha2 = new DateTime($date_end);
            $fecha = $fecha1->diff($fecha2);
            return  $fecha->y .' AÑOS, '.$fecha->m.' MESES, '.$fecha->d.'DIAS';
            
    }
}
if (!function_exists('_getYear')) {
    function _getYear($date){
        if(!empty($date)){
            list($year,$month,$day) = explode("-",$date);
            $year_diff  = date("Y") - $year;
            $month_diff = date("m") - $month;
            $day_diff   = date("d") - $day;
            if ($day_diff < 0 || $month_diff < 0) $year_diff--;
            return $year_diff;    
        }
        return '';
    }
}


 
 

if (!function_exists('_getHorasExtras')) {

    function _getHorasExtras($horas) {
        $ht = 0;
        $ht_25 = 0;
        $ht_35 = 0;

        $h_25 = false;
        $h_35 = false;

        if ($horas < 8 || ($horas % 8) == 0) {
            $ht = $horas;
        } else {
            while ($horas > 0) {
                if (!$h_25) {
                    if ($horas <= 8) {
                        $ht = $horas;
                        break;
                    } else {
                        $ht = 8;
                        $horas -= 8;
                        $h_25 = true;
                    }
                } else {
                    if (!$h_35) {
                        if ($horas <= 2) {
                            $ht_25 = $horas;
                            break;
                        } else {
                            $ht_25 = 2;
                            $horas -= 2;
                            $h_35 = true;
                        }
                    } else {
                        $ht_35 = $horas;
                        break;
                    }
                }
            }
        }

        return (object)array('ht_25'=>$ht_25,'ht_35'=>$ht_35);
    }
}