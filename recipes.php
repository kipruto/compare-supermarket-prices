<?php

require_once './includes/header.php';

?>


<section>
    <div class='header-strip'>
        <div class="head-text">
         <div class='border-boxx'>
                <h2>Delicious Snacks & Vegan Recipes </h2>
            </div>
        </div>
    </div>
</section>

<section class="products">
    <div class="container">
        <div class="row">

            <?php
            $result = $db->fetchrecipe();
            while ($row = mysqli_fetch_assoc($result)) {
                recipeelement($row['id'], $row['image'], $row['name'], $row['ingredients'], $row['instructions'], $row['nutrition facts'], $row['time']);
            }
            ?>
        </div>
    </div>
    <hr class="mt-5">



    <div class="container" id="calculator">
        <h2 class="mt-5" align="left"> Find how many calories you need</h2>
        <label id="gender" class="mb-3">Gender</label> </br>
        <input class="mr-2" type="radio" name="check" value="male" id="maleCheck" checked="" /> Male
        <input class="ml-3 mr-3" type="radio" name="check" value="female" id="femaleCheck" />Female <br>
        <label class="mt-3">Age</label>

        <input type='number' class="form form-control" placeholder="yrs" id="calculatorAge" />
        <label>Weight</label>
        <input type='number' class="form form-control" placeholder="kg" id="calculatorWeight" />
        <label>Height</label>
        <input type='number' class="form form-control" placeholder="cm" id="calculatorHeight" />
        <label>Activity</label>

        <select name="activity" id="activity" class="form-control" style="width:200px;">
            <option value="1.2" selected="">Sedentary (office job)</option>
            <option value="1.3">Light Exercise (1-2 days/week)</option>
            <option value="1.5">Moderate Exercise (3-5 days/week)</option>
            <option value="1.8">Heavy Exercise (6-7 days/week)</option>
            <option value="2.2">Athlete (2x per day) </option>
        </select>

        <button class="calCalories" id="calculate_button" style="float: left;">Calculate</button>
        <button class="calCalories" id="hide_button" style="float: left;margin-left: 10px;">Reset</button>

    </div>
    <div id="displayResults">
        <div id="display_header">
            <p id="header_texts"></p>
            <p id="header_text"></p>
        </div>
    </div>


</section>

<?php
require_once './includes/footer.php';
?>