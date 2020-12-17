<?php

class Notiz extends AbstractModel
{
    private string $notizInhalt = "";
    private ?Liste $liste = null;

    /**
     * @return Liste|null
     */
    public function getListe(): ?Liste
    {
        return $this->liste;
    }

    /**
     * @param Liste|null $liste
     */
    public function setListe(?Liste $liste): void
    {
        $this->liste = $liste;
    }

    /**
     * @return mixed
     */
    public function getNotizInhalt(): string
    {
        return $this->notizInhalt;
    }

    /**
     * @param $newNotizInhalt
     */
    public function setNotizInhalt($newNotizInhalt): void
    {
        $this->notizInhalt = $newNotizInhalt;
    }

    public function notizLoeschen(): void
    {

    }

    public function printNotiz(): void
    {
        echo('deine Notiz ist: ' . $this->notizInhalt);
    }

    public function save()
    {
        $pdo = Db::getInstance()->getPdo();
        $listenId = "0";
        if ($this->getListe()) {
            $listenId = $this->getListe()->getId();
        }

        if ($this->getId() !== Null) {
            $update = '   UPDATE `notiz` SET `notiz`=\'' . $this->getNotizInhalt() . '\', `listenId` = ' . $listenId . '  WHERE `notiz`.`id`= ' . $this->getId();// . '  WHERE `id` = ' . $this->getId()
            $pdo->query($update);
            var_dump($update);
        } else {
            $insertAnweisung = 'INSERT INTO `notiz` (`notiz`,`listenId`) VALUES (\'' . $this->getNotizInhalt() . '\', ' . $listenId . '  )';
            $pdo->query($insertAnweisung);

            $lastId = $pdo->lastInsertId();
            $this->setId($lastId);
            var_dump($insertAnweisung);
        }
    }


    public function delete()
    {
        $pdo = Db::getInstance()->getPdo();

        if ($this->getId() !== Null) {
            $sql = 'DELETE FROM `notiz` WHERE `id`= ' . $this->getId();
            $pdo->query($sql);
        } else {
            echo 'leider, dieses Notiz existiert gar nicht!!';
        }
    }


    public static function loadById(int $newId): Notiz
    {
        $sql = 'SELECT * FROM `notiz` WHERE  `id` = ' . $newId;
        var_dump($sql);

        $sth = Db::getInstance()->getPdo()->prepare($sql);
        $sth->execute();

        $result = $sth->fetch(PDO::FETCH_ASSOC);

        $newNotiz = new Notiz();

        $newNotiz->setNotizInhalt($result['notiz']);
        $newNotiz->setListe(Liste::loadById($result['listenId']));
        $newNotiz->setId($result['id']);

        return $newNotiz;

    }

    protected function getTableName(): string
    {
        return 'notiz';
    }


}
