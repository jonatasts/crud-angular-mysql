<?php

class RacerController
{
    private static $instance;
    private $connection;

    private function __construct($connection)
    {
        $this->connection = $connection;
    }

    public static function getInstance($connection)
    {
        if (!isset(self::$instance)) {
            self::$instance = new RacerController($connection);
        }

        return self::$instance;
    }

    public function create($racer)
    {
        try {
            if ($this->verificarRacer($racer['name'])) {
                return 1;
            }

            $result_racer = mysqli_query(
                $this->connection,
                "INSERT INTO racer (name, wins, years, photo) 
                 VALUES (
                     '{$racer['name']}', 
                     '{$racer['wins']}',
                     '{$racer['years']}',
                     '{$racer['photo']}'
                 );"
            );

            return !$result_racer ? 2 : 3;
        } catch (Exception $e) {
            //echo $e->getMessage();
            return false;
        }
    }

    public function update($racer)
    {
        try {
            $result_update = mysqli_query(
                $this->connection,
                "UPDATE racer 
                 SET name = '{$racer['name']}',
                 wins = '{$racer['wins']}',
                 years = '{$racer['years']}',
                 photo = '{$racer['photo']}'
                 WHERE id = {$racer['id']};"
            );

            return !$result_update ? 1 : 2;
        } catch (Exception $e) {
            //echo $e->getMessage();
            return false;
        }
    }

    public function delete(int $id)
    {
        try {
            $result_racers = mysqli_query(
                $this->connection,
                "DELETE
                 FROM racer
                 ORDER BY racer.id = $id;"
            );

            return $result_racers;
        } catch (Exception $e) {
            //echo $e->getMessage();
            return false;
        }
    }

    public function getRacers()
    {
        $racers = array();

        try {
            $result_racers = mysqli_query(
                $this->connection,
                "SELECT *
                 FROM racer;"
            );

            $rows_racers = mysqli_num_rows($result_racers);

            if ($rows_racers != 0) {
                while ($racer_db = mysqli_fetch_assoc($result_racers)) {
                    array_push($racers, $racer_db);
                }
            }

            return $racers;
        } catch (Exception $e) {
            //echo $e->getMessage();
            return false;
        }
    }

    public function getRacerByID($racer_id)
    {
        try {
            $result_racer = mysqli_query(
                $this->connection,
                "SELECT * 
                 FROM racer 
                 WHERE id = $racer_id;"
            );

            $rows_racer = mysqli_num_rows($result_racer);

            if ($rows_racer) {
                $racer_db = mysqli_fetch_assoc($result_racer);

                return $racer_db;
            }

            return null;
        } catch (Exception $e) {
            //echo $e->getMessage();
            return false;
        }
    }

    public function searchRacers($searchText)
    {
        $racers = array();

        try {
            $result_racers = mysqli_query(
                $this->connection,
                "SELECT *
                 FROM racer
                 WHERE CONCAT(name, wins, years)
                 LIKE '%" . $searchText . "%'"
            );

            $rows_racers = mysqli_num_rows($result_racers);

            if ($rows_racers != 0) {
                while ($racer_db = mysqli_fetch_assoc($result_racers)) {
                    array_push($racers, $racer_db);
                }
            }

            return $racers;
        } catch (Exception $e) {
            //echo $e->getMessage();
            return false;
        }
    }

    private function verificarRacer($racer_name, $racer_id = null)
    {
        try {
            $query_racer = "SELECT *
                            FROM racer 
                            WHERE name = '$racer_name'";

            $query_racer .= $racer_id ? "AND id != $racer_id;" : ";";

            $result_racer = mysqli_query(
                $this->connection,
                $query_racer
            );

            return mysqli_num_rows($result_racer) != 0;
        } catch (Exception $e) {
            //echo $e->getMessage();
            return false;
        }
    }
}
