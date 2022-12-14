<?php

declare(strict_types=1);

namespace App\Src\Model;

use PDO;

abstract class AbstractModel
{
    public object $conn;

    public function __construct()
    {
        $this->createConn(include __DIR__ . '\..\config\dbcfg.php');
    }

    private function createConn(array $config): void
    {
        $this->conn = new PDO(
            "mysql:host=" . $config['host'] . ";dbname=" . $config['database'],
            $config['user'],
            $config['password']
        );
    }

    final protected function addRecord(string $nameTable, array $columnTable, array $newRecord): void
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
        $statement->execute($newRecord);
    }

    final protected function editRecord(string $nameTable, array $nameColumn, array $editRecord, string $columnIdTable, int $recordId): void
    {
        if (count($nameColumn) !== count($editRecord))
            return;

        $colsAndRecs = $nameColumn[0] . '=' . '"' . $editRecord[0] . '"';

        for ($i = (count($nameColumn) - 1); $i > 0; $i--) {
            $colsAndRecs = $colsAndRecs . ', ' . $nameColumn[$i] . '=' . '"' . $editRecord[$i] . '"';
        }

        $sql = "UPDATE $nameTable 
                SET $colsAndRecs 
                WHERE $columnIdTable = $recordId";

        $statement = $this->conn->prepare($sql);
        $statement->execute();
    }

    final protected function deleteRecord(string $nameTable, string $columnIdTable, int $recordID): void
    {
        $sql = "DELETE FROM " . $nameTable . " 
                WHERE " . $columnIdTable . " = ? ";

        $statement = $this->conn->prepare($sql);
        $statement->execute([$recordID]);
    }

    final protected function getRecord(string $tableName, string $columnName = null, string|int $recordName = null, string $columnOrder = null, string $columnSort = 'ASC'): array
    {
        if ($columnName !== null && $recordName !== null) {
            $sql = "SELECT * FROM " . $tableName . " 
                    WHERE " . $columnName . " = " . '"' . $recordName . '"';
        } else {
            $sql = "SELECT * 
                    FROM " . $tableName;
        }

        if ($recordName !== null && $columnOrder !== null )
            $sql .= " ORDER BY ". $columnOrder . " " . $columnSort ;

        $statement = $this->conn->prepare($sql);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}