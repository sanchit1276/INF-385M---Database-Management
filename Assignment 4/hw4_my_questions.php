<html>
          <!-- usual HTML code to format page-->
    <head>
        <title>Questions</title>
    </head>
    <body>
        <h1>My Questions</h1>
        <?php
        //reading file into variable
            $questions = file('hw4_questions.txt');
          //counting number of questions in file to loop over
            $number_of_questions = count($questions);
            //randomizing order of questions
            shuffle($questions);
            //loop to print all questions
            for($x=0; $x < $number_of_questions; $x++ ) {
                print "$questions[$x]<br/>";
            }
        ?>
        <h3>Please enter the new question you want to add</h3>
          <!-- HTML form to submit a new question-->
            <form action = "hw4_my_questions.php" method = "GET">
                <input type = "text" name = "question_to_add">
                <input type = "submit" name = "submit" value="submit">
            </form>
        <?php
        //saving input from HTML form to variable
            $new_question= $_GET['question_to_add'];
            //appending new question to file and ensuring new line
            file_put_contents("hw4_questions.txt", trim($new_question).PHP_EOL,FILE_APPEND);
        ?>
    </body>
</html>
