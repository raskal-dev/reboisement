<?php
function getDataFromKobo($url,$username,$password){
       $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        //curl_setopt($curl, CURLOPT_HTTPGET, true);
      //  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Accept: application/json'));
        //curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
       // curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        //curl_setopt($curl, CURLOPT_USERPWD, "$username:$password");
        $header = array();
    $header[] = 'Content-length: 0';
    $header[] = 'Content-type: application/json';
    $header[] = 'Authorization: Token 4c9ada8f5d1c50fe6abfbdbe67f7d7f212eff386';

     curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

        $result=curl_exec ($curl);

        $arr=json_decode(($result),true);
        $ar=[];
        foreach ($arr as $key => $value) {
          array_push($ar, $value);
        };
        $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if (!curl_errno($curl)) {
          switch ($http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE)) {
            case 200:  # OK
              break;
            default:
            $result = [];
          }
        }
        curl_close($curl);
        return json_encode($ar);
  }
  function deleteDataKobo($url){
    $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
       $header = array();
     $header[] = 'Content-length: 0';
     $header[] = 'Content-type: application/json';
     $header[] = 'Authorization: Token 4c9ada8f5d1c50fe6abfbdbe67f7d7f212eff386';

      curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
       $result=curl_exec ($curl);

       $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
         if (!curl_errno($curl)) {
           switch ($http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE)) {
             case 200:  # OK
               break;
             default:
             $result = [];
           }
         }
         curl_close($curl);
  }

function getDataCollected($db){

         $url='https://kc.kobotoolbox.org/api/v1/data/994242';

        $data = getDataFromKobo($url,'reboisement','Reboisement2022');
        $arrayResult=json_decode($data,true);
        print_r($arrayResult);

        $arrayInsertColumn = ['Localisation/region_select'=>'region',
                             'Localisation/district_select'=>'district',
                            'Localisation/commune_select'=>'commune',
                            'Localisation/localite'=>'site',
                            'Localisation/fokontany'=>'fokontany',
                            '_Promoteur/type_acteur'=>'typeActeur',
                            'objectif/approche'=>'Approche',
                            'interview_date'=>'dateRemplissage',
                            'reboisement/situation_juridique'=>'situationJuridique',
                            '_Promoteur/type_acteur'=>'acteur',
                            'reboisement/superficie_prevue'=>'surfaceTotalPrevu',
                            'reboisement/classe_superficie'=>'class_',
                            'reboisement/ecosysteme'=>'mangroveOuTerrestre',
                            'reboisement/date_mis_en_terre'=>'dateMiseEnTerre',
                            
                            'objectif/objectif_reboisement'=>'objectifReboisement',
                            'objectif/objectif_rpf'=>'objectifRpf',
                            'reboisement/superficie'=>'superficieRealise',
                            'reboisement/coordonnees_terrain'=>'polygone',
                            'reboisement/photo_zone_reboisement'=>'photoid'
                            ];


         $x=0;
         $y=count($arrayResult);

         if($y==0){
            $result = 'Aucune ligne à importer';
         }else {

           for ($i=0; $i <$y; $i++) {

             $sqlInsert="";
             $sqlColumnInsert="(";
             $sqlValues="(";

              foreach ($arrayResult[$i] as $key => $value) {

                if($key==='_id'){
                  $idligne=$value;

                 }


             if(isset($arrayInsertColumn[$key])){
              $sqlColumnInsert = $sqlColumnInsert.'`'.$arrayInsertColumn[$key].'`'.',';
              $sqlValues =$sqlValues.'\''.$value.'\''.',';
             }
                };

               $sqlColumnInsert = substr($sqlColumnInsert,0,-1).')';
               $sqlValues = substr($sqlValues,0,-1).')';

               $tableName = 'reboisement';

               $sqlInsert = "INSERT INTO ".$tableName." ".$sqlColumnInsert." values ".$sqlValues;
               $req=$db->prepare($sqlInsert);
               $req->execute();




              // $resultInsert = addDataExplicite($sqlInsert);


              if ($req){
                $urlDelete = $url.'/'.$idligne;
                 deleteDataKobo($urlDelete);
                 $x = $x + 1;
               }


         }
         $result = $x.'/'.$y.' lignes insérées';

         }




       echo $result;

 }
