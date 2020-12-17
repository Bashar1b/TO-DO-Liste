<?php

class Termin extends Notiz
{
    private $datum;
    private $uhrZeit;

    /**
     * @return string
     */
    public function getDatum(): string
    {
        return $this->datum;
    }

    /**
     * @param $newDatum
     */
    public function setDatum(string $newDatum): void
    {
        $this->datum = $newDatum;
    }

    /**
     * @return string
     */
    public function getUhrZeit(): string
    {
        return $this->uhrZeit;
    }

    public function setUhrZeit(string $newUhrZeit): void
    {
        $this->uhrZeit = $newUhrZeit;
    }

    public function printTermin(): void
    {
        echo('das Datum: ' . $this->datum . '. die Uhrzeit: ' . $this->uhrZeit);
    }
}