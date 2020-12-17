<?php

class User
{
    private $nachName;
    private $vorName;
    private $id;
    private $myLists = array();

    /**
     * @return string
     */
    public function getNachName(): string
    {
        return $this->nachName;
    }

    /**
     * @param string $newNachName
     */
    public function setNachName(string $newNachName): void
    {
        $this->nachName = $newNachName;
    }

    /**
     * @return string
     */
    public function getVorName(): string
    {
        return $this->vorName;
    }

    /**
     * @param string $newVorName
     */
    public function setVorName(string $newVorName): void
    {
        $this->vorName = $newVorName;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $newId
     * @return int
     */
    public function setId(int $newId): void
    {
        $this->Id = $newId;
    }

    public function setListenFuerUser(string $listenName): void
    {
        $this->myLists[] = $listenName;
    }
}