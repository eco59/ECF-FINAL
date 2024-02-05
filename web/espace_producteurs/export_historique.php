<?php
    //connexion bdd
    include '../connexion_bdd/connexion_bdd.php';
    // Démarrer la session sur chaque page où vous en avez besoin
    session_start();
    require '../../vendor/autoload.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    // Création d'un nouveau classeur
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // En-têtes de colonne
    $sheet->setCellValue('A1', 'ID');
    $sheet->setCellValue('B1', 'ID Jeu');
    $sheet->setCellValue('C1', 'Ancien Budget');
    $sheet->setCellValue('D1', 'Nouveau Budget');
    $sheet->setCellValue('E1', 'Commentaire');

    // Récupération des données de l'historique avec le titre du jeu
    $requeteHistorique = "SELECT h.id, j.titre AS titre_jeu, h.ancien_budget, h.nouveau_budget, h.commentaire
    FROM modification h
    INNER JOIN jeux_videos j ON h.id_jeux_videos = j.id";
    $resultatHistorique = $bdd->query($requeteHistorique);

    // Remplissage des données dans le classeur
    $row = 2;
    while ($rowHistorique = $resultatHistorique->fetch(PDO::FETCH_ASSOC)) {
        $sheet->setCellValue('A' . $row, $rowHistorique['id']);
        $sheet->setCellValue('B' . $row, $rowHistorique['titre_jeu']);
        $sheet->setCellValue('C' . $row, $rowHistorique['ancien_budget']);
        $sheet->setCellValue('D' . $row, $rowHistorique['nouveau_budget']);
        $sheet->setCellValue('E' . $row, $rowHistorique['commentaire']);
        $row++;
    }

    // Enregistrez le fichier Excel dans le dossier de téléchargement
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="historique_modifications.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');

    // Fermeture de la connexion
    $connexion = null;
    // Terminer le script
    exit;
?>