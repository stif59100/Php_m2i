<?php

/**
 * Description of Pays
 *
 * @author Pascal
 */
declare(strict_types = 1);

require_once './dao.php';



class User {

    private $idUser;
    private $nameUser;
    private $firstnameUser;
    private $pseudoUser;
    private $emailUser;
    private $passwordUser;

    public function __construct(string $idUser = "", string $nameUser = "",string $firstnameUser = "",string $emailUser = "",string $pseudoUser = "",string $passwordUser = "") {
        $this->idUser = $idUser;
        $this->nameUser = $nameUser;
        $this->firstnameUser = $firstnameUser;
        $this->pseudoUser = $pseudoUser;
        $this->emailUser = $emailUser;
        $this->passwordUser = $passwordUser;
        
    }

    public function getIdUser(): string{
        return $this->idUser;
    }

    public function getNameUser(): string {
        return $this->nameUser;
    }
    public function getFirstnameUser(): string {
        return $this->firstnameUser;
    }
    public function getPseudoUser(): string {
        return $this->pseudoUser;
    }
    public function getEmailUser(): string {
        return $this->emailUser;
    }
    public function getPasswordUser(): string {
        return $this->passwordUser;
    }

    public function setIdUser(string $idUser): void {
        $this->idUser = $idUser;
    }

     public function setNameUser(string $nameUser): void {
        $this->nameUser = $nameUser;
    }
    public function setFirstnameUser(string $firstnameUser): void {
        $this->firstnameUser = $firstnameUser;
    }

    public function setPseudoUser(string $pseudoUser): void {
        $this->pseudoUser = $pseudoUser;
    }

    public function setEmailUser(string $emailUser): void {
        $this->emailUser = $emailUser;
    }

    public function setPasswordUser(string $passwordUser): void {
        $this->passwordUser = $passwordUser;
    }


}
