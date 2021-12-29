<?php


namespace App\Repository\EntityRepository;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * Provides common features needed in Repositorys.
 *
 * @package App\Repository
 */
class AbstractEntityRepository
{
    protected $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function createProcedureFirstInsert()
    {
        $sql = "
            create or replace procedure first_insert( )
            language plpgsql
            as $$
            begin
                INSERT INTO product (id,name, created_at)
                            VALUES  (1,'PRODUCT 1', '2021-12-28 15:54:55'),
                                    (2,'PRODUCT 2', '2021-12-28 15:54:55'),
                                    (3,'PRODUCT 3', '2021-12-28 15:54:55');
                                   
                commit;
                 INSERT INTO tag (id,name, created_at)
                            VALUES  (1,'TAG 1', '2021-12-28 15:54:55'),
                                    (2,'TAG 2', '2021-12-28 15:54:55'),
                                    (3,'TAG 3', '2021-12-28 15:54:55');
                                   
                            
                commit;
                 INSERT INTO product_tag (product_id,tag_id)
                            VALUES  (1,1),
                                    (1,2),
                                    (2,1),
                                    (3,1),
                                    (3,2),
                                    (3,3);
                                                  
                commit;
            end;$$
        ";

        $sqlProcessing = $this->connection->prepare($sql);

        try {
            $sqlProcessing->execute();
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }

        if (isset($exception)) {
            return ["failure" => "Houve um erro na inserção da informação."];
        }

        return true;
    }

    public function callProcedureFirstInsert()
    {
        $sql = "call first_insert();";

        $sqlProcessing = $this->connection->prepare($sql);

        try {
            $sqlProcessing->execute();
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }

        if (isset($exception)) {
            return ["failure" => "Houve um erro na inserção da informação."];
        }

        return true;
    }
}
