<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form to PDF</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <form action="generate_pdf.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        <div id="titleError" class="error-message"></div>

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>
        <div id="dateError" class="error-message"></div>

        <label for="image">Image:</label>
        <input type="file" id="image" name="image" accept="image/*" required>
        <div id="imageError" class="error-message"></div>

        <button type="submit" id="submitBtn" disabled>Submit</button>
    </form>
    <div id="errorMessages" class="error-message"></div>
</div>

<script>
    function validateForm() {
        console.log('asdasdasd');
        var title = document.getElementById('title');
        var date = document.getElementById('date');
        var image = document.getElementById('image');
        var titleError = document.getElementById('titleError');
        var dateError = document.getElementById('dateError');
        var imageError = document.getElementById('imageError');
        var errorMessages = document.getElementById('errorMessages');

        titleError.textContent = '';
        dateError.textContent = '';
        imageError.textContent = '';
        errorMessages.textContent = '';

        if (title.value.trim() === '') {
            displayError(titleError, 'Title is required');
            return false;
        }

        if (date.value.trim() === '') {
            displayError(dateError, 'Date is required');
            return false;
        }

        if (image.value.trim() === '') {
            displayError(imageError, 'Image is required');
            return false;
        }

        return true;
    }

    function displayError(element, message) {
        element.textContent = message;
        document.getElementById('errorMessages').textContent = 'Please fix the errors above.';
    }

    // Enable/disable submit button based on form validity
    var formInputs = document.querySelectorAll('input');
    formInputs.forEach(function (input) {
        input.addEventListener('input', function () {
            var errorMessages = document.querySelectorAll('.error-message');
            errorMessages.forEach(function (error) {
                error.textContent = '';
            });

            var isValid = Array.from(formInputs).every(function (input) {
                return input.checkValidity();
            });
            document.getElementById('submitBtn').disabled = !isValid;
        });
    });
</script>

</body>
</html>
