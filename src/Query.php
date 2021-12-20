<?php

namespace Quizhub;


class Query
{        
    /**
     * Select function. Most parameters already have a default value, unless you wish to have a more complex selector.
     *
     * @param string $sql Main select query, which does not contain the conditions.
     * @param array $data Where the conditions will be filled in.
     * @param int $mode Set fetch mode, https://www.php.net/manual/en/pdostatement.fetch.php
     * @param bool $row On true if you wish to return rowCount, else its false on default and wont return rowCount.
     * @param bool $fetch If you want to return a single array, fetch on true, otherwise fetch on false will return everything.
     * 
     * @return mixed Returns int if rowcount is true, else it returns array with data which you specified in the query.
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
     * Insert function. With the given table and data values filled in, it will automatically insert data into your given table.
     *
     * @param string $table Desired table you wish to insert data into.
     * @param array $data This contains all the values that needs to be inserted.
     * 
     * @return int Returns the inserted id.
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
     * Update function. This function is used to update a table, a few params need to be filled for it to work, usually the table, data and where clause. The limitor is on default set to 1, change if you wish to make a mass update on the same condition.
     *
     * @param string $table Your given table which needs to be updated.
     * @param array $data The data that is used to update the old fields.
     * @param string $where Where clause, only update on your specified condition. 
     * @param int $limit The limitor, its default is set to 1
     * 
     * @return mixed Returns int if your table got update with your given data, else returns string with error message.
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
     * Delete function. This function is used to delete data from your given table with your conditions and optional a limitor.
     *
     * @param string $table The table you wish to delete from.
     * @param string $where Your own condition input.
     * @param int $limit The maximum data you wish to delete at most. 
     * 
     * @return bool True if data got deleted, false if the data did not get deleted. 
     */
    public function Delete(string $table, string $where, int $limit = 1)
    {
        return $this->pdo->query("DELETE FROM $table WHERE $where LIMIT $limit");
    }
}