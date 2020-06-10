<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
global $user_id;
global $user_name;
global $user_email;
global $user_role;
$menu_list = array();
global $menu_list;
$action_list = array();
global $action_list;
$filter_list = array();
global $filter_list;
$trigger_list = array();
global $trigger_list;
function do_action($action, $param)
{
    global $action_list;
    if (is_array($action_list[$action]))
    {
        $actions = $action_list[$action];
        usort($actions, "prioritycmp");
        foreach ($actions AS $action)
        {
            $function = $action["function"];
            $function($params);
        }
    }
    return ($param);
}
function do_trigger($trigger, $field, $id, $old_value)
{
    global $trigger_list;
    if (is_array($trigger_list[$trigger]))
    {
        $triggers = $trigger_list[$trigger];
        usort($triggers, "prioritycmp");
        foreach ($triggers AS $action)
        {
            $function = $action["function"];
            $function($id, $old_value);
        }
    }
    return ($param);
}
function prioritycmp($a, $b)
{
    if ($a["priority"] == $b["priority"])
    {
        return 0;
    }
    return ($a["priority"] < $b["priority"]) ? -1 : 1;
}
function do_filter($filter, $content)
{
    global $filter_list;
    if (is_array($filter_list[$filter]))
    {
        $filters = $filter_list[$filer];
        usort($filters, "prioritycmp");
        foreach ($filters AS $action)
        {
            $function = $action["function"];
            $content = $function($content);
        }
    }
    return ($content);
}
function add_action($action, $function, $priority = 1)
{
    global $action_list;
    $action_list[$action][] = array(
        'function' => $function,
        'priority' => $priority
    );
}
function add_trigger($table, $field, $function, $priority = 1)
{
    global $trigger_list;
    $trigger_list[$table . ":" . $field][] = array(
        'function' => $function,
        'priority' => $priority
    );
}
function add_filter($filter, $function, $priority = 1)
{
    global $filter_list;
    $filter_list[$filter][] = array(
        'function' => $function,
        'priority' => $priority
    );
}
function add_menu($menu, $title, $content)
{
    global $menu_list;
    $menu_list[$menu] = array(
        'title' => $title,
        'content' => $content
    );
}
function check_access($resource = "")
{
    //print "check_access( $resource );<br>\n";
    global $user_id;
    global $user_name;
    global $user_email;
    global $user_access;
    global $user_level;
    global $organization_id;
    $util = new utilObject;
    $util->init();
    $hasaccess = "TRUE";
    if ($resource != "")
    {
        $sql = "SELECT * FROM " . $util->accessMapTable . " as access_map WHERE access_map.resource='" . $resource . "';";
        $data = $util->sqlquery($sql);
        //print "data:<pre><br>\n";
        //var_dump( $data );
        //print "<pre><br>\n";
        //print "before hasaccess:$hasaccess<br>\n";
        if (is_array($data))
        {
            $hasaccess = "FALSE";
            //print "there is a db entry:$hasaccess<br>\n";
            foreach ($data AS $map)
            {
                $access = $map["access"];
                $level = $map["level"];
                if ($access == "level")
                {
                    if ($user_level >= $level) $hasaccess = "TRUE";
                    //print "level based access(".$hasaccess."):".$user_level."->".$level."<br>\n";
                    
                }
                else
                {
                    if ($user_access == $access) $hasaccess = "TRUE";
                    //print "role based access(".$hasaccess."):".$user_access."->".$access."<br>\n";
                    
                }
            }
        }
    }
    //print "hasaccess:$hasaccess<br>\n";
    if ($hasaccess == "TRUE") return (true);
    else return (false);
}
function sp($string)
{
    return (addslashes($string));
}
function pluralize($count, $text)
{
    return $count . (($count == 1) ? (" $text") : (" ${text}s"));
}
function ago($datetime)
{
    $interval = date_create('now')->diff($datetime);
    $suffix = ($interval->invert ? ' ago' : '');
    if ($v = $interval->y >= 1) return pluralize($interval->y, 'year') . $suffix;
    if ($v = $interval->m >= 1) return pluralize($interval->m, 'month') . $suffix;
    if ($v = $interval->d >= 1) return pluralize($interval->d, 'day') . $suffix;
    if ($v = $interval->h >= 1) return pluralize($interval->h, 'hour') . $suffix;
    if ($v = $interval->i >= 1) return pluralize($interval->i, 'minute') . $suffix;
    return pluralize($interval->s, 'second') . $suffix;
}
function dummy_get_email_count($userid)
{
    $util = new utilObject;
    $util->init();
    $sql = "SELECT * FROM " . $util->userTable_login . " as users WHERE users.id='" . $userid . "';";
    $data = $util->cstm_sqlquery($sql);
    //return( rand(0,9) );
    return (count($data));
}
function dummy_get_blog_count($userid)
{
    return (rand(0, 5));
}
class utilObject
{
    public $sql_link;
    public $sql_host = DB_HOST;
    public $sql_db = DB_NAME;
    public $sql_user = DB_USER;
    public $sql_pass = DB_PASS;
    public $userTable_login = "users";
    public $userTable_account_security_information = "final_account_security_information";
    public $userTable_address_contact_information = "final_address_contact_information";
    public $userTable_add_another_address = "final_add_another_address";
    public $userTable_employee_skills = "final_employee_skills";
    public $userTable_employer_benefits = "final_employer_benefits";
    public $userTable_employer_compensation = "final_employer_compensation";
    public $userTable_employer_retirement = "final_employer_retirement";
    public $userTable_employment_info = "final_employment_info";
    public $userTable_exam_certification_info = "final_exam_certification_info";
    public $userTable_generalinfo = "final_generalinform";
    public $userTable_other_memberships = "final_other_memberships";
    public $userTable_personal_information = "final_personal_information";
    public $userTable_program_university_info = "final_program_university_info";
    public $userTable_retirements_previous_employers = "final_retirements_previous_employers";
    public $student_university = "tbl_university";
    public $userTable_psuedo_vitals = "temp_stats";
    public $userTable_incomecdq = "incomecdq";
    public $all_table_class = "tbl_class";
    public $expected_table_dates = "tbl_expected_dates";
    public $ui_user_agent;
    public function __construct()
    {
        $this->sql_link = mysqli_connect($this->sql_host, $this->sql_user, $this->sql_pass) or die("Problem occur in connection");
        $db = ((bool)mysqli_query($this->sql_link, "USE " . $this->sql_db));
        //print "sql_link:<pre><br>\n";
        //var_dump($this->sql_link);
        //print "</pre><br>\n";
        //print "db:".$db."<br>\n";
        //$tz = (new DateTime('now', new DateTimeZone('Asia/Manila')))->format('P');
        //$stmt = mysqli_prepare($this->sql_link, "SET time_zone='".$tz."';");
        //mysqli_stmt_execute($stmt);
        $this->ui_user_agent = $_SERVER['HTTP_USER_AGENT'];
    }
    public function init()
    {
        global $user_id;
        global $user_email;
        global $user_role;
        //print "<pre>_REQUEST<br>\n";
        //var_dump( $_REQUEST );
        //print "</pre><br>\n";
        if (isset($_SESSION["user_id"])) $user_id = $_SESSION["user_id"];
        if (isset($_SESSION["user_email"])) $user_email = $_SESSION["user_email"];
        if (isset($_SESSION["user_role"])) $user_role = $_SESSION["user_role"];
    }
    public function sqlsingle($sql, $field)
    {
        $sql = do_filter("filter_sqlsingle_sql", $sql);
        $data = "";
        $query = $sql;
        //print "Q:$query<br>\n";
        $result = mysqli_query($this->sql_link, $query);
        if ($result)
        {
            while ($row = mysqli_fetch_array($result))
            {
                $data = stripslashes($row[$field]);
            }
        }
        return ($data);
    }
    public function sqlquery($sql)
    {
        $sql = do_filter("filter_sqlquery_sql", $sql);
        $data = array();
        $query = $sql;
        //print "Q:$query<br>\n";
        $result = mysqli_query($this->sql_link, $query);
        //print "result:<pre><br>n";
        //var_dump( $result );
        //print "</pre><br>\n";
        if (($result) && (is_object($result)) && ($result->num_rows !== 0))
        {
            while ($row = mysqli_fetch_assoc($result))
            {
                //print "row:<pre><br>n";
                //var_dump( $row );
                //print "</pre><br>\n";
                foreach ($row AS $i => $field)
                {
                    $row[$i] = stripslashes($field);
                }
                $data[] = $row;
            }
        }
        //print "data:<pre><br>n";
        //var_dump( $data );
        //print "</pre><br>\n";
        return ($data);
    }
    public function cstm_sqlquery($sql)
    {
        //	$sql = do_filter("filter_sqlquery_sql",$sql);
        $data = array();
        $query = $sql;
        //print "Q:$query<br>\n";
        $result = mysqli_query($this->sql_link, $query);
        //print "result:<pre><br>n";
        //var_dump( $result );
        //print "</pre><br>\n";
        if (($result) && (is_object($result)) && ($result->num_rows !== 0))
        {
            while ($row = mysqli_fetch_assoc($result))
            {
                //print "row:<pre><br>n";
                //var_dump( $row );
                //print "</pre><br>\n";
                foreach ($row AS $i => $field)
                {
                    $row[$i] = stripslashes($field);
                }
                $data[] = $row;
            }
        }
        //print "data:<pre><br>n";
        //var_dump( $data );
        //print "</pre><br>\n";
        return ($data);
    }
    public function sql_last_insert_id()
    {
        $insert_id = mysqli_insert_id($this->sql_link);
        return ($insert_id);
    }
    public function sql_last_error()
    {
        $errno = mysqli_errno($this->sql_link);
        if ($errno > 0)
        {
            $errmsg = mysqli_error($this->sql_link);
            return ("SQL Error ( $errno ): $errmsg");
        }
        return (false);
    }
    public function ajax_add_action($action, $function)
    {
        $action = str_replace("wp_ajax", "", $action);
        if ((isset($_REQUEST)) && (isset($_REQUEST["action"])) && ($_REQUEST["action"] == $action)) $this->$function();
    }
    public function get_current_user_id()
    {
        global $user_id;
        global $user_name;
        global $user_email;
        global $user_access;
        global $user_level;
        global $organization_id;
        return ($user_id);
    }
    public function checkRemoteFile($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        // don't download content
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if (curl_exec($ch) !== false)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function get_field_html($name, $type = "", $label = "", $placeholder = "", $value = "", $datatext = "", $extralabelcss = "", $extrainputcss = "")
    {
        if ($type == "") $type = "text";
        if ($label = "") $label = ucfirst($name);
        if ($placeholder == "") $placeholder = "Enter your " . $label;
        $id = strtolower(str_replace(" ", "-", $name));
        $fieldHTML = <<<EOD











                                <div class="row clearfix">











                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label {$extralabelcss}">











                                        <label for="email_address_2">{$label}</label>











                                    </div>











                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">











                                        <div class="form-group">











                                            <div class="form-line">











                                                <input type="{$type}" id="{$id}" class="form-control {$extrainputcss}" placeholder="{$placeholder}" {$datatext}>











                                            </div>











                                        </div>











                                    </div>











                                </div>











EOD;
        $fieldHTML = do_filter("filter_field_html", $fieldHTML);
        return ($fieldHTML);
    }
    public function get_field_object_html($field, $table, $key, $value = "", $extralabelcss = "", $extrainputcss = "")
    {
        global $organization_id;
        $label = ucfirst($field["label"]);
        if (isset($field["name"])) $name = $field["name"];
        else
        {
            $name = "ignore";
            $field["type"] == "hidden";
            $field["show"] = array();
        }
        $id = strtolower(str_replace(" ", "-", $name));
        if (strpos($field["name"], "organization_id") !== false)
        {
            //print "field is organization_id, current_value: ".$field["value"].", my organization_id is ".$organization_id."<br>\n";
            $value = $organization_id; // force it to users organization
            
        }
        if ($field["groupcss"] != "") $groupCSS .= $field["groupcss"];
        else $groupCSS = "";
        if ((in_array("form", $field["show"])) && ($field["type"] == 'hidden'))
        {
            $fieldHTML = '<input type="hidden" id="' . $id . '" name="' . $field["name"] . '"  value="' . $value . '">';
        }
        if ((in_array("form", $field["show"])) && ($field["type"] != 'key') && ($field["type"] != 'hidden'))
        {
            if (check_access($table . "-form-field-" . $field["name"]))
            {
                $formlineborder = "";
                if ($field["type"] == "image") $formlineborder = " no-border ";
                $fieldHTML = <<<EOD











                                <div class="row clearfix {$groupCSS}">











                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label {$extralabelcss}">











                                        <label for="email_address_2">{$label}</label>











                                    </div>











                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">











                                        <div class="form-group">











                                            <div class="form-line {$formlineborder}">











EOD;
                $inputHTML = "";
                $fieldExtra = $extrainputcss;
                if (($field["edit"]))
                {
                    $fieldCSS = "form-control editable";
                    if ($field["search"]) $fieldCSS .= " live-search ";
                    $fieldExtra .= " class='" . $fieldCSS . "' data-edit='true' data-edittype='" . $field["type"] . "' data-editvalidate='" . $field["validate"] . "' ";
                    $fieldExtra .= " data-joinajax='" . $field["joinajax"] . "' data-updateajax='" . $field["updateajax"] . "' ";
                    $fieldExtra .= " data-dbtable='" . $table . "' data-dbkey='" . $key . "' ";
                    //if ( $field["search"] ) $fieldExtra .= "  data-live-search='true' data-live-search-add='true' ";
                    if ($field["search"]) $fieldExtra .= "  data-live-search='true' data-size='8' ";
                    if ($field["required"]) $required = " required ";
                    else $required = "";
                    switch ($field["type"])
                    {
                        default:
                        case 'text':
                            $inputHTML = '<input type="text" id="' . $id . '" name="' . $name . '" ' . $fieldExtra . '  placeholder="' . $field["placeholder"] . '" value="' . $value . '" ' . $required . '>';
                        break;
                        case 'number':
                            $inputHTML = '<input type="number" id="' . $id . '" name="' . $name . '"  ' . $fieldExtra . '  placeholder="' . $field["placeholder"] . '" value="' . $value . '" ' . $required . '>';
                        break;
                        case 'password':
                            $inputHTML = '<input type="password" id="' . $id . '" name="' . $name . '"  ' . $fieldExtra . '  placeholder="' . $field["placeholder"] . '" value="' . $value . '" ' . $required . '>';
                        break;
                        case 'textarea':
                            $inputHTML = '<textarea id="' . $id . '"  name="' . $name . '" ' . $fieldExtra . '  placeholder="' . $field["placeholder"] . '" ' . $required . '>' . $value . '</textarea>';
                        break;
                        case 'select':
                            $inputHTML = '<select id="' . $id . '" name="' . $name . '"  ' . $fieldExtra . '  ' . $required . '>';
                            $inputHTML .= '<option value="">--- ' . $field["placeholder"] . ' ---</option>';
                            if (is_array($field["choices"]))
                            {
                                foreach ($field["choices"] AS $optionvalue => $optiontext)
                                {
                                    $inputHTML .= '<option value="' . $optionvalue . '" ';
                                    if ($optionvalue == $value) $inputHTML .= ' SELECTED ';
                                    $inputHTML .= '>' . $optiontext . '</option>';
                                }
                            }
                            else
                            {
                                if ($field["choices"] == 'function')
                                {
                                    $function = $field["choicesfunction"];
                                    $class = $field["choicesobject"];
                                    $tempObject = new $class();
                                    if (is_object($tempObject))
                                    {
                                        $tempObject->init();
                                        $inputHTML .= $tempObject->$function($value);
                                    }
                                    else
                                    {
                                        $inputHTML .= "[" . $class . "->" . $function . "( " . $dbkey . " )]";
                                    }
                                }
                            }
                            $inputHTML .= '</select>';
                            break;
                        case 'function':
                            $function = $field["inputfunction"];
                            $class = $field["object"];
                            $tempObject = new $class();
                            if (is_object($tempObject))
                            {
                                $tempObject->init();
                                $inputHTML = $tempObject->$function($id, $name, $value, $fieldExtra, $field["placeholder"]);
                            }
                            else
                            {
                                $inputHTML = "[" . $class . "->" . $function . "( " . $dbkey . " )]";
                            }
                            break;
                        case 'image':
                            $myid = $key;
                            if ($myid == "") $myid = "E4" . rand(1, 9);
                            $inputHTML = "<input type='hidden' id='input-" . $id . "-" . $myid . "' name='" . $name . "'  value='" . $value . "'>";
                            $inputHTML .= "<div class='image-wrapper'>";
                            if ($field["object"] != "")
                            {
                                $class = $field["object"];
                                $tempObject = new $class();
                                if (is_object($tempObject))
                                {
                                    $tempObject->init();
                                    $image_url = $tempObject->get_image_url($key);
                                    if ($image_url != "")
                                    {
                                        $inputHTML .= '<div class="image-preview"><img id="img-' . $id . "-" . $myid . '" src="' . $image_url . '"></div>';
                                    }
                                }
                            }
                            $inputHTML .= '<div class="' . $table . '-image-upload" data-type="' . $table . '"  runat="server" >';
                            $inputHTML .= '<div id="dropzone-' . $table . '-' . $myid . '" class="dynamic-dropzone dropzone clsbox" data-doinit="true" data-fieldid="' . $id . "-" . $myid . '" data-object="' . $field["object"] . '" data-dbkey="' . $key . '" data-dztype="' . $table . '"><div class="fallback"><input name="file" type="file" multiple /></div>';
                            $inputHTML .= '</div>';
                            $inputHTML .= '</div>';
                            break;
                        }
                    }
                    else
                    {
                        $fieldExtra .= " class='non-editable' data-edit='false' ";
                        $fieldExtra .= " data-dbtable='" . $table . "' data-dbkey='" . $key . "' ";
                        $inputHTML = "<div id='" . $id . "' name='" . $name . "' " . $fieldExtra . " >" . $value . "</div>";
                    }
                    $fieldHTML .= $inputHTML;
                    $fieldHTML .= <<<EOD











		                                            </div>











                                        </div>











                                    </div>











                                </div>











EOD;
                    
            }
        }
        $fieldHTML = do_filter("filter_field_html", $fieldHTML);
        return ($fieldHTML);
    }
    public function table_html($args)
    {
        //print "args:<pre><br>\n";
        //var_dump( $args );
        //print "</pre><br>\n";
        $params = array_merge(array(
            'title' => 'Table',
            'fieldlist' => array() ,
            'datalist' => array() ,
            'dropdown' => '',
            'tableid' => '',
            'key' => 0,
            'table' => 'util',
            'object' => 'util',
            'dbencode' => '',
            'actionHTML' => '',
            'datafilter' => '',
            'refreshfunction' => 'void(0);',
            'refreshid' => 0,
            'showfilter' => true,
            'showaction' => true,
            'rowfunction' => '',
            'tableclass' => '',
            'popover' => false
        ) , $args);
        $params = do_action('table_html_params', $params);
        //print "params:<pre><br>\n";
        //var_dump( $params );
        //print "</pre><br>\n";
        foreach ($params as $key => $value)
        {
            $$key = $value;
        }
        if ($actionHTML == "")
        {
            $actionHTML = '<td class="hide_column">[dbkey]</td>';
            $showaction = false;
        }
        if ($refreshid == 0) $refreshid = $datafilter;
        $headHTML = '<tr>';
        if ($showaction) $headHTML .= '<th>Actions</th>';
        else $headHTML .= '<th class="hide_column"></th>';
        foreach ($fieldlist AS $key => $rawField)
        {
            if ($rawField["type"] == "key")
            {
                $key = $rawField["name"];
                $table = $rawField["table"];
            }
            else
            {
                $field = $rawField;
                if ((in_array("table", $field["show"])) && ($field["type"] != 'key'))
                {
                    $headHTML .= '<th class="' . $field["tableclass"] . '">' . $field["label"] . '</th>';
                }
            }
        }
        $headHTML .= '</tr>';
        if ($showfilter) $displayfilter = ucfirst($datafilter) . " ";
        else $displayfilter = "";
        $tableHTML = <<<EOD











            <!-- Exportable Table -->











            <div id="{$tableid}-datatable" class="row clearfix">











                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">











                    <div class="card">











                        <div class="header">











                            <h2>{$displayfilter}{$title}</h2>











                            <ul class="header-dropdown m-r--5">











																<li>











																	<a href="javascript:{$refreshfunction}('{$refreshid}');" id="{$object}-table-refesh" data-refreshfunction="{$refreshfunction}" data-refreshid="{$refreshid}" data-toggle="cardloading" data-loading-effect="timer" data-loading-color="lightBlue">











																	    <i class="material-icons">loop</i>











																	</a>











																</li>











EOD;
        if ($dropdown != "")
        {
            $tableHTML .= <<<EOD











                                <li class="dropdown">











                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">











                                        <i class="material-icons">more_vert</i>











                                    </a>











EOD;
            $tableHTML .= $dropdown;
            $tableHTML .= <<<EOD











                                </li>











EOD;
            
        }
        $tableHTML .= <<<EOD











                            </ul>











                        </div>











                        <div class="body">











                            <div class="table-responsive">











                                <table class="table table-bordered table-striped table-hover dataTable js-exportable editableTable">











EOD;
        $tableHTML .= '<thead>' . $headHTML . '</thead>';
        $tableHTML .= '<tfoot>' . $headHTML . '</tfoot>';
        $tableHTML .= '<tbody>';
        if (is_array($datalist))
        {
            if ($rowfunction != "")
            {
                //@@@ we are just initializing it here so not creating a new one each row
                $class = $object . "Object";
                $tempRowObject = new $class();
                $orig_fieldlist = $fieldlist;
                $orig_actionHTML = $actionHTML;
            }
            foreach ($datalist as $dataitem)
            {
                $tableHTML .= '<tr>';
                $fieldHTML = "";
                if ($rowfunction != "")
                {
                    //@@@ psss fieldlist, $datalist, $actionHTML to rowfunction
                    //@@@ it will return containing them then set local to returned values
                    if (is_object($tempRowObject))
                    {
                        $tempRowObject->init();
                        $result = $tempRowObject->$rowfunction($orig_fieldlist, $dataitem, $orig_actionHTML);
                        if (is_array($result))
                        {
                            if (isset($result["fieldlist"])) $fieldlist = $result["fieldlist"];
                            if (isset($result["dataitem"])) $dataitem = $result["dataitem"];
                            if (isset($result["actionHTML"])) $actionHTML = $result["actionHTML"];
                        }
                    }
                }
                $rowcolor = "";
                if (strtolower($dataitem["status"]) == "error") $rowcolor = "bg-danger col-black font-bold";
                if (strtolower($dataitem["status"]) == "warning") $rowcolor = "bg-warning col-black font-bold";
                foreach ($fieldlist AS $key => $rawField)
                {
                    $field = $rawField;
                    if ($field["type"] == 'key') $dbkey = $dataitem[$field["name"]];
                    else
                    {
                        if ((in_array("table", $field["show"])) && ($field["type"] != 'key'))
                        {
                            $fieldHTML .= '<td ';
                            if ($field["edit"])
                            {
                                if (($field["name"] == "status") || ($field["name"] == "message") || ($field["name"] == $dataitem["message_field"]))
                                {
                                    if (($field["name"] == $dataitem["message_field"]) && ($dataitem["edit_function"] != ""))
                                    {
                                        $fieldHTML .= "class='editable " . $field["tableclass"] . " " . $rowcolor . "' data-edit='" . $field["edit"] . "' data-edittype='function' data-editfunction='" . $dataitem["edit_function"] . "' data-editvalidate='" . $field["validate"] . "' ";
                                    }
                                    else
                                    {
                                        $fieldHTML .= "class='editable " . $field["tableclass"] . " " . $rowcolor . "' data-edit='" . $field["edit"] . "' data-edittype='" . $field["type"] . "' data-editvalidate='" . $field["validate"] . "' ";
                                    }
                                }
                                else $fieldHTML .= "class='editable " . $field["tableclass"] . " ' data-edit='" . $field["edit"] . "' data-edittype='" . $field["type"] . "' data-editvalidate='" . $field["validate"] . "' ";
                                $fieldHTML .= "data-dbencode='" . $field["dbencode"] . "'  data-joinajax='" . $field["joinajax"] . "' data-updateajax='" . $field["updateajax"] . "' ";
                                if ($field["type"] == "select")
                                {
                                    if (is_array($field["choices"])) $choices = json_encode($field["choices"]);
                                    else $choices = json_encode(array());
                                    $fieldHTML .= " data-editchoices='" . $choices . "' ";
                                }
                            }
                            else
                            {
                                if (($field["name"] == "status") || ($field["name"] == "message")) $fieldHTML .= "class='non-editable " . $field["tableclass"] . " " . $rowcolor . "' data-edit='false' ";
                                else $fieldHTML .= "class='non-editable " . $field["tableclass"] . " ' data-edit='false' ";
                            }
                            $fieldHTML .= " data-dbtable='" . $table . "' data-dbkey='" . $dbkey . "' data-dbfield='" . $field["name"] . "' ";
                            if ($field["type"] == "function")
                            {
                                $value = "";
                                if (isset($field["function"]))
                                {
                                    $function = $field["function"];
                                    $class = $object . "Object";
                                    $tempObject = new $class();
                                    if (is_object($tempObject))
                                    {
                                        $tempObject->init();
                                        $value = $tempObject->$function($dbkey);
                                    }
                                    else
                                    {
                                        $value = "[" . $class . "->" . $function . "( " . $dbkey . " )]";
                                    }
                                }
                            }
                            else $value = $dataitem[$field["name"]];
                            if (($field["type"] == "datepicker") && ($value != "")) $value = date("Y-m-d", strtotime($value));
                            if (($field["type"] == "number") && ($value == "")) $value = 0;
                            if (($field["type"] == "currency") && ($value == "")) $value = 0;
                            if ($field["type"] == "currency") $value = $value . "&#8369;";
                            if ($field["popover"])
                            {
                                $class = $object . "Object";
                                $tempObject = new $class();
                                if (is_object($tempObject))
                                {
                                    $tempObject->init();
                                    $image_url = $tempObject->get_image_url($dbkey);
                                }
                                else
                                {
                                    $image_url = "";
                                }
                                $value = "<a class='popover-btn' rel='popover' data-img='" . $image_url . "'> " . $value . " </a>";
                            }
                            $fieldHTML .= '>' . $value . '</td>';
                        }
                    }
                }
                $actionHTML_live = str_replace('[dbkey]', $dbkey, $actionHTML);
                $tableHTML .= $actionHTML_live;
                $tableHTML .= $fieldHTML;
                $tableHTML .= '</tr>';
            }
        }
        $tableHTML .= <<<EOD











                                    </tbody>











                                </table>











                            </div>











                        </div>











                   </div>











              </div>











           </div>























EOD;
        $tableHTML = do_filter('table_html', $tableHTML);
        return ($tableHTML);
    }
    public function form_html($args)
    {
        global $organization_id;
        $params = array_merge(array(
            'title' => 'Table',
            'object' => 'util',
            'fieldlist' => array() ,
            'data' => array() ,
            'dbkey' => 0,
            'refreshaction' => '',
            'refreshargs' => '',
            'showsave' => true,
            'extraHTML' => '',
            'extraLocation' => 'before',
            'nextClick' => '',
        ) , $args);
        $params = do_action('form_html_params', $params);
        foreach ($params as $key => $value)
        {
            $$key = $value;
        }
        $formHTML = <<<EOD











					<div class="row clearfix">











						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">











							<div class="card">











								<div class="header">











									<h2>{$title}</h2>











								</div>











								<div class="body">











								<form action="javascript:void(0);" id="{$object}-form" method="POST" novalidate="novalidate">











EOD;
        foreach ($fieldlist AS $key => $rawField)
        {
            if ($rawField["type"] == "key")
            {
                $key = $rawField["name"];
                $table = $rawField["table"];
                if ((isset($data["id"])) && ($data["id"] != "")) $id = $data["id"];
                else $id = $dbkey;
            }
            else
            {
                $field = $rawField;
                if ((in_array("form", $field["show"])) && ($field["type"] != 'key'))
                {
                    if ((isset($field["name"])) && ($field["name"] != "") && (isset($data[$field["name"]]))) $value = $data[$field["name"]];
                    else $value = "";
                    if (($value == "") && (isset($field["defaultvalue"])) && ($field["defaultvalue"] != "")) $value = $field["defaultvalue"];
                    $formHTML .= $this->get_field_object_html($field, $table, $id, $value);
                }
            }
        }
        if (($extraHTML != "") && ($extraLocation == "before"))
        {
            $formHTML .= "\n<br>\n";
            $formHTML .= $extraHTML;
        }
        if ($showsave)
        {
            $formHTML .= <<<EOD











								<div class="center align-center"><button type="button" class="btn btn-primary m-t-15 waves-effect form-update" data-form="{$object}-form" data-object="{$object}" data-dbtable="{$table}" data-dbkey="{$dbkey}" data-refreshaction="{$refreshaction}" data-refreshargs="{$refreshargs}" data-nextclick="{$nextClick}">Save</button></div>











EOD;
            
        }
        if (($extraHTML != "") && ($extraLocation == "after"))
        {
            $formHTML .= "\n<br>\n";
            $formHTML .= $extraHTML;
        }
        $formHTML .= <<<EOD











								</form>











								</div>











							</div>











						</div>











					</div>











EOD;
        $formHTML = do_filter('form_html', $formHTML);
        return ($formHTML);
    }
    public function display_html($args)
    {
        global $organization_id;
        //print "args:<pre><br>\n";
        //var_dump( $args );
        //print "</pre><br>\n";
        $params = array_merge(array(
            'title' => 'Table',
            'object' => 'util',
            'fieldlist' => array() ,
            'data' => array() ,
            'dbkey' => 0,
            'refreshaction' => '',
            'refreshargs' => '',
            'extraHTML' => '',
            'extraLocation' => 'before'
        ) , $args);
        $params = do_action('display_html_params', $params);
        //print "params:<pre><br>\n";
        //var_dump( $params );
        //print "</pre><br>\n";
        foreach ($params as $key => $value)
        {
            $$key = $value;
        }
        $formHTML = <<<EOD











					<div class="row clearfix">











							<div class="card profile-card">











								<div class="profile-header align-center bg-grey">











									<h3>{$title}</h3>











								</div>











								<div class="profile-footer">











EOD;
        $formHTML .= "\n<ul>\n";
        foreach ($fieldlist AS $key => $rawField)
        {
            if ($rawField["type"] == "key")
            {
                $key = $rawField["name"];
                $table = $rawField["table"];
                if (isset($data["id"])) $id = $data["key"];
                else $id = 0;
            }
            else
            {
                $field = $rawField;
                if ((in_array("inline", $field["show"])) && ($field["type"] != 'key'))
                {
                    switch ($field["type"])
                    {
                        default:
                            if ((isset($field["name"])) && ($field["name"] != "") && (isset($data[$field["name"]]))) $value = $data[$field["name"]];
                            else $value = "";
                            if (($value == "") && (isset($field["defaultvalue"])) && ($field["defaultvalue"] != "")) $value = $field["defaultvalue"];
                            $formHTML .= '<li><span>' . $field["label"] . '</span><span>' . $value . '</span></li>';
                            break;
                        case 'html':
                            if ((isset($field["name"])) && ($field["name"] != "") && (isset($data[$field["name"]]))) $value = $data[$field["name"]];
                            else $value = "";
                            if (($value == "") && (isset($field["defaultvalue"])) && ($field["defaultvalue"] != "")) $value = $field["defaultvalue"];
                            $formHTML .= '<li class="display-html"><span>' . $field["label"] . '</span><span class="display-html"><div class="display-html">' . $value . '</div></span></li>';
                            break;
                        case 'function':
                            $function = $field["function"];
                            $class = $object . "Object";
                            $value = "[" . $class . "->" . $function . "( " . $dbkey . " )]";
                            include_once ("classes/" . $object . ".class.php");
                            $tempObject = new $class();
                            if (is_object($tempObject))
                            {
                                $tempObject->init();
                                $value = $tempObject->$function($dbkey);
                            }
                            else
                            {
                                $value = "[" . $class . "->" . $function . "( " . $dbkey . " )]";
                            }
                            $formHTML .= '<li><span>' . $field["label"] . '</span><span>' . $value . '</span></li>';
                            break;
                        case 'image':
                            //print "this is an image<br>\n";
                            //print "object is ".$field["object"]."<br>\n";
                            if ($field["object"] != "")
                            {
                                $class = $field["object"];
                                $tempObject = new $class();
                                if (is_object($tempObject))
                                {
                                    //print "it is an object<br>\n";
                                    $tempObject->init();
                                    //print "get_image_url( $dbkey );<br>\n";
                                    $image_url = $tempObject->get_image_url($dbkey);
                                    if ($image_url != "")
                                    {
                                        $value = '<img class="lightbox-dialog" id="img-' . $id . "-" . $myid . '" src="' . $image_url . '">';
                                    }
                                }
                            }
                            $formHTML .= '<li><div class="display-image-wrapper"><div class="display-image-label">' . $field["label"] . '</div><div class="display-image-preview">' . $value . '</div></div></li>';
                            break;
                        }
                    }
                }
            }
            $formHTML .= "\n</ul>\n";
            if (($extraHTML != "") && ($extraLocation == "before"))
            {
                $formHTML .= "\n<br>\n";
                $formHTML .= $extraHTML;
            }
            if (($extraHTML != "") && ($extraLocation == "after"))
            {
                $formHTML .= "\n<br>\n";
                $formHTML .= $extraHTML;
            }
            $formHTML .= <<<EOD











							</div>











						</div>











					</div>











EOD;
            $formHTML = do_filter('display_html', $formHTML);
            return ($formHTML);
        }
        public function display_barcode($data, $symbology = "ean-13", $options = array(
            "sf" => 2.0,
            "sy" => 0.6
        ))
        {
            include_once ('plugins/barcode/barcode.php');
            $generator = new barcode_generator();
            /*
            
            
            
            
            
            
            
            
            
            
            
            // Output directly to standard output.
            
            
            
            
            
            
            
            
            
            
            
            $generator->output_image($format, $symbology, $data, $options);
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            // Create bitmap image.
            
            
            
            
            
            
            
            
            
            
            
            $image = $generator->render_image($symbology, $data, $options);
            
            
            
            
            
            
            
            
            
            
            
            imagepng($image);
            
            
            
            
            
            
            
            
            
            
            
            imagedestroy($image);
            
            
            
            
            
            
            
            
            
            
            
            */
            /* Generate SVG markup. */
            $svg = $generator->render_svg($symbology, $data, $options);
            return ($svg);
        }
        public function generate_upc()
        {
            global $organization_id;
            $upc = sprintf("%02d", $organization_id) . str_pad(mt_rand(0, 999999999) , 9, '0', STR_PAD_LEFT);
            return ($upc);
        }
        public function output_barcode($data, $symbology = "ean-13", $options = array(
            "sf" => 2.0,
            "sy" => 0.6
        ))
        {
            include_once ('plugins/barcode/barcode.php');
            $generator = new barcode_generator();
            // Output directly to standard output.
            //$generator->output_image("png", $symbology, $data, $options);
            // Create bitmap image.
            $image = $generator->render_image($symbology, $data, $options);
            imagepng($image);
            imagedestroy($image);
        }
        public function findReplace($string, $find, $replace)
        {
            if (preg_match("/[a-zA-Z\_]+/", $find))
            {
                return (string)preg_replace("/\{\{(\s+)?($find)(\s+)?\}\}/", $replace, $string);
            }
            else
            {
                throw new \Exception("Find statement must match regex pattern: /[a-zA-Z]+/");
            }
        }
    }
    function generatePDF($content, $stream = false, $calc_name = "", $mode = "download", $size = "a4")
    {
        //print "generatePDF: $stream, $calc_name<br>\n";
        //set_include_path(get_include_path() . PATH_SEPARATOR . "/home/creditse/public_html/wp-content/plugins/pdftool/dompdf");
        //require_once('dompdf/dompdf_config.inc.php');
        //print "content:<pre><br>\n";
        //var_dump( $content );
        //print "</pre><br>\n";
        $dompdf = new Dompdf();
        $dompdf->set_option('isRemoteEnabled', true);
        if ($size == "label")
        {
            $dompdf->set_option('dpi', '200');
            $dompdf->set_paper(array(
                0,
                0,
                288,
                432
            ));
        }
        //print "_REQUEST<pre><br>\n";
        //var_dump( $_REQUEST );
        //print "</pre><br>\n";
        $content = stripslashes($content);
        $pdffilename = $calc_name . ".pdf";
        if ($stream)
        {
            header('Content-Transfer-Encoding: binary'); // For Gecko browsers mainly
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($path)) . ' GMT');
            header('Accept-Ranges: bytes'); // Allow support for download resume
            header('Content-Length: ' . strlen($content)); // File size
            header('Content-Encoding: none');
            header('Content-Type: application/pdf'); // Change the mime type if the file is not PDF
            header('Content-Disposition: attachment; filename="' . $pdffilename . '"');
        }
        $dompdf->load_html($content, 'UTF-8');
        //return("stopped");
        $dompdf->render();
        if ($stream)
        {
            if ($mode == "view") $dompdf->stream($pdffilename, array(
                'Attachment' => false
            ));
            else $dompdf->stream($pdffilename, array(
                'Attachment' => true
            ));
        }
        else
        {
            $output = $dompdf->output();
            return ($output);
        }
    }
?>
