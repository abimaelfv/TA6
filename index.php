<?php

require_once __DIR__.'/vendor/autoload.php';

use MongoDB\Client as Mongo;

$conexion = new Mongo('mongodb://127.0.0.1:27017');

$coleccion = $conexion->tarea6->users;

// CRUD


// insertar 1 dato
function insertOneDate($coleccion){
    $insertResult = $coleccion->insertOne([
        'id' => '2',
        'name' => 'Abi',
        'email' => 'abi@hotmail.com',
        'password' => '12345',
        'status' => '0'
    ]);

    echo $insertResult->getInsertedId();
};


// insertar varios datos
function insertManyDate($coleccion){
    $insertResult = $coleccion->insertMany([
        [
            'id' => '3',
            'name' => 'Lila',
            'email' => 'lila@hotmail.com',
            'password' => '12345',
            'status' => '1'
        ],
        [
            'id' => '4',
            'name' => 'Sara',
            'email' => 'sara@hotmail.com',
            'password' => '12345',
            'status' => '0'
        ]
    
    ]);
    
    print_r($insertResult->getInsertedIds());
};


// Mostrar 1 dato
function findOneDate($coleccion, $id){
    $findResult = $coleccion->findOne(['id' => "$id"]);
    
    print_r($findResult);
};


// Mostrar varios datos
function findManyDate($coleccion){
    $findResult = $coleccion->find();

    foreach ($findResult as $Data) {
        print_r($Data);
    };
};


// Actualizar un dato
function updateOneDate($coleccion){
    $updateResult = $coleccion->updateOne(
        ['id' => '4'],
        ['$set' => ['password' => 'oso','status' => '1']]
    );

    printf("%d coincidencia.\n", $updateResult->getMatchedCount());
    printf("%d dato modificado.\n", $updateResult->getModifiedCount());
};


// Actualizar varios datos
function updateManyDate($coleccion){
    $updateResult = $coleccion->updateMany(
        ['status' => '1'],
        ['$set' => ['password' => 'oso']]
    );

    printf("%d coincidencia(s).\n", $updateResult->getMatchedCount());
    printf("%d dato(s) modificado(s).\n", $updateResult->getModifiedCount());
};


// Eliminar un dato
function deleteOneDate($coleccion,$id){
    $deleteResult = $coleccion->deleteOne(['id' => "$id"]);

    printf("%d dato eliminado.\n", $deleteResult->getDeletedCount());
};


// Eliminar varios datos
function deleteManyDate($coleccion){
    $deleteResult = $coleccion->deleteMany(['status' => '1']);

    printf("%d dato(s) eliminado(s).\n", $deleteResult->getDeletedCount());
};




deleteManyDate($coleccion);

?>