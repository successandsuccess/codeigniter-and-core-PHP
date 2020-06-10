<?php
class MembersObject
{
    // database connection and table name
    private $conn;
    private $table_users = "users";
    private $table_generalinfo = "final_generalinform";
    public function __construct()
    {
        global $db;
        //$db = Database::getInstance();
        $this->conn = $db;
        //$db = new Database;
        //exit(0);
        
    }
    // read all surveys
    public function readAllUsers()
    {
        $query = "SELECT * FROM " . $this->table_users . " ORDER BY id";
        $result = $this
            ->conn
            ->getQuery($query);
        $rows = array();
        $role_set = array(
            "Student",
            "CAA",
            "PD",
            "Employer",
            "Admin",
            "Retired",
            "De-certified"
        );
        while ($row = $result->fetch_array())
        {
            $f_name = '<a href="../index.php?dXNlcl9yb2xl=' . base64_encode($row['role']) . '&dXNlcl9pZA===' . base64_encode($row['id']) . '" target="_blank">' . $this->splitName($row['full_name']) [0] . '</a>';
            $l_name = '<a href="../index.php?dXNlcl9yb2xl=' . base64_encode($row['role']) . '&dXNlcl9pZA===' . base64_encode($row['id']) . '" target="_blank">' . $this->splitName($row['full_name']) [1] . '</a>';
            $edit_role = '<font style="display: none">' . $row['role'] . '</font><select class = "form-control" style="width: 100%; padding: 5px;" id="role_member_id' . $row['id'] . '" onchange = "javascript:edit_role(' . $row['id'] . ');">';
            $select_option = "";
            foreach ($role_set as $val)
            {
                $select_option .= '<option';
                $edit_val = $row['role'];
                if ($edit_val == "Program Director")
                {
                    $edit_val = "PD";
                }
                $key_value = $edit_val;
                if ($key_value == $val)
                {
                    $select_option .= ' selected = "selected"';
                }
                $select_option .= ' value = "' . $val . '">';
                $select_option .= $val;
                $select_option .= '</option>';
            }
            $edit_role .= $select_option;
            $edit_role .= '</select>';
            array_push($rows, [$row['id'], $f_name, $l_name, $row['email'], $row['password'], $edit_role]);
        }
        return $rows;
	}
	//previous name splitfunction
    // public function splitName($name)
    // {
    //     $name = trim($name);
    //     $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
    //     $first_name = trim(preg_replace('#' . $last_name . '#', '', $name));
    //     return array(
    //         $first_name,
    //         $last_name
    //     );
	// }
	// new name split function 
	public function splitName($name)
	{
		$name = trim($name);
		if(substr($name, -3) == 'Jr.')
		{
			$splitedNameArray = explode(" ", $name);
			$last_name = $splitedNameArray[count($splitedNameArray)-2]." ".$splitedNameArray[count($splitedNameArray)-1];
			$first_name = str_replace($last_name, '', $name);
			return array(
				$first_name,
				$last_name
			);
		}
		else
		{
			$last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
			$first_name = trim(preg_replace('#' . $last_name . '#', '', $name));
			return array(
				$first_name,
				$last_name
			);
		}
        

	}
    public function getFullName($id)
    {
        $query = "SELECT * FROM " . $this->table_generalinfo . " WHERE user_id=" . $id;
        if ($stmt = $this
            ->conn
            ->getData($query))
        {
            return array(
                $stmt[0]['f_name'],
                $stmt[0]['l_name']
            );
        }
        else
        {
            return "";
        }
    }
    public function getRoleByID($id)
    {
        $query = "SELECT * FROM " . $this->table_users . " WHERE id=" . $id;
        if ($stmt = $this
            ->conn
            ->getData($query))
        {
            return $stmt[0]['role'];
        }
        else
        {
            return "";
        }
    }
    public function editRole($id, $role)
    {
        if ($role == "Student")
        {
            $query = "UPDATE " . $this->table_users . " SET is_certified = '0', role = '" . $role . "' WHERE id = '" . $id . "'";
        }
        else
        {
            $query = "UPDATE " . $this->table_users . " SET is_certified = '1', role = '" . $role . "' WHERE id = '" . $id . "'";
        }
        if ($stmt = $this
            ->conn
            ->execute($query))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}

