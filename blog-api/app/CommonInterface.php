<?php

namespace App;

interface CommonInterface
{
    //Post ve Category Servislerinde ortak olarak bu ikisi olduğu için bu Interfacenin ismini CommonInterface yaptım.
    public function getAll();

    public function getBySlug($slug);


}
