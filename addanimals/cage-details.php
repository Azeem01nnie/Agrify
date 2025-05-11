<?php
session_start();
require_once '../php/Config/database.php';

if (!isset($_GET['cage_id']) || !isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$cage_id = intval($_GET['cage_id']);
$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM cages WHERE cage_id = :cage_id AND user_id = :user_id");
$stmt->execute([':cage_id' => $cage_id, ':user_id' => $user_id]);

$cage = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$cage) {
    header("Location: index.php");
    exit;
}

$stmt = $pdo->prepare("
    SELECT * FROM animals 
    WHERE cage_id = :cage_id 
    ORDER BY created_at DESC
");
$stmt->execute([':cage_id' => $cage_id]);
$animals = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

        <img id="cage-img" src="<?= htmlspecialchars($cage['image_url'] ?? '') ?>" alt="Cage Image" />
        <h1 id="cage-title"><?= htmlspecialchars($cage['cage_name']) ?></h1>
        <p class="label">Cage description</p>
        <div class="description-container">
            <p id="cage-description"><?= htmlspecialchars($cage['cage_description']) ?></p>
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
                <?php foreach ($animals as $animal): ?>
                <tr>
                    <td><?= htmlspecialchars($animal['animal_id']) ?></td>
                    <td><?= htmlspecialchars($animal['animal_type']) ?></td>
                    <td><?= htmlspecialchars($animal['date_of_birth']) ?></td>
                    <td><?= $animal['breedable'] ? 'Yes' : 'No' ?></td>
                    <td>₱<?= number_format($animal['price'], 2) ?></td>
                    <td><?= $animal['sellable'] ? 'Yes' : 'No' ?></td>
                </tr>
                <?php endforeach; ?>
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

             <div class="lab2">
                <label>Price (₱):</label>
                <input type="number" id="price" min="0" step="0.01" required />
            </div>

            <div class="lab2 checkbox-group">
                <label>
                    <input type="checkbox" id="breedable" />
                    Breedable
                </label>
                <label>
                    <input type="checkbox" id="sellable" />
                    Sellable
                </label>
            </div>

            <button id="saveAnimal">Add Animal</button>
            <button class="close-btn">Close</button>
        </div>
    </div>
    
    <script>
        const saveCageBtn = document.getElementById('save-cage');
        const animalTypeSelect = document.getElementById('animalType');
        const otherTypeInput = document.getElementById('otherType');
        const addAnimalBtn = document.querySelector('.add-animal-btn');
        const popupContainer = document.querySelector('.popup-container');
        const closeBtn = document.querySelector('.close-btn');

        addAnimalBtn.addEventListener('click', () => {
            popupContainer.style.display = 'flex';
        });

        closeBtn.addEventListener('click', () => {
            popupContainer.style.display = 'none';
        });

        animalTypeSelect.addEventListener('change', function() {
            otherTypeInput.style.display = this.value === 'Other' ? 'block' : 'none';
        });

        document.getElementById('saveAnimal').addEventListener('click', function() {
            const animalType = animalTypeSelect.value === 'Other' ? 
                document.getElementById('otherType').value : 
                animalTypeSelect.value;
            const dob = document.getElementById('dob').value;
            const price = document.getElementById('price').value;
            const breedable = document.getElementById('breedable').checked;
            const sellable = document.getElementById('sellable').checked;

            if (!animalType || !dob || !price) {
                alert("Please fill in all required fields");
                return;
            }

            const formData = new FormData();
            formData.append('cage_id', '<?= $cage['cage_id'] ?>');
            formData.append('animal_type', animalType);
            formData.append('dob', dob);
            formData.append('price', price);
            formData.append('breedable', breedable ? 1 : 0);
            formData.append('sellable', sellable ? 1 : 0);

            fetch('add_animal.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert("Animal added successfully");
                    location.reload();
                } else {
                    alert("Failed to add animal: " + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                alert("An error occurred: " + error);
            });
        });

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
