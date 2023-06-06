<?
class UserClass
{

    /* __constructor()
     * Constructor will be called every time Login class is called ($login = new Login())
     */
    public function __construct()
    {
        /* Check if user is logged in. */
        $this->isLoggedIn();

        /* If login data is posted call validation function. */
        if (isset($_POST["login"])) {
            $this->Login();
        }
    } /* End __constructor() */

    private function setCookie()
    {
        if (isset($_POST['remember']) && $_POST['remember'] == 1) {
            $user = trim($_POST['username']);
            $userpsw = trim($_POST['password']);
            setcookie("cid", $user, time() + (10 * 365 * 24 * 60 * 60));
            setcookie("cpass", $userpsw, time() + (10 * 365 * 24 * 60 * 60));
        } else {
            setcookie("cid", "", time() - 3600);
            setcookie("cpass", "", time() - 3600);
        }
    }

    public function getLang()
    {
        if (!isset($_COOKIE['lang'])) {
            require "Constant.php";

            if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
                $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
                $lang = in_array($lang, $ACCEPT_LANG) ? $lang : 'en';
            } else {
                $lang = 'en';
            }
            $_COOKIE['lang'] = $lang;
            setcookie("lang", $lang, 2147483647, "/");
        }
        return $_COOKIE['lang'];
    }

    /* Function Login()
    *  Function that validates user login data, cross-checks with database.
    *  If data is valid user is logged in, session variables are set.
    */
    private function Login()
    {
        require "lang/" . $this->getLang() . ".php";

        // Require credentials for DB connection.
        require("config/dbconnect.php");
        require("classes/Session.php");

        $_SESSION[$session_package] = [];
        $_SESSION[$session_userPermission] = [];

        // Check that data has been submited.
        if (isset($_POST['login'])) {

            // User input from Login Form(loginForm.php).
            $user = trim($_POST['username']);
            $userpsw = trim($_POST['password']);

            // Check that both username and password fields are filled with values.
            if (!empty($user) && !empty($userpsw)) {
                /* Query the username from DB, if response is greater than 0 it means that users exists & 
                 * we continue to compare the password hash provided by the user side with the DB data. */

                if (strpos($user, '@') !== false) {
                    // company
                    $stmt = $conn->prepare("SELECT id, username, password, level, super_admin, company_id FROM users WHERE username = ? AND is_activated = 1");
                } else {
                    // admin
                    $stmt = $conn->prepare("SELECT id, username, password, level FROM admin WHERE username = ?");
                }
                $stmt->bind_param("s", $user);
                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->close();
                if ($result->num_rows === 1) {
                    $row = mysqli_fetch_assoc($result);
                    // Cross-reference password that is given by user with the hashed password in database.
                    if (password_verify($userpsw, $row['password'])) {
                        $_SESSION[$session_username] = $row['username'];
                        $_SESSION[$session_super_admin] = $row['super_admin'];
                        $_SESSION[$session_display_name] = $row['username'];

                        if (strpos($user, '@') !== false) {
                            // update language
                            $langId = 0;
                            if ($this->getLang() == "tc") {
                                $langId = 1;
                            } else if ($this->getLang() == "sc") {
                                $langId = 2;
                            }
                            $stmt = $conn->prepare("UPDATE users SET lang = ? WHERE id = ?");
                            $stmt->bind_param("ss", $langId, $row['id']);
                            $stmt->execute();

                            $_SESSION[$session_company_id] = $row['company_id'];

                            // company  
                            $stmt = $conn->prepare("SELECT db_name, package_id FROM company WHERE id = ?");
                            $stmt->bind_param("s", $row['company_id']);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $row2 = mysqli_fetch_assoc($result);
                            $stmt->close();
                            $_SESSION[$session_company_db] = $row2['db_name'];

                            // package
                            $stmt = $conn->prepare("SELECT * FROM package");
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $stmt->close();
                            $packageStr = "";
                            $packageList = explode(";", $row2['package_id']);
                            while ($row4 = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                if (in_array($row4["id"], $packageList)) {
                                    $packageStr .= $row4["name"] . ";";
                                }
                            }
                            $packageStr = substr($packageStr, 0, -1);
                            $_SESSION[$session_package] = explode(";", $packageStr);

                            // change db name
                            $db_selected = mysqli_select_db($conn, $row2['db_name']);

                            if ($db_selected) {
                                // employee
                                $stmt = $conn->prepare("SELECT id, en_name, position_id, grading FROM employee WHERE email = ?");
                                $stmt->bind_param("s", $row['username']);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $row3 = mysqli_fetch_assoc($result);
                                $stmt->close();

                                if (!isset($row3)) {
                                    $_SESSION[$session_message] = $language["login_error_invaild_password"];
                                } else {
                                    $_SESSION[$session_userId] = $row3['id'];
                                    $_SESSION[$session_display_name] = urldecode(htmlspecialchars($row3["en_name"], ENT_QUOTES));

                                    // user right
                                    if ($row["super_admin"] == 1) {
                                        $_SESSION[$session_userPermission] = [-1];
                                    } else {
                                        $_SESSION[$session_userPermission] = [];

                                        $stmt = $conn->prepare("SELECT method FROM permission_setting");
                                        $stmt->execute();
                                        $result2 = $stmt->get_result();
                                        $row4 = mysqli_fetch_assoc($result2);
                                        $stmt->close();
                                        $isUseGrade = $row4["method"];

                                        // use position
                                        if ($isUseGrade == 0) {
                                            $stmt = $conn->prepare("SELECT permission FROM permission2 WHERE id2 = ?");
                                            $stmt->bind_param("s", $row3['position_id']);
                                            $stmt->execute();
                                            $result3 = $stmt->get_result();
                                            if ($result3->num_rows > 0) {
                                                $row5 = mysqli_fetch_assoc($result3);
                                                $stmt->close();
                                                $_SESSION[$session_userPermission] = explode(";", $row5['permission']);
                                            }
                                        } else if ($isUseGrade == 1) {
                                            // use grade
                                            $stmt = $conn->prepare("SELECT permission FROM permission2 WHERE id2 = ?");
                                            $stmt->bind_param("s", $row3['grading']);
                                            $stmt->execute();
                                            $result3 = $stmt->get_result();
                                            if ($result3->num_rows > 0) {
                                                $row5 = mysqli_fetch_assoc($result3);
                                                $stmt->close();
                                                $_SESSION[$session_userPermission] = explode(";", $row5['permission']);
                                            }
                                        } else if ($isUseGrade == 2) {
                                            // use role
                                            $keyword1 = $row3['position_id'] . ",%";
                                            $keyword2 = "%," . $row3['position_id'] . ",%";
                                            $stmt = $conn->prepare("SELECT role_id FROM grade_structure WHERE grading = ? OR position_id like ? OR position_id like ?");
                                            $stmt->bind_param("sss", $row3['grading'], $keyword1, $keyword2);
                                            $stmt->execute();
                                            $result3 = $stmt->get_result();
                                            if ($result3->num_rows > 0) {
                                                $row5 = mysqli_fetch_assoc($result3);
                                                $stmt->close();

                                                $stmt = $conn->prepare("SELECT permission FROM permission2 WHERE id2 = ?");
                                                $stmt->bind_param("s", $row5['role_id']);
                                                $stmt->execute();
                                                $result3 = $stmt->get_result();
                                                if ($result3->num_rows > 0) {
                                                    $row5 = mysqli_fetch_assoc($result3);
                                                    $stmt->close();
                                                    $_SESSION[$session_userPermission] = explode(";", $row5['permission']);
                                                }
                                            }
                                        }
                                    }

                                    // insert action log
                                    require "Constant.php";
                                    $stmt = $conn->prepare("INSERT INTO action_log (user_id, action) VALUES (?, ?)");
                                    $stmt->bind_param("ss", $row3['id'], $ACTION_LOG_LOGIN);
                                    $stmt->execute();

                                    // mobile
                                    if (isset($_POST["mobile"])) {

                                        // check has adttendance package and has attendance permission
                                        if (in_array($PACKAGE_ATTENDANCE, $_SESSION[$session_package]) && in_array($PERMISSION_ATTENDANCE_MOBILE, $_SESSION[$session_userPermission])) {
                                            // check is company device (company_user_id is insert by manual)
                                            $stmt = $conn->prepare("SELECT * FROM attendance_setting ORDER BY create_time DESC LIMIT 1");
                                            $stmt->execute();
                                            $result4 = $stmt->get_result();
                                            if ($result4->num_rows > 0) {
                                                $row6 = mysqli_fetch_assoc($result4);
                                                $stmt->close();
                                                if ($row6["company_user_id"] == $row['id']) {
                                                    $_SESSION[$session_mobile_admin] =  $row['username'];
                                                }
                                            }

                                            $stmt = $conn->prepare("SELECT id FROM user_face WHERE user_id = ?");
                                            $stmt->bind_param("s", $row['id']);
                                            $stmt->execute();
                                            $result2 = $stmt->get_result();
                                            $stmt->close();
                                            if ($result2->num_rows === 0) {
                                                die("no register");
                                            }

                                            $stmt = $conn->prepare("SELECT id FROM user_face WHERE user_id = ? AND device_id = ?");
                                            $stmt->bind_param("ss", $row['id'], $_POST["mobile"]);
                                            $stmt->execute();
                                            $result2 = $stmt->get_result();
                                            $stmt->close();
                                            if ($result2->num_rows === 0) {
                                                die("not this device");
                                            }
                                        }
                                    }

                                    // success for user
                                    $this->setCookie();
                                }
                            } else {
                                $_SESSION[$session_username] = "";
                                $_SESSION[$session_display_name] = "";
                                $_SESSION[$session_super_admin] = "";
                                $_SESSION[$session_userPermission] = [];
                                $_SESSION[$session_company_id] = "";
                                $_SESSION[$session_package] = [];
                                $_SESSION[$session_company_db] = "";
                                $_SESSION[$session_message] = $language["login_error_invaild_password"];
                            }
                        } else {
                            // update language
                            $langId = 0;
                            if ($this->getLang() == "tc") {
                                $langId = 1;
                            } else if ($this->getLang() == "sc") {
                                $langId = 2;
                            }
                            $stmt = $conn->prepare("UPDATE admin SET lang = ? WHERE id = ?");
                            $stmt->bind_param("ss", $langId, $row['id']);
                            $stmt->execute();

                            // insert action log
                            require "Constant.php";
                            $stmt = $conn->prepare("INSERT INTO log (user_id, action) VALUES (?, ?)");
                            $stmt->bind_param("ss", $row['id'], $ACTION_LOG_LOGIN);
                            $stmt->execute();

                            // success for admin
                            $_SESSION[$session_admin] = $row['username'];
                            $_SESSION[$session_userId] = $row['id'];
                            $this->setCookie();
                        }
                    } else {
                        $_SESSION[$session_message] = $language["login_error_invaild_password"];
                    }
                } else {
                    $_SESSION[$session_message] = $language["login_error_invaild_password"];
                }
            } else {
                $_SESSION[$session_message] = $language["general_fill_in_all_fields"];
            }
        }
    }   /* End Login() */

    /* Function isLoggedIn()
     * Check if user is already logged in, if not then prompt login form.
     */
    public function isLoggedIn()
    {

        // Require credentials for DB connection.
        require('config/dbconnect.php');
        require("classes/Session.php");
        if (!empty(@$_SESSION[$session_userId])) {
            return true;
        } else {
            return false;
        }
    } /* End isLoggedIn() */

}   /* End class UserClass */