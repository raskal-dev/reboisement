<?php
  //c-details.php
  require_once '../modele.php';
  require_once '../utility.php';
  $listChamps=[array('nom'=>'identifiant','libelle'=>'libelle'),
                      array('nom'=>'id', 'libelle'=>'Id'),
                      array('nom'=>'mail', 'libelle'=>'mail'),
                      array('nom'=>'password', 'libelle'=>'password'),
                      array('nom'=>'confirme', 'libelle'=>'confirme')
                      
                      

               ];
  $dataToload=getUsers();

  $buttons=[ array('id'=>'Ajout',
  					'libelle'=>'<i class="fas fa-plus">Ajout</i>',
  					'selection'=>'N',
  					'whereKey'=>[],
  					'idTraitement'=>'Ajout',
  					'action'=>'javascript:void(0)'),                                          
              array('id'=>'Update','libelle'=>'<i class="fas fa-edit"> Modification</i>',
                                                        'selection'=>'O',
                                                        'idTraitement'=>'Modification',
                                                         'action'=>'javascript:void(0)'),
                                  array('id'=>'Suppression',
                                                        'libelle'=>'<i class="fas fa-trash-alt"> Suppression</i>',
                                                        'selection'=>'O',
                                                        'idTraitement'=>'Suppression',
                                                        'action'=>'javascript:void(0)')];
    require '../view/analyse.php';

?>