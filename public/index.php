<!-- index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Coffee Form</title>
</head>
<body>
    <h1>Select Coffee</h1>
    <form action="index.php" method="post">
        <label for="coffee">Select a Coffee:</label>
        <select id="coffee" name="coffee">
            <?php
            // Fetch coffee options from the database using Coffee model
            require __DIR__.'/../vendor/autoload.php';

            use App\Coffee;

            $coffees = Coffee::all();

            // Iterate over the coffee options and create an option for each
            foreach ($coffees as $coffee) {
                echo "<option value='" . htmlspecialchars($coffee->id) . "'>" . htmlspecialchars($coffee->name) . "</option>";
            }
            ?>
        </select>
        <button type="submit">Submit</button>
    </form>

    <?php
    // Process form data if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve selected coffee from the form
        $selectedCoffeeId = $_POST['coffee'] ?? '';

        // Fetch the selected coffee details from the database
        $selectedCoffee = Coffee::find($selectedCoffeeId);

        // Display the selected coffee
        if ($selectedCoffee) {
            echo "<h2>Selected Coffee:</h2>";
            echo "Coffee: " . htmlspecialchars($selectedCoffee->name);
        } else {
            echo "<p>No coffee selected.</p>";
        }
    }
    ?>
</body>
</html>
