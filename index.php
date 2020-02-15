<?php
/*
 * SOLID — буква «D»
 *
 * Принцип инверсии зависимостей (The Dependency Inversion Principle)
 * «Зависимость на Абстракциях. Нет зависимости на что-то конкретное.»
 *
 * Модули верхних уровней не должны зависеть от модулей нижних уровней. Оба типа модулей должны зависеть от абстракций.
 * Абстракции не должны зависеть от деталей. Детали должны зависеть от абстракций.
 */


interface ISave
{
    public function insert($date);
}

class SaveDb implements ISave
{
    public function insert($date)
    {
        echo $date.' сохранено в БД';
    }
}

class SaveFile implements ISave{
    public function insert($date)
    {
        echo $date.' сохранено в файл';
    }
}

class BaseClass
{
    public function save(ISave $obj, $date)
    {
        $obj->insert($date);
    }
}

class SaveSession /*implements Save */{//будет ошибка т.к. закомментирован интерфейс
    public function insert($date)
    {
        echo $date.' сохранено в сессию';
    }
}


//////////////////


$content= 'контент';

$db = new SaveDb();
(new BaseClass())->save($db, $content);

$file = new SaveFile();
(new BaseClass())->save($file, $content);

$ses = new SaveSession();//вызовит ошибку - must implement interface Save, instance of saveSession, т.к. не имплементирован интерфейс в классе SaveSession
(new BaseClass())->save($ses, $content);

