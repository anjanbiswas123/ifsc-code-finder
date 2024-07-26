<?php
$db_host = "64.227.100.246";
	$db_user = "wnfthmnhyp";
	$db_pass = "nkvJ44Cnfr";
	$db_name = "wnfthmnhyp";
$con =  mysqli_connect($db_host,$db_user,$db_pass,$db_name);

 ?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <title>IFSC Code Finder</title>
<style>
  .ifsc-code-finder-box select {
    font-size: 1.2rem;
    border-radius: 5px;
    padding: 5px 10px;
    margin: 10px 100px;
    width: -webkit-fill-available;
}

.ifsc-code-finder-box label {
    font-size: 1.2rem;
    font-weight: bold;
}

.ifsc-code-finder-box {
    margin: 20px auto;
    text-align: center;
    border: 1px solid gray;
    padding: 50px 10px;
    max-width: 850px;
    border-radius: 7px;
    overflow: hidden;
    -webkit-box-shadow: 0 0 4px grey;
    box-shadow: 0 0 4px grey;
}

div#resultContainer {
    font-size: 1.6rem;
    padding: 10px;
    margin-top: 30px;
    font-weight: bold;
    color: #e51c23;
    line-height: 2;
}

div#resultContainer span {
    color: forestgreen;
}

@media (max-width:700px){
.ifsc-code-finder-box{
       max-width:100%
}
.ifsc-code-finder-box select {
    margin: 10px;
}
}
</style>
</head>
<body>
<div class="tool-header-article">
<h1>IFSC Code Finder</h1>
<p>This Tool helps you Find Indian All Bank IFSC Code</p>
</div>
<br>
<div class="ifsc-code-finder-box">
    <label>SELECT BANK NAME:</label>
    <select class="" name="" id="bank_name" onchange="find_state()">
      <option value="">SELECT BANK NAME</option>
      <?php
        $query=mysqli_query($con,"SELECT * FROM `available_bank_names`");
        while ($b=mysqli_fetch_array($query)) {
          ?>
            <option value="<?php echo $b['name'] ?>"><?php echo $b['name'] ?></option>
          <?php
        }
       ?>
    </select> <br> <br>
    <label>SELECT STATE:</label>
    <select id="bank_state" onchange="find_city()" class="" name="">
      <option>SELECT STATE</option>
    </select> <br> <br>
    <label>SELECT CITY:</label>
    <select id="bank_city" class="" name="" onchange="find_branch()">
      <option>SELECT CITY</option>
    </select> <br> <br>
    <label>SELECT BRANCH:</label>
    <select id="bank_branch" class="" name="" onchange="find_ifsc()">
      <option>SELECT BRANCH</option>
    </select>
    <br>
    <div id="resultContainer"></div>
    </div>
    
    <br>
    <br>
    <div class="ifsc-code-scanner-box">
        <div id="form-content" class="center-align">
            <form class="col s12" onsubmit="submitCode()">
                <div class="bank-details">
                    <div class="col s12">
                        <h2 class="teal-text">IFSC Code Scanner</h2>
                    </div>
                    <div class="col m2"></div>
                    <div class="input-field col m6 s12">
                    <i class="material-icons prefix">account_balance</i>
                        <input id="ifsc_code" type="text" class="validate" maxlength="11" minlength="11" required>
                        <label for="ifsc_code">Enter Your Bank IFSC Code </label>
                    </div>
                    <div class="input-field col m2 s12 ">
                        <button class="btn">Search</button>
                    </div>
                    <div class="col s2"></div>
                </div>
            </form>
        </div>
    </div>
    <div class="bank-details">
        <div id="bank" class="center-align"></div>
    </div>
  <script>
        function find_state(){
      var bank_name = $("#bank_name :selected").text();
      $("#bank_state").find('option').remove();
      $.ajax({
        url:"https://digitvital.com/bank-ifsc-code/ajax.php",
        type:"POST",
        data:{find_state: bank_name},
        success: function(e){
          $("#bank_state").append(e);
        }
      })
    }
    function find_city(){
      var bank_name = $("#bank_name :selected").text();
      var bank_state = $("#bank_state :selected").text();
      $("#bank_city").find('option').remove();
      $.ajax({
        url:"https://digitvital.com/bank-ifsc-code/ajax.php",
        type:"POST",
        data:{find_city: bank_name,bank_state: bank_state},
        success: function(e){
          $("#bank_city").append(e);
        }
      })
    }
    function find_branch(){
      var bank_name = $("#bank_name :selected").text();
      var bank_state = $("#bank_state :selected").text();
      var bank_city = $("#bank_city :selected").text();
      $("#bank_branch").find('option').remove();
      $.ajax({
        url:"https://digitvital.com/bank-ifsc-code/ajax.php",
        type:"POST",
        data:{find_branch: bank_name,bank_state: bank_state,bank_city:bank_city},
        success: function(e){
          $("#bank_branch").append(e);
        }
      })
    }
    function find_ifsc(){
      var bank_name = $("#bank_name :selected").text();
      var bank_state = $("#bank_state :selected").text();
      var bank_city = $("#bank_city :selected").text();
      var bank_branch = $("#bank_branch :selected").text();

      $.ajax({
        url:"https://digitvital.com/bank-ifsc-code/ajax.php",
        type:"POST",
        data:{find_ifsc: bank_name,bank_state: bank_state,bank_city:bank_city,bank_branch:bank_branch},
        success: function(e){
          // Instead of alert, update the content of a div with the id 'resultContainer'
          $("#resultContainer").html(e);
        }
      })
    }
  </script>
</body>
<script src='https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js'></script>
</html>