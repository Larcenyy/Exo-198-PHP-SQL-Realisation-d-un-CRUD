<?php

require "DbPDO.php";
DbPDO::connect();

?>

<form action="" method="post">
    <input type="submit" name="add_student" value="Ajouter un étudiant">
</form>
<?php
    if (isset($_POST['add_student'])) {
        DbPDO::addStudent("Comeau", "Remy", 19);
    }

$students = DbPDO::getAllStudents();
    foreach ($students as $student) {
        echo "Nom : " . $student['nom'] . "<br>";
        echo "Prénom : " . $student['prenom'] . "<br>";
        echo "Age : " . $student['age'] . "<br><br>";
    }
?>

<form action="" method="post">
    <input type="submit" name="update_studend" value="Modifié un étudiant">
</form>
<?php
if (isset($_POST['update_studend'])) {
    DbPDO::updateStudent("James", "Bonsd", 21, "1") ;
}

?>

    <form action="" method="post">
        <input type="submit" name="delete_sutend" value="Supprimé un étudiant">
    </form>
<?php
if (isset($_POST['delete_sutend'])) {
    DbPDO::deleteStudent("8") ;
}


