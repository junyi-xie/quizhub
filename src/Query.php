<?php

namespace Quizhub;


class Query
{        
    /**
     * Select function.
     *
     * @param string $sql The SQL string to select.
     * @param array $data The data which will be used as parameters for the SQL.
     * @param int $mode The PDO mode used while returning the query.
     * @param bool $row Use if amount of rows needs to be returned.
     * @param bool $fetch Set the fetch mode to be single or multiple.
     * 
     * @return int|array 
     */
    public function Select(string $sql, array $data = [], int $mode = \PDO::FETCH_OBJ, bool $row = false, bool $fetch = false)
    {
        $statement = $this->pdo->prepare($sql);

        if (!empty($data)) {
            foreach ($data as $key => &$value) {
                $statement->bindValue("$key", $value);
            }
        }
    
        if (!$statement->execute()) {
            throw new \Exception("Error: " . implode(',', $this->pdo->errorInfo()));
        } else if ($row) {
            return $statement->rowCount();
        } else {
            return !$fetch ? $statement->fetchAll($mode) : $statement->fetch($mode);
        }
    }


    /**
     * Insert function.
     *
     * @param string $table The table specified to insert data in.
     * @param array $data The data used to insert into the table.
     * 
     * @return int
     */
    public function Insert(string $table, array $data)
    {
        ksort($data);
        
        $keys = implode('`, `', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));
        
        $statement = $this->pdo->prepare("INSERT INTO $table (`$keys`) VALUES ($values)");
        
        foreach ($data as $key => $value) {
            $statement->bindValue(":$key", $value);
        }
        
        if (!$statement->execute()) {
            throw new \Exception("Error: " . implode(',', $this->pdo->errorInfo()));
        }
        
        return $this->pdo->lastInsertId();
    }


    /**
     * Update function.
     *
     * @param string $table The table specified to update from.
     * @param array $data The data used to update the previous rows.
     * @param string $where The condition for which rows should be updated.
     * @param int $limit The maximum rows to get updated. 
     * 
     * @return int|null
     */
    public function Update(string $table, array $data, string $where, int $limit = 1)
    {
        ksort($data);
    
        $fields = null;

        foreach ($data as $key => $value) {
            $fields .= "`$key`= :$key,";
        }

        $fields = rtrim($fields, ',');
        
        $statement = $this->pdo->prepare("UPDATE $table SET $fields WHERE $where LIMIT $limit");
        
        foreach ($data as $key => $value) {
            $statement->bindValue(":$key", $value);
        }
        
        return $statement->execute();
    }


    /**
     * Delete function.
     *
     * @param string $table The table specified to get their items deleted from.
     * @param string $where The condition for which rows should be deleted.
     * @param int $limit The maximum rows to get deletd. 
     * 
     * @return bool
     */
    public function Delete(string $table, string $where, int $limit = 1)
    {
        return $this->pdo->prepare("DELETE FROM $table WHERE $where LIMIT $limit")->execute();
    }
}