<!doctype html>
<html lang='en'>

<head>
    <title>Mystery Word Scramble</title>
    <meta charset='utf-8'>

    <style>
    .correct {
        color: green;
    }

    .incorrect {
        color: red;
    }
    </style>
</head>

<body>

    <form method='POST' action='process.php'>
        <h1>Mystery Word Scramble</h1>

        <p>Mystery word: 
            <?php echo $guess ?>
        </p>
        <p>Hint: 
            <?php echo $words[$guess] ?>
        </p>

        <label for='answer'>Your guess:</label>
        <input type='text' name='answer' id='answer'>

        <button type='submit'>Check answer</button>
    </form>

    <?php if (isset($results)) { ?>
    <h1>Results</h1>

    <?php if ($haveAnswer == false) { ?>
    Please enter an answer.
    <?php } elseif ($correct) { ?>
    <div class='correct'>You got it correct! :-)</div>
    <?php } else { ?>
    <div class='incorrect'>Sorry, that is not correct. :-(</div>
    <?php } ?>
    <?php } ?>

</body>

</html>