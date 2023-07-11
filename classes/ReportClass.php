<?
class ReportClass
{
    private $memberClass;

    public function __construct(MemberClass $memberClass)
    {
        $this->memberClass = $memberClass;
    }
    
    public function getFocusNameByFocusId($companyId, $focus_id){
        require '../config/dbconnect.php';

        if ($this->memberClass->isAdmin()) {
            $dbName = $this->memberClass->getCompanyDBById($companyId);
        } else {
            $dbName = $this->memberClass->getCompanyDB();
        }

        $query = "SELECT focus_first_name, focus_last_name FROM " . $dbName . ".focus WHERE focus_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $focus_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        $data = "";
        if ($row) {
            $data = (isset($row["focus_first_name"]) && isset($row["focus_last_name"])) ? $row["focus_first_name"] . " " . $row["focus_last_name"]:"";
        }
        return $data;
    }
    
    public function getReportDateByFocusId($companyId, $focus_id){
        require '../config/dbconnect.php';

        if ($this->memberClass->isAdmin()) {
            $dbName = $this->memberClass->getCompanyDBById($companyId);
        } else {
            $dbName = $this->memberClass->getCompanyDB();
        }

        $query = "SELECT end_date FROM " . $dbName . ".focus WHERE focus_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $focus_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        $data = "";
        if ($row) {
            $data = isset($row["end_date"])?$row["end_date"]:"";
        }
        return $data;
    }
}
