  <!-- 
    Using HTML5 Footer Element 
    BS5 class text-center

    Text: Docs => Utilities
    https://getbootstrap.com/docs/5.1/utilities/text/
  -->
    <footer class="text-center">
        <?php 
        /*
        PHP date() Function
        https://www.w3schools.com/php/func_date_date.asp

        Prints the day, date, month, year, time, AM or PM:
        
        M - A short textual representation of a month (three letters)
        d - The day of the month (from 01 to 31)
        Y - A four digit representation of a year
        */
        echo 'Copyright '.date('M d, Y').' - PHP and PDO:MYSQL Bootstrap 5 Demonstration'; 
        ?>
    </footer>

    </div> <!-- end div.container -->
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    -->
  </body>
</html>