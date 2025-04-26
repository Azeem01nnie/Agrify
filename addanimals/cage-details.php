<?php
session_start();
require_once '../php/Config/database.php';

if (!isset($_GET['cage_id']) || !isset($_SESSION['user_id'])) {
    // Redirect if no cage_id or user_id in session
    header("Location: index.php");
    exit;
}

$cage_id = intval($_GET['cage_id']); // Sanitize the input to ensure it's an integer
$user_id = $_SESSION['user_id'];

// Fetch cage details from the database
$stmt = $pdo->prepare("SELECT * FROM cages WHERE cage_id = :cage_id AND user_id = :user_id");
$stmt->execute([':cage_id' => $cage_id, ':user_id' => $user_id]);

$cage = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$cage) {
    // Redirect if the cage is not found or does not belong to the current user
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Cage Details</title>
    <link rel="stylesheet" href="details-style.css" />
    <script src="add-script2.js" defer></script>
</head>
<body>
    <div class="details-container">
        <div class="flex">
            <button class="back-btn" onclick="goBack()">←</button>
        </div>

        <hr>

        <img id="cage-img" src="" alt="Cage Image" />
        <h1 id="cage-title"></h1>
        <p class="label">Cage description</p>
        <div class="description-container">
            <p id="cage-description"></p>
        </div>
    </div>

    <div class="livestock-container">
        <div class="button-container">
            <button class="add-animal-btn">+ Add Animal</button>
        </div>
        <table class="livestock-table">
            <thead>
                <tr>
                    <th>Animal ID</th>
                    <th>Animal Type</th>
                    <th>Date of Birth</th>
                    <th>Breedable</th>
                    <th>Price</th>
                    <th>Sellable</th>
                </tr>
            </thead>
            <tbody class="livestock-body">
                <!-- Animal rows will be dynamically added here -->
            </tbody>
        </table>
    </div>

    <div class="popup-container">
        <div class="popup-form">
            <h2>Add Animal</h2>

            <div class="lab">
                <label>Animal Type:</label>
                <select id="animalType">
                    <option value="Goat">Goat</option>
                    <option value="Cow">Cow</option>
                    <option value="Chicken">Chicken</option>
                    <option value="Horse">Horse</option>
                    <option value="Other">Other</option>
                </select>
                <input type="text" id="otherType" placeholder="Specify if Other" style="display:none;" />
            </div>

            <div class="lab2">
                <label>Date of Birth:</label>
                <input type="date" id="dob" />
            </div>

            <button id="saveAnimal">Add Animal</button>
            <button class="close-btn">Close</button>
        </div>
    </div>
    <script>
        // Handle saving the cage details
        const saveCageBtn = document.getElementById('save-cage');

        if (saveCageBtn) {
            saveCageBtn.addEventListener('click', function() {
                const cageName = document.getElementById('cage-name').value.trim();
                const cageDesc = document.getElementById('cage-description').value.trim();

                if (cageName === '') {
                    alert("Cage name cannot be empty.");
                    return;
                }

                const formData = new FormData();
                formData.append('cage_id', '<?= $cage['cage_id'] ?>');
                formData.append('cage_name', cageName);
                formData.append('cage_desc', cageDesc);

                fetch('update_cage.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Cage details updated successfully.");
                        location.reload();
                    } else {
                        alert("Failed to update cage: " + data.message);
                    }
                })
                .catch(error => {
                    alert("An error occurred: " + error);
                });
            });
        }
    </script>
</body>
</html>
