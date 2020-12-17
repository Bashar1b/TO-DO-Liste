<?php

//verb am Anfang von functionnen Name
// einheitlich
// camleCase - typen inhalten - notiz in der liste erstellen
// php DOM alles funktioniert von oben nach unten
//maximaleNotizen eintragen und alle funktionen was für ein Typ das - to do 07.12.2020
class Liste extends AbstractModel
{
    private $zulaessigeBeitraegeZahl;
    private $name;
    private $notizen = array();
    
    /**
     * @param string $newListenNameWert
     * @throws Exception
     */
    private function checkListenName(string $newListenNameWert): void
    {
        if (strlen($newListenNameWert) <= 5) {
            throw new Exception('name ist fehlerhaft');
        }
    }

    /**
     * @param string $newListenName
     * @throws Exception
     */
    public function setName(string $newListenName): void
    {
        $this->checkListenName($newListenName);
        $this->name = $newListenName;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     *
     * @return int
     */
    public function getZulaessigeBeitraegeZahl(): int
    {
        return $this->zulaessigeBeitraegeZahl;
    }

    /**
     * @param int $newZulaesBeitrZahl
     * @throws Exception
     */
    private function checkZulaesBeitrZahl(int $newZulaesBeitrZahl): void
    {
        if ($newZulaesBeitrZahl > 15) {
            throw new Exception('die zulaessige Notizenzahl ist nur bis 15, sie haben das überschrieten. ');
        }
    }

    /**
     * @param int $newZulaessigeBeitraegeZahl
     * @throws Exception
     */
    public function setZulaessigeBeitraegeZahl(int $newZulaessigeBeitraegeZahl): void
    {
        $this->checkZulaesBeitrZahl($newZulaessigeBeitraegeZahl);
        $this->zulaessigeBeitraegeZahl = $newZulaessigeBeitraegeZahl;
    }

    public function printListe(): void
    {
        echo('der Listenname: ' . $this->name . '. zulaessige Beitraegezahl: ' . $this->zulaessigeBeitraegeZahl);
    }


    public function save()
    {
        $pdo = Db::getInstance()->getPdo();
        if ($this->getId() !== Null) {
            $update = '   UPDATE `liste` SET `name`=\'' . $this->getName() . '\', `maximaleNotizen`= ' . $this->getZulaessigeBeitraegeZahl() . '  WHERE `id` = ' . $this->getId();
            $pdo->query($update);
        } else {
            $insertAnweisung = 'INSERT INTO `liste` (`name`,`maximaleNotizen`) VALUES (\'' . $this->getName() . '\', ' . $this->getZulaessigeBeitraegeZahl() . ' )';
            $pdo->query($insertAnweisung);
            $lastId = $pdo->lastInsertId();
            $this->setId($lastId);
        }
    }

    public static function loadById(int $newId): Liste
    {
        $sql = 'SELECT * FROM `liste` WHERE  `id` = ' . $newId;
        $sth = Db::getInstance()->getPdo()->prepare($sql);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        $newList = new Liste();
        $newList->setName($result['name']);
        $newList->setZulaessigeBeitraegeZahl($result['maximaleNotizen']);
        $newList->setId($result['id']);
        return $newList;
    }

    protected function getTableName(): string
    {
        return 'liste';
    }
}