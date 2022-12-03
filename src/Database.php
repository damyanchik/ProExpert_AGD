<?php

declare(strict_types=1);

namespace App\Src;

use PDO;

class Database
{
    public object $conn;

    public function __construct()
    {
        $this->createConn(include 'config/dbcfg.php');
    }

    private function createConn(array $config): void
    {
        $this->conn = new PDO("mysql:host=" . $config['host'] . ";dbname=" . $config['database'], $config['user'], $config['password']);
    }

    final public function addRecord(string $nameTable, array $columnTable, array $newRecord): bool|array
    {

        $q = '?';
        if (count($columnTable) !== 1) {
            for ($i = 1; $i < count($columnTable); $i++) {
                $q .= ', ?';
            }
        }
        $columnsToString = implode(', ', $columnTable);

        $sql = "INSERT INTO $nameTable (" . $columnsToString . ") 
                VALUES (" . $q . ")";
        $statement = $this->conn->prepare($sql);

        return $statement->execute($newRecord);
    }

    final public function editRecord(string $nameTable, array $nameColumn, array $editRecord, string $columnIdTable, int $recordId): bool|array
    {
        if (count($nameColumn) !== count($editRecord)) {
            return false;
        }

        $colsAndRecs = $nameColumn[0] . '=' . '"' . $editRecord[0] . '"';

        for ($i = (count($nameColumn) - 1); $i > 0; $i--) {
            $colsAndRecs = $colsAndRecs . ', ' . $nameColumn[$i] . '=' . '"' . $editRecord[$i] . '"';
        }

        $sql = "UPDATE $nameTable 
                SET $colsAndRecs 
                WHERE $columnIdTable = $recordId";
        $statement = $this->conn->prepare($sql);

        return $statement->execute();
    }

    final public function deleteRecord(string $nameTable, string $columnIdTable, int $recordID): bool|array
    {
        if (!$nameTable
            || !$columnIdTable
            || !$recordID)
            return false;

        $sql = "DELETE FROM " . $nameTable . " 
                WHERE " . $columnIdTable . " = ? ";
        $statement = $this->conn->prepare($sql);

        return $statement->execute([$recordID]);
    }

    final public function getRecord(string $tableName, string $columnName = null, string $recordName = null): bool|array
    {
        if (!$tableName)
            return false;

        if ($columnName !== null && $recordName !== null) {
            $sql = "SELECT * FROM " . $tableName . " 
                    WHERE " . $columnName . " = " . '"' . $recordName . '"';
        } else {
            $sql = "SELECT * 
                    FROM " . $tableName;
        }
        $statement = $this->conn->prepare($sql);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}