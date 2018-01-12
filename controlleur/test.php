
function inscription($data, $mail, $id,$bd,$err)
{

$prenom = $data['prenom'];
$nom2 = $data['nom'];
$stmt = $bd->prepare("SELECT numEnfant FROM ENFANT WHERE numUtilisateur = $id AND nom = $nom2 AND prenom = $prenom");
$stmt->execute();
$row = $stmt->fetchAll();

if($row){
return $err; //existe dans la BD
}
else {

$nom = $data['nom'];
$prenom = $data['prenom'];
$age = $data['age'];
$telPrarent = $data['telParent'];
$categorie = $data['categorie'];

$sql = "INSERT INTO ENFANT VALUES ('','$nom','$prenom','$age','$telPrarent','$mail','$categorie','$id' )";

$ressql = $bd->prepare($sql);

$ressql->execute();

$verifierEnfantExiste = "SELECT numUtilisateur FROM utilisateur WHERE mail = :email";

$resExist = $bd->prepare($verifierEnfantExiste);

$resExist->execute(array(
'numUtilisateur' => $id,
'prenom' => $prenom
));

$idEnfant = $resExist->fetchAll();

if ($idEnfant) {
$res = afficherEnfant($bd, $id, $idEnfant);
return $res;
} else {
return $err;
}

}

}

function ajouterArgent($data,$id,$bd, $idEnfant,$date, $err)
{

$stmt = $bd->prepare("INSERT INTO COMPTE VALUES(?,?,?,?)");
$stmt->binParam(1, $date);
$stmt->binParam(2, $data['montant']);
$stmt->binParam(3, $id);
$stmt->binParam(4, $data['numEnfant']);

$idEnfant = $bd->execute("SELECT numEnfant FROM ENFANT WHERE numUtilisateur = $id");

$stmt->execute();

$tab = afficherEnfant($bd,$id,$idEnfant);
return $tab;

}

function afficherEnfant($bd,$id,$idEnfant){
$stmt = $bd->prepare("SELECT E.numEnfant, E.prenom, SUM(montant) AS solde FROM ENFANT E, COMPTE C where E.numUtilisateur = $id AND C.numEnfant = $idEnfant");
$stmt->execute();
$tab = json_encode($stmt->fetchAll());
return $tab;
}