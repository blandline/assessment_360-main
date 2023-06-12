<?
class CompetencyClass
{
    private $memberClass;

    public function __construct(MemberClass $memberClass)
    {
        $this->memberClass = $memberClass;
    }

    public function getCompetencyCluster()
    {
        require '../config/dbconnect.php';
        $query = "SELECT * FROM competency WHERE parent_id = -1 ORDER BY order_id";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result;
    }

    public function getCompetencyFrameworkPosition($companyId)
    {
        require '../config/dbconnect.php';

        if ($this->memberClass->isAdmin()) {
            $dbName = $this->memberClass->getCompanyDBById($companyId);
        } else {
            $dbName = $this->memberClass->getCompanyDB();
        }
        $query = "SELECT * FROM " . $dbName . ".competency_frm_position";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result;
    }

    public function getCompetencyFrameworkPositionWithId($companyId)
    {
        require '../config/dbconnect.php';

        if ($this->memberClass->isAdmin()) {
            $dbName = $this->memberClass->getCompanyDBById($companyId);
        } else {
            $dbName = $this->memberClass->getCompanyDB();
        }
        $query = "SELECT * FROM " . $dbName . ".competency_frm_position WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $_POST["id"]);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result;
    }

    public function getCompetencyFramework($companyId)
    {
        require '../config/dbconnect.php';

        if ($this->memberClass->isAdmin()) {
            $dbName = $this->memberClass->getCompanyDBById($companyId);
        } else {
            $dbName = $this->memberClass->getCompanyDB();
        }
        $query = "SELECT * FROM " . $dbName . ".competency_frm";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result;
    }

    public function addCompetencyFrameworkPosition($companyId, $name)
    {
        require '../config/dbconnect.php';

        if ($this->memberClass->isAdmin()) {
            $dbName = $this->memberClass->getCompanyDBById($companyId);
        } else {
            $dbName = $this->memberClass->getCompanyDB();
        }
        $stmt = $conn->prepare("INSERT INTO " . $dbName . ".competency_frm_position (name) VALUES (?)");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $id = $stmt->insert_id;
        $stmt->close();

        return $id;
    }

    public function updateCompetencyFrameworkPosition($companyId, $name)
    {
        require '../config/dbconnect.php';

        if ($this->memberClass->isAdmin()) {
            $dbName = $this->memberClass->getCompanyDBById($companyId);
        } else {
            $dbName = $this->memberClass->getCompanyDB();
        }
        $stmt = $conn->prepare("UPDATE " . $dbName . ".competency_frm_position SET name = ? WHERE id = ?");
        $stmt->bind_param("ss", $name, $_POST["id"]);
        $stmt->execute();
        $stmt->close();
    }

    public function addCompetencyFramework($companyId, $id, $value)
    {
        require '../config/dbconnect.php';

        if ($this->memberClass->isAdmin()) {
            $dbName = $this->memberClass->getCompanyDBById($companyId);
        } else {
            $dbName = $this->memberClass->getCompanyDB();
        }
        $stmt = $conn->prepare("INSERT INTO " . $dbName . ".competency_frm (competency_position_id, competency_id) VALUES (?, ?)");
        $stmt->bind_param("ss", $id, $value);
        $stmt->execute();
        $stmt->close();
    }

    public function updateCompetencyFramework($companyId, $value)
    {
        require '../config/dbconnect.php';

        if ($this->memberClass->isAdmin()) {
            $dbName = $this->memberClass->getCompanyDBById($companyId);
        } else {
            $dbName = $this->memberClass->getCompanyDB();
        }
        $stmt = $conn->prepare("UPDATE " . $dbName . ".competency_frm SET competency_id = ? WHERE competency_position_id = ?");
        $stmt->bind_param("ss", $value, $_POST["id"]);
        $stmt->execute();
        $stmt->close();
    }

    public function deleteCompetencyFramework($companyId)
    {
        require '../config/dbconnect.php';

        if ($this->memberClass->isAdmin()) {
            $dbName = $this->memberClass->getCompanyDBById($companyId);
        } else {
            $dbName = $this->memberClass->getCompanyDB();
        }
        $stmt = $conn->prepare("DELETE FROM " . $dbName . ".competency_frm_position WHERE id = ?");
        $stmt->bind_param("s", $_POST["id"]);
        $stmt->execute();
        $stmt->close();

        $stmt = $conn->prepare("DELETE FROM " . $dbName . ".competency_frm WHERE competency_position_id = ?");
        $stmt->bind_param("s", $_POST["id"]);
        $stmt->execute();
        $stmt->close();
    }
}
?>