<?php


abstract class AbstractModel
{
    private ?int $id = null;

    public function delete()
    {
        $pdo = Db::getInstance()->getPdo();
        if ($this->getId() !== Null) {
            $sql = 'DELETE FROM `' . $this->getTableName() . '` WHERE `id`= ' . $this->getId();
            var_dump($sql);
            //$sql = 'DELETE FROM `notiz` WHERE `id`= ' . $this->getId();
            $pdo->query($sql);
        } else {
            throw new Exception('Eintrag in der Tabelle ' . $this->getTableName() . 'wurde nicht gefunden');
        }

    }

    /**
     * @return string
     */
    abstract protected function getTableName(): string;

    /**
     * @param $newListenId
     */
    protected function setId($newListenId): void
    {
        $this->id = $newListenId;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function loadById(int $newId): Liste
    {
        $sql = 'SELECT * FROM `' . $this->getTableName() . '` WHERE  `id` = ' . $newId;
        $sth = Db::getInstance()->getPdo()->prepare($sql);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        $newList = new Liste();
        $newList->setName($result['name']);
        $newList->setZulaessigeBeitraegeZahl($result['maximaleNotizen']);
        $newList->setId($result['id']);
        return $newList;
    }
}