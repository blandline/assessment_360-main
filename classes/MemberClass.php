<?
class MemberClass
{

    public function getLang()
    {
        require "../classes/Constant.php";
        if (!isset($_COOKIE['lang'])) {
            $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
            $lang = in_array($lang, $ACCEPT_LANG) ? $lang : 'en';
            $_COOKIE['lang'] = $lang;
            setcookie("lang", $lang, 2147483647, "/");
        }
        require "../lang/" . $_COOKIE['lang'] . ".php";
        return $language;
    }

    public function logOut()
    {
        session_destroy();
        header('Location: index');
    }

    public function isLoggedIn()
    {
        require("../config/dbconnect.php");
        require("../classes/Session.php");

        if (!empty(@$_SESSION[$session_userId])) {
            return true;
        } else {
            return false;
        }
    }

    function getIPAddress()
    {
        $ip = "";
        if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        } else if (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else {
            $ip = $_SERVER["REMOTE_ADDR"];
        }
        return $ip;
    }

    public function isAdmin()
    {
        require("../classes/Session.php");
        if (!empty(@$_SESSION[$session_admin])) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserId()
    {
        require("../classes/Session.php");
        return $_SESSION[$session_userId];
    }

    public function getDisplayName()
    {
        require("../classes/Session.php");
        return isset($_SESSION[$session_display_name]) && $_SESSION[$session_display_name] != "" ? $_SESSION[$session_display_name] : $_SESSION[$session_username];
    }

    public function checkUserPermission($permission)
    {
        require("../classes/Session.php");
        if (in_array(-1, $_SESSION[$session_userPermission])) {
            return true;
        } else {
            return in_array($permission, $_SESSION[$session_userPermission]);
        }
    }

    public function getCompanyId()
    {
        require("../classes/Session.php");
        return $_SESSION[$session_company_id];
    }

    public function getCompanyDB()
    {
        require("../classes/Session.php");
        return $_SESSION[$session_company_db];
    }

    public function getCompanyDBById($companyId)
    {
        if ($this->isAdmin()) {
            require("../config/dbconnect.php");
            $stmt = $conn->prepare("SELECT db_name FROM company WHERE id = ? and is_activated = 1 LIMIT 1");
            $stmt->bind_param("s", $companyId);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $row = mysqli_fetch_assoc($result);
            return $row["db_name"];
        }
        return null;
    }

    public function getDefaultCompanyId()
    {
        if ($this->isAdmin()) {
            require("../config/dbconnect.php");
            $stmt = $conn->prepare("SELECT id FROM company ORDER BY order_id LIMIT 1");
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $row = mysqli_fetch_assoc($result);
            return $row["id"];
        }
        return null;
    }

    public function insertActionLog($action)
    {
        require("../config/dbconnect.php");
        $userId = $this->getUserId();
        $ip = $this->getIPAddress();
        if ($this->isAdmin()) {
            $stmt = $conn->prepare("INSERT INTO log (user_id, ip, action) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $userId, $ip, $action);
            $stmt->execute();
        } else {
            $dbName = $this->getCompanyDB();
            $stmt = $conn->prepare("INSERT INTO " . $dbName . ".action_log (user_id, ip, action) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $userId, $ip, $action);
            $stmt->execute();
        }
    }

    // get competency
    public function getCompetency()
    {
        require("../classes/Constant.php");

        $result = "";
        if ($this->isAdmin() || $this->checkUserPermission($PERMISSION_PMP_ADD) || $this->checkUserPermission($PERMISSION_PMP_EDIT)) {
            require("../config/dbconnect.php");

            $stmt = $conn->prepare("SELECT * FROM competency ORDER BY order_id");
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
        }
        return $result;
    }

    public function getCompanyLogo()
    {
        require("../classes/Session.php");
        require("../config/dbconnect.php");

        if (!isset($_SESSION[$session_company_logo])) {
            $_SESSION[$session_company_logo] = "<img src='../logo/logo.png' />";
            if (!$this->isAdmin()) {
                $companyId = $this->getCompanyId();

                if (!($stmt = $conn->prepare("SELECT logo from " . $database . ".company WHERE id = ?"))) {
                    // die("fail:Prepare failed: (" . $conn->errno . ") " . $conn->error);
                }
                $stmt->bind_param("s", $companyId);
                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->close();
                if ($result->num_rows === 1) {
                    $row = mysqli_fetch_assoc($result);
                    $logoName = $row['logo'];
                    if ($logoName != "") {
                        $_SESSION[$session_company_logo] = "<img src='../logo/" . $logoName . "' />";
                    }
                }
            }
        }
        return $_SESSION[$session_company_logo];
    }
}
