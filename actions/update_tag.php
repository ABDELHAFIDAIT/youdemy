<?php
header('Content-Type: application/json');
require_once "../classes/Tag.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = array();
    
    if (isset($_POST['id_tag']) && isset($_POST['new_name'])) {
        $tag = new Tag('');
        $result = $tag->updateTag($_POST['id_tag'], $_POST['new_name']);
        
        if ($result) {
            $response['status'] = 'success';
            $response['message'] = 'Tag mis à jour avec succès';
            $response['new_name'] = $_POST['new_name'];
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Erreur lors de la mise à jour du tag';
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Données manquantes';
    }
    
    echo json_encode($response);
}
?>
