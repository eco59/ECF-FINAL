<?php
    // Connexion à la base de données
    require_once '../connexion_bdd/connexion_bdd.php';

    // Démarrer la session
    session_start();

    // Inclure la bibliothèque PhpSpreadsheet
    require '../../vendor/autoload.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    // Préparation de la requête SQL pour sélectionner les données à exporter
    $query = "SELECT titre, budget, date_mise_a_jour FROM jeux_videos";
    $stmt = $bdd->prepare($query);
    $stmt->execute();

    // Création du fichier Excel
    $filename = 'budget.xlsx';

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Écriture des noms de colonnes dans le fichier Excel
    $columns = array("Titre", "Budget", "Date de mise à jour");
    $columnIndex = 1;
    foreach ($columns as $col) {
        $sheet->setCellValueByColumnAndRow($columnIndex, 1, $col);
        $columnIndex++;
    }

    // Écriture des données dans le fichier Excel
    $rowIndex = 2;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $columnIndex = 1;
        foreach ($row as $value) {
            $sheet->setCellValueByColumnAndRow($columnIndex, $rowIndex, $value);
            $columnIndex++;
        }
        $rowIndex++;
    }

    // Configuration des en-têtes pour télécharger le fichier Excel
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    // Envoi du fichier Excel généré au navigateur
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');


    // Fermeture de la connexion à la base de données
    $bdd = null;

    // Fin du script
    exit;
?>
