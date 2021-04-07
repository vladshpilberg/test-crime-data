<?php

class CrimeModel
{
    private $db;

    public function __construct() {
        global $db;
        $this->db = $db;
    }

    public function getNumberOfCrimesByArea($area) {
        $sql = "SELECT COUNT(c.dr_no) as crimes_number FROM raw_crime_data c ";
        $sql .= "JOIN area a ON c.area = a.id ";
        $sql .= "WHERE a.name = ? ";
        $sql .= "GROUP BY c.area";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('s', $area);
        $stmt->execute();
        $result = $stmt->get_result();

        $row = $result->fetch_assoc();

        return $row['crimes_number'];
    }

    public function getAddressesByCrimeType($type, $page = 1, $offset = 100) {
        $from = ($page - 1) * $offset;

        $typeId = $this->getTypeIdByType($type);

        $sql = "SELECT location FROM raw_crime_data ";
        $sql .= "WHERE crm_cd = ? OR crm_cd_2 = ? OR crm_cd_3 = ? OR crm_cd_4 = ? ";
        $sql .= "LIMIT ?, ?";

        $stmt = $this->db->prepare($sql);

        $stmt->bind_param('dddddd', $typeId, $typeId, $typeId, $typeId, $from, $offset);

        $stmt->execute();
        $result = $stmt->get_result();

        $resultArray = [];

        while($row = $result->fetch_assoc()) {
            $resultArray[] = ['address' => $row['location']];
        }

        return $resultArray;
    }

    public function getNumberOfCrimesByCrimeType($type) {
        $typeId = $this->getTypeIdByType($type);

        $sql = "SELECT COUNT(dr_no) as crimes_number FROM raw_crime_data ";
        $sql .= "WHERE crm_cd = ? OR crm_cd_2 = ? OR crm_cd_3 = ? OR crm_cd_4 = ? ";

        $stmt = $this->db->prepare($sql);

        $stmt->bind_param('dddd', $typeId, $typeId, $typeId, $typeId);

        $stmt->execute();
        $result = $stmt->get_result();

        $row = $result->fetch_assoc();
        return $row['crimes_number'];
    }

    private function getTypeIdByType($type) {
        $type = strtolower($type);

        $sql = "SELECT id FROM crime_type WHERE LOWER(description) = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('s', $type);
        $stmt->execute();
        $result = $stmt->get_result();

        $row = $result->fetch_assoc();
        return $row['id'];
    }
}
