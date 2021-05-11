<?php

declare(strict_types = 1);

namespace Example\Model;

use Mini\Model\Model;

/**
 * Example data.
 */
class ExampleModel extends Model
{
    private $code;
    private $description;

    public function setCode(string $code) {
        $this->code = $code;
    }
    public function getCode() {
        return $this->code;
    }
    public function setDescription(string $description) {
        $this->description = $description;
    }
    public function getDescription() {
        return $this->description;
    }

    /**
     * Get example data by ID.
     * @param int $id
     * @return ExampleModel
     */
    public function get(int $id): ExampleModel
    {
        $sql = '
            SELECT
                example_id AS "id",
                created,
                code,
                description
            FROM
                ' . getenv('DB_SCHEMA') . '.master_example
            WHERE
                example_id = ?';

        return $this->db->get->select([
            'title'  => 'Get example data',
            'sql'    => $sql,
            'inputs' => [$id]
        ]);

    }

    /**
     * Create record
     * @return int
     */
    public function create(): int
    {
        $sql = '
            INSERT INTO
                ' . getenv('DB_SCHEMA') . '.master_example
            (
                created,
                code,
                description
            )
            VALUES
            (?,?,?)';

        $id = $this->db->statement([
            'title'  => 'Create example',
            'sql'    => $sql,
            'inputs' => [
                now(),
                $this->code,
                $this->description
            ]
        ]);

        $this->db->validateAffected();

        return $id;
    }
}
