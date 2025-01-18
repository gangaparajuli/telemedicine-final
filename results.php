<?php 

include('databaseconnection.php');

         if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['symptoms'])){
            $selected_symptoms = $_POST['symptoms'];
            $symptom_ids = implode(",", array_map('intval', $selected_symptoms));

            //Query to find diseases matching selected symptoms
            $disease_query = "SELECT DISTINCT d.diseases_name, t.treatment_name FROM diseases d 
            JOIN diseases_symptoms ds ON d.diseases_id = ds.diseases_id
            JOIN diseases_treatments dt ON d.diseases_id = dt.diseases_id
            JOIN treatments t ON dt.treatment_id = t.treatment_id
            WHERE ds.symptoms_id IN($symptom_ids)
            GROUP BY d.diseases_id";

    $diseases_result = $connection->query($disease_query);
    if($diseases_result->num_rows > 0){
        echo"<h2>Possible Diseases and Recommended Medicine</h2><ul>";
        while($row = $diseases_result->fetch_assoc()){
            echo "<li><strong>Diseases:</strong>" . $row['diseases_name'] . " <br><strong>Medicine:</strong>" .$row['treatment_name'] . "</li><br>";
        }
        echo "</ul>";
    }
    else{
        echo "<p>No matching diseases found from the selected symptoms.</p>";
    }
         }

         //close the connection 
         $connection->close();
         ?>